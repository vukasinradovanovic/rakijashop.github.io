<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\System\ErrorLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardErrorLogsController
{
    /**
     * Display error logs page.
     */
    public function index()
    {
        return view('dashboard.dashboardLogs.dashboardLogs');
    }

    /**
     * Search error logs for dashboard table.
     */
    public function search(Request $request): JsonResponse
    {
        $fields = $request->validate([
            'query' => ['nullable', 'string', 'max:120'],
        ]);

        $searchQuery = trim((string) ($fields['query'] ?? ''));

        $logsQuery = ErrorLog::query()->with('user:id,email')->latest();

        if ($searchQuery !== '') {
            $logsQuery->where(function ($builder) use ($searchQuery) {
                $builder->where('error_code', 'like', "%{$searchQuery}%")
                    ->orWhere('route_name', 'like', "%{$searchQuery}%")
                    ->orWhere('request_path', 'like', "%{$searchQuery}%")
                    ->orWhereHas('user', function ($userQuery) use ($searchQuery) {
                        $userQuery->where('email', 'like', "%{$searchQuery}%");
                    });
            });
        }

        $logs = $logsQuery
            ->limit(100)
            ->get()
            ->map(function (ErrorLog $log) {
                return [
                    'id' => $log->id,
                    'error_code' => $log->error_code,
                    'user_email' => $log->user?->email,
                    'route_name' => $log->route_name,
                    'request_path' => $log->request_path,
                    'created_at' => $log->created_at?->format('Y-m-d H:i:s'),
                ];
            });

        return response()->json([
            'logs' => $logs,
        ]);
    }
}

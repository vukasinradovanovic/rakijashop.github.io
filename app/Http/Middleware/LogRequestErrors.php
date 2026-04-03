<?php

namespace App\Http\Middleware;

use App\Models\System\ErrorLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

class LogRequestErrors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            return $next($request);
        } catch (Throwable $throwable) {
            $errorCode = (int) $throwable->getCode();

            if ($errorCode <= 0 && $throwable instanceof HttpExceptionInterface) {
                $errorCode = $throwable->getStatusCode();
            }

            if ($errorCode <= 0) {
                $errorCode = 500;
            }

            try {
                ErrorLog::create([
                    'user_id' => Auth::id(),
                    'error_code' => $errorCode,
                    'route_name' => $request->route()?->getName(),
                    'request_path' => $request->path(),
                ]);
            } catch (Throwable $loggingException) {
                // Logging should never break the original request lifecycle.
            }

            throw $throwable;
        }
    }
}

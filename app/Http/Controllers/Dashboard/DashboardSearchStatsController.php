<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\SearchData\SearchData;
use Illuminate\Http\Request;

class DashboardSearchStatsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $allData = SearchData::query();

        if ($request->filled('searchDataSort')) {
            $allData->orderBy('count', $request->searchDataSort == 1 ? 'asc' : 'desc');
        } else {
            $allData->orderBy('count', 'desc');
        }

        $allData = $allData->paginate(10);

        if ($request->ajax()) {
            return view('dashboard.dashboardSearch.partials.searchStatList', compact('allData'))->render();
        }

        return view('dashboard.dashboardSearch.dashboardSearchStats', compact('allData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\AmazonSite;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalSites = AmazonSite::count();
        $totalEmployees = Employee::count();
        $totalEmployeesBySite = Employee::groupBy('amazon_site_id')->count();
        $totalSitesToday = AmazonSite::whereDate('created_at', today())->count();
        $totalEmployeesToday = Employee::whereDate('created_at', today())->count();
        $totalBudget = AmazonSite::sum('labor_budget');
        $totalBudgetToday = AmazonSite::whereDate('created_at', today())->sum('labor_budget');

        return view('dashboard')
        ->with([
            'totalSites' => $totalSites,
            'totalEmployees' => $totalEmployees,
            'totalEmployeesBySite' => $totalEmployeesBySite,
            'totalSitesToday' => $totalSitesToday,
            'totalEmployeesToday' => $totalEmployeesToday,
            'totalBudget' => $totalBudget,
            'totalBudgetToday' => $totalBudgetToday,
        ]);
    }
}

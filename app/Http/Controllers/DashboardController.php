<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\MonthlyIncomingChargeback;

class DashboardController extends Controller
{
    public function index(MonthlyIncomingChargeback $chart)
    {
        return view('dashboard', ['chart' => $chart->build()]);
    }
}

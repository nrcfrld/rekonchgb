<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\MonthlyIncomingChargeback;
use App\Charts\StatusChargeback;
use App\Enums\StatusType;
use App\Models\Chargeback;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(MonthlyIncomingChargeback $chart, StatusChargeback $statusChart, Request $request)
    {
        $chargebacks = Chargeback::whereYear('opencase_date', $request->year ? $request->year : date('Y'))->whereIn('status', ['CLOSED / DEBET', 'CLOSED / REPRESENTMENT', 'CLOSED'])->select(DB::raw('SUM(amount) as total_amount, COUNT(chargebacks.id) as count, principals.name as name'))->join('principals', 'principals.id', '=', 'principal_id')
            ->groupBy('principals.name')->get();


        $date = date("Y-m-d");
        $toDate = date("Y-m-d", strtotime($date . ' + 7 days'));

        // $urgentChargebacks = Chargeback::whereBetween('expired_date', [$date, $toDate])->get();

        return view('dashboard', ['chart' => $chart->build(), 'statusChart' => $statusChart->build(), 'totals' => $chargebacks, 'urgentChargebacks' => Chargeback::class]);
    }
}

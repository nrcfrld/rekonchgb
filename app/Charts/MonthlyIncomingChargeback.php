<?php

namespace App\Charts;

use App\Models\Chargeback;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MonthlyIncomingChargeback
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\AreaChart
    {
        $monthLoss =  Chargeback::whereYear('date_on_book', request()->get('year') ? request()->get('year') : date('Y'))->where('status', 'CLOSED / LOSS')->select(DB::raw('SUM(amount) as total_amount, MONTH(date_on_book) as month'))
            ->groupBy(DB::raw('MONTH(date_on_book) ASC'))->get();

        $monthWins =  Chargeback::whereYear('opencase_date', date('Y'))->whereIn('status', ['CLOSED / DEBET', 'CLOSED / REPRESENTMENT', 'CLOSED'])->select(DB::raw('SUM(amount) as total_amount, MONTH(opencase_date) as month, COUNT(id) as count'))
            ->groupBy(DB::raw('MONTH(opencase_date) ASC'))->get();

        $win = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $loss = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        foreach ($monthLoss as $month) {
            $loss[$month->month - 1] = $month->total_amount;
        }

        foreach ($monthWins as $month) {
            $win[$month->month - 1] = $month->total_amount;
        }

        return $this->chart->AreaChart()
            ->setTitle('Summary Win/Loss')
            ->setSubtitle('Diagram Win/Loss Chargeback')
            ->addData('Win', $win)
            ->addData('Loss', $loss)
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'Agustus', 'September', 'Oktober', 'November', 'Desember']);
    }
}

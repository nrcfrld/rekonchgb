<?php

namespace App\Charts;

use App\Models\Chargeback;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MonthlyIncomingChargeback
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {

        // $chargebacks =  Chargeback::whereRaw('year(`opencase_date`)', date('Y'))->get()->groupBy(function ($item) {
        //     return Carbon::parse($item->opencase_date)->format('Y-M');
        // });

        // $chargebacks = DB::table('chargebacks')->select('opencase_date', DB::raw('count(*) as total'))->get();

        // dd($chargebacks);

        return $this->chart->barChart()
            ->setTitle('Summary Win/Loss')
            ->setSubtitle('Diagram Win/Loss Chargeback')
            ->addData('Win', [40, 93, 35, 42, 18, 82, 20, 10, 15, 30, 36])
            ->addData('Loss', [70, 29, 77, 28, 55, 45, 10, 20, 18, 50, 70])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'Agustus', 'September', 'Oktober', 'November', 'Desember']);
    }
}

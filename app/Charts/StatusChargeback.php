<?php

namespace App\Charts;

use App\Enums\StatusType;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatusChargeback
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $names = [];
        $counts = [];
        foreach (StatusType::getValues() as $status) {
            $count = DB::table('chargebacks')->whereYear('opencase_date', request()->get('year') ? request()->get('year') : date('Y'))->where('status', $status)->count();
            $names[] = $status;
            $counts[] = $count;
        }
        // $open = DB::table('chargebacks')->where('status', StatusType::Open)->count();
        // $open = DB::table('chargebacks')->where('status', StatusType::ClosedDebet)->count();
        // $open = DB::table('chargebacks')->where('status', StatusType::ClosedLoss)->count();
        // $open = DB::table('chargebacks')->where('status', StatusType::ClosedRepresentment)->count();
        // $open = DB::table('chargebacks')->where('status', StatusType::closed)->count();

        $year = request()->has('year') ? request()->get('year') : date('Y');

        return $this->chart->pieChart()
            ->setTitle('Monitoring Status Chargeback.')
            ->setSubtitle('Tahun ' . $year)
            ->addData($counts)
            ->setLabels($names);
    }
}

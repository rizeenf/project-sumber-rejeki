<?php

namespace App\Charts;

use App\Models\HeaderVisit;
use App\Models\User;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\Auth;

class VisitChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        return $this->chart->barChart()
            ->setTitle('Grafik Kunjungan Toko vs Gerai')
            ->setSubtitle('Berdasarkan Kunjungan Anda')
            // DATA STORE
            ->addData('Toko', [
                HeaderVisit::selectRaw('month(date) as month, customers.type as cust_type,user_id')
                    ->join('customers', 'header_visits.customer_id', 'customers.id')
                    ->where('customers.type', 'S')
                    ->where('header_visits.user_id', Auth::user()->id)
                    ->whereMonth('date', date('m', strtotime('-3 months')))
                    ->count(),
                HeaderVisit::selectRaw('month(date) as month, customers.type as cust_type,user_id')
                    ->join('customers', 'header_visits.customer_id', 'customers.id')
                    ->where('customers.type', 'S')
                    ->where('header_visits.user_id', Auth::user()->id)
                    ->whereMonth('date', date('m', strtotime('-2 months')))
                    ->count(),
                HeaderVisit::selectRaw('month(date) as month, customers.type as cust_type,user_id')
                    ->join('customers', 'header_visits.customer_id', 'customers.id')
                    ->where('customers.type', 'S')
                    ->where('header_visits.user_id', Auth::user()->id)
                    ->whereMonth('date', date('m', strtotime('-1 months')))
                    ->count(),
                HeaderVisit::selectRaw('month(date) as month, customers.type as cust_type,user_id')
                    ->join('customers', 'header_visits.customer_id', 'customers.id')
                    ->where('customers.type', 'S')
                    ->where('header_visits.user_id', Auth::user()->id)
                    ->whereMonth('date', date('m'))
                    ->count()
            ])
            
            // DATA OUTLET
            ->addData('Gerai', [
                HeaderVisit::selectRaw('month(date) as month, customers.type as cust_type,user_id')
                    ->join('customers', 'header_visits.customer_id', 'customers.id')
                    ->where('customers.type', 'O')
                    ->where('header_visits.user_id', Auth::user()->id)
                    ->whereMonth('date', date('m', strtotime('-3 months')))
                    ->count(),
                HeaderVisit::selectRaw('month(date) as month, customers.type as cust_type,user_id')
                    ->join('customers', 'header_visits.customer_id', 'customers.id')
                    ->where('customers.type', 'O')
                    ->where('header_visits.user_id', Auth::user()->id)
                    ->whereMonth('date', date('m', strtotime('-2 months')))
                    ->count(),
                HeaderVisit::selectRaw('month(date) as month, customers.type as cust_type,user_id')
                    ->join('customers', 'header_visits.customer_id', 'customers.id')
                    ->where('customers.type', 'O')
                    ->where('header_visits.user_id', Auth::user()->id)
                    ->whereMonth('date', date('m', strtotime('-1 months')))
                    ->count(),
                HeaderVisit::selectRaw('month(date) as month, customers.type as cust_type,user_id')
                    ->join('customers', 'header_visits.customer_id', 'customers.id')
                    ->where('customers.type', 'O')
                    ->where('header_visits.user_id', Auth::user()->id)
                    ->whereMonth('date', date('m'))
                    ->count()
            ])
            // COLUMN
            ->setXAxis([
                date('M', strtotime('-3 months')),
                date('M', strtotime('-2 months')),
                date('M', strtotime('-1 months')),
                date('M'),
            ]);
    }
}

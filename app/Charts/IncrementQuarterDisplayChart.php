<?php

namespace App\Charts;

use App\Models\DetailStoreVisit;
use App\Models\DisplayProduct;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class IncrementQuarterDisplayChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        // COUNT(detail_store_visits.display_product_id) as count_display,
        //             detail_store_visits.display_product_id as display_id,
        //             display_products.name as display_name, 
        $display = DetailStoreVisit::selectRaw('
                    MONTHNAME(detail_store_visits.created_at) as month
                ')
                // ->join('display_products', 'display_products.id', 'detail_store_visits.display_product_id')
                ->whereBetween('detail_store_visits.created_at', [
                    date('Y-m-d', strtotime('-3 months')),
                    date('Y-m-t')
                ])
                // ->groupBy('display_product_id', 'display_name','month')
                ->groupBy('month')
                ->orderBy('month', 'DESC');
        $mDisplay = DisplayProduct::all();
        
        return $this->chart->barChart()
            ->setTitle('Peningkatan Pendataan Display')
            // ->setSubtitle('Wins during season 2021.')
            ->addData($mDisplay[0]->name, 
                array_map('intval',
                    DetailStoreVisit::selectRaw('
                        COUNT(detail_store_visits.display_product_id) as count_display,
                        detail_store_visits.display_product_id as display_id,
                        display_products.name as display_name, 
                        MONTHNAME(detail_store_visits.created_at) as month
                    ')
                    ->join('display_products', 'display_products.id', 'detail_store_visits.display_product_id')
                    ->whereBetween('detail_store_visits.created_at', [
                        date('Y-m-d', strtotime('-3 months')),
                        date('Y-m-t')
                    ])
                    ->groupBy('display_product_id', 'display_name','month')
                    ->orderBy('month', 'DESC')
                    ->where('display_product_id', $mDisplay[0]->id)
                    ->get()
                    ->pluck('count_display')
                    ->toArray()
                )
            )
            ->addData($mDisplay[1]->name, 
                array_map('intval',
                    DetailStoreVisit::selectRaw('
                        COUNT(detail_store_visits.display_product_id) as count_display,
                        detail_store_visits.display_product_id as display_id,
                        display_products.name as display_name, 
                        MONTHNAME(detail_store_visits.created_at) as month
                    ')
                    ->join('display_products', 'display_products.id', 'detail_store_visits.display_product_id')
                    ->whereBetween('detail_store_visits.created_at', [
                        date('Y-m-d', strtotime('-3 months')),
                        date('Y-m-t')
                    ])
                    ->groupBy('display_product_id', 'display_name','month')
                    ->orderBy('month', 'DESC')
                    ->where('display_product_id', $mDisplay[1]->id)
                    ->get()
                    ->pluck('count_display')
                    ->toArray()
                )
            )
            ->addData($mDisplay[2]->name, 
                array_map('intval',
                    DetailStoreVisit::selectRaw('
                        COUNT(detail_store_visits.display_product_id) as count_display,
                        detail_store_visits.display_product_id as display_id,
                        display_products.name as display_name, 
                        MONTHNAME(detail_store_visits.created_at) as month
                    ')
                    ->join('display_products', 'display_products.id', 'detail_store_visits.display_product_id')
                    ->whereBetween('detail_store_visits.created_at', [
                        date('Y-m-d', strtotime('-3 months')),
                        date('Y-m-t')
                    ])
                    ->groupBy('display_product_id', 'display_name','month')
                    ->orderBy('month', 'DESC')
                    ->where('display_product_id', $mDisplay[2]->id)
                    ->get()
                    ->pluck('count_display')
                    ->toArray()
                )
            )
            // ->addData('Boston', [7, 3, 8, 2, 6, 4])
            ->setXAxis(
                $display->get()->pluck('month')->toArray()
                // [
                    // date('F', ),
                    // date('F', mktime(null,null,null,2,null,null)),
                    // date('F', mktime(null,null,null,3,null,null)),
                // ]
            );
    }
}

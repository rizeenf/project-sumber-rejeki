<?php

namespace App\Charts;

use App\Models\DetailStoreVisit;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlyDisplayChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $category = DetailStoreVisit::selectRaw('
                COUNT(detail_store_visits.category_product_id) as count_category,
                detail_store_visits.category_product_id as category_id,
                category_products.name as category_name, 
                MONTHNAME(detail_store_visits.created_at) as month
            ')
            ->join('category_products', 'category_products.id', 'detail_store_visits.category_product_id')
            ->whereBetween('detail_store_visits.created_at', [
                date('Y-m-01'),
                date('Y-m-t')
            ])
            ->groupBy('category_product_id', 'category_name','month')
            ->orderBy('count_category', 'DESC')
            ->get();

        return $this->chart->pieChart()
            ->setTitle('Top Kategori Produk yang Terdisplay')
            // ->setSubtitle('Season 2021.')
            ->addData(array_map('intval',$category->pluck('count_category')->toArray()))
            ->setLabels($category->pluck('category_name')->toArray());
    }
}

<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Product::all();
        return Product::select('code', 
            'products.name as product_name',
            'description',
            'competitor',
            'competitor_name',
            'category_products.name as category',
            'brand_products.name as brand',
            'sub_brand_products.name as sub_brand',
            'products.status')
        ->leftjoin('category_products', 'category_products.id', 'products.category_product_id')
        ->leftjoin('brand_products', 'brand_products.id', 'products.brand_product_id')
        ->leftjoin('sub_brand_products', 'sub_brand_products.id', 'products.sub_brand_product_id')
        ->get();
    }

    public function headings(): array{
        return [
            'Kode',
            'Nama',
            'Deskripsi',
            'Kompetitor',
            'Nama Kompetitor',
            'Kategori Produk',
            'Brand Produk',
            'Sub Brand Produk',
            'Status'
        ];
    }
}

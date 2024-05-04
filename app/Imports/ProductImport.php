<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\SubBrandProduct;
use App\Models\CategoryProduct;
use App\Models\BrandProduct;

use Illuminate\Support\Facades\Auth;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class ProductImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $row){
            if(empty($row['Kode Produk'])){
                $row['Kode Produk'] = 'PROD'.date('dmyhis');
                $category = CategoryProduct::where('name', 'LIKE', '%'.$row['Kategori Produk'].'%')->first();
                $brand = BrandProduct::where('name', 'LIKE', '%'.$row['Brand Produk'].'%')->first();
                $subbrand = SubBrandProduct::where('name', 'LIKE', '%'.$row['Sub Brand Produk'].'%')->first();

                Product::create([
                    'code' => $row['Kode Produk'],
                    'name' => $row['Nama Produk'],
                    'description' => $row['Deskripsi'],
                    'competitor' => empty($row['Kompetitor']) ? 0 : $row['Kompetitor'],
                    'competitor_name' => $row['Nama Kompetitor'],
                    'category_product_id' => empty($category) ? NULL : $category->id,
                    'brand_product_id' => empty($brand) ? NULL : $brand->id,
                    'sub_brand_product_id' => empty($subbrand) ? NULL : $subbrand->id,
                    'status' => empty($row['Status']) ? 1 : $row['Status'],
                    'created_by' => Auth::user()->id,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }else{
                $product = Product::where('code', $row['Kode Produk'])->first();
                $category = CategoryProduct::where('name', 'LIKE', '%'.$row['Kategori Produk'].'%')->first();
                $brand = BrandProduct::where('name', 'LIKE', '%'.$row['Brand Produk'].'%')->first();
                $subbrand = SubBrandProduct::where('name', 'LIKE', '%'.$row['Sub Brand Produk'].'%')->first();
                
                if($product){
                    $product->update([
                        'name' => $row['Nama Produk'],
                        'description' => $row['Deskripsi'],
                        'competitor' => empty($row['Kompetitor']) ? 0 : $row['Kompetitor'],
                        'competitor_name' => $row['Nama Kompetitor'],
                        'category_product_id' => empty($category) ? NULL : $category->id,
                        'brand_product_id' => empty($brand) ? NULL : $brand->id,
                        'sub_brand_product_id' => empty($subbrand) ? NULL : $subbrand->id,
                        'status' => empty($row['Status']) ? 1 : $row['Status'],
                        'updated_by' => Auth::user()->id,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }else{
                    Product::create([
                        'code' => $row['Kode Produk'],
                        'name' => $row['Nama Produk'],
                        'description' => $row['Deskripsi'],
                        'competitor' => empty($row['Kompetitor']) ? 0 : $row['Kompetitor'],
                        'competitor_name' => $row['Nama Kompetitor'],
                        'category_product_id' => empty($category) ? NULL : $category->id,
                        'brand_product_id' => empty($brand) ? NULL : $brand->id,
                        'sub_brand_product_id' => empty($subbrand) ? NULL : $subbrand->id,
                        'status' => empty($row['Status']) ? 1 : $row['Status'],
                        'created_by' => Auth::user()->id,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                }
            }
        }
    }
}

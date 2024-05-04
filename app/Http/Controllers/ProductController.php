<?php

namespace App\Http\Controllers;

use App\Traits\ImageUploadTraits;

use App\Models\BrandProduct;
use App\Models\CategoryProduct;
use App\Models\SubBrandProduct;
use App\Models\Product;

use App\Datatables\ProductDataTable;
use App\Datatables\ProductTrashedDataTable;

use App\Exports\ProductExport;
use App\Imports\ProductImport;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Maatwebsite\Excel\Facades\Excel;
use File;

class ProductController extends Controller
{
    use ImageUploadTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable)
    {
        $categories = CategoryProduct::all();
        $brands = BrandProduct::all();
        $subBrands = SubBrandProduct::all();

        return $dataTable->render('product.index', compact('categories', 'brands', 'subBrands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CategoryProduct::all();
        $brands = BrandProduct::all();
        $subBrands = SubBrandProduct::all();

        return view('product.create', compact('categories', 'brands', 'subBrands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'image | mimes:jpeg,jpg,png',
            'name' => 'required | string',
            'competitor' => 'integer',
            'category' => 'integer',
            'brand' => 'integer',
            'sub_brand' => 'integer'
        ]);

        if(empty($request->code)){
            $request->code = 'PROD'.date('dmyhis');
        }

        if(empty($request->competitor)){
            $request->competitor = 0;
        }

        $product = new Product();

        // HANDLING FILE UPLOAD(IMAGE)
        $imagePath = $this->uploadImage($request, date('d-M-Y His'), $request->code, $request->name, 'image', 'uploads/product/');
        // dd($imagePath);
        $product->image = $imagePath;
        $product->code = $request->code;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->competitor = $request->competitor;
        $product->competitor_name = $request->competitor_name;
        $product->category_product_id = $request->category;
        $product->brand_product_id = $request->brand;
        $product->sub_brand_product_id = $request->sub_brand;
        $product->created_by = Auth::user()->id;
        $product->save();

        toastr()->success('Produk berhasil ditambahkan');
        
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = CategoryProduct::all();
        $brands = BrandProduct::all();
        $subBrands = SubBrandProduct::all();

        return view('product.edit', compact('product', 'categories', 'brands', 'subBrands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'image' => 'image | mimes:jpeg,jpg,png',
            'name' => 'required | string',
            'competitor' => 'integer',
            'category' => 'integer',
            'brand' => 'integer',
            'sub_brand' => 'integer'
        ]);

        if(empty($request->code)){
            $request->code = $codeProduct = 'PROD'.date('dmyhis');
        }

        if(empty($request->competitor)){
            $request->competitor = 0;
        }

        $product = Product::findOrFail($id);

        // HANDLING FILE UPLOAD(IMAGE)
        $imagePath = $this->updateImage($request, date('d-M-Y His'), $request->code, $request->name, 'image', 'uploads/product/', $product->image);
        
        $product->image = empty(!$imagePath) ? $imagePath : $product->image;
        $product->code = $request->code;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->competitor = $request->competitor;
        $product->competitor_name = $request->competitor_name;
        $product->category_product_id = $request->category;
        $product->brand_product_id = $request->brand;
        $product->sub_brand_product_id = $request->sub_brand;
        $product->updated_by = Auth::user()->id;
        $product->save();

        toastr()->success('Produk berhasil diubah');

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        // $this->deleteImage($product->image);
        $product->deleted_by = Auth::user()->id;
        $product->save();

        $product->delete();

        return response(['status' => 'success', 'message' => 'Produk berhasil dihapus']);
    }

    public function trashed(ProductTrashedDataTable $dataTable){
        return $dataTable->render('product.trashed');
    }

    public function restore($id){

        $product = Product::onlyTrashed()->findOrFail($id);
        $product->deleted_by = NULL;
        $product->save();
        $product->restore();

        toastr()->success('Produk berhasil dikembalikan');

        return redirect()->route('product.trashed');
    }

    public function forceDelete($id){
        
        $product = Product::onlyTrashed()->findOrFail($id);
        $this->deleteImage($product->image);
        $product->forceDelete();

        return response(['status' => 'success', 'message' => 'Produk berhasil dihapus permanen']);
    }

    public function export(){
        return Excel::download(new ProductExport, 'Ekspor Produk_'.date('d-M-Y H-i-s').'.xlsx');
    }

    public function import(Request $request){
        $request->validate([
            'import' => 'required | file',
        ]);
        Excel::import(new ProductImport, $request->file('import'));

        toastr()->success('Data produk berhasil diimpor');
        return redirect()->back();
    }

    public function downloadFormatImport($file_name){
        $file_path = public_path('format/'.$file_name);
        return response()->download($file_path);
    }

    public function autocomplete(Request $request){
        $data = [];

        if($request->filled('q')){
            $data = Product::select('name', 'id', 'code')
                    ->where('name', 'LIKE', '%'.$request->get('q').'%')
                    ->get();
        }

        return response()->json($data);
    }
}

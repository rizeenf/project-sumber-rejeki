<?php

namespace App\Http\Controllers;

use App\Models\BrandProduct;
use App\Models\CategoryProduct;
use App\Models\SubBrandProduct;

use App\Datatables\SubBrandProductDataTable;
use App\Datatables\SubBrandProductTrashedDataTable;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SubBrandProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubBrandProductDataTable $dataTable)
    {
        $categories = CategoryProduct::all();
        $brands = BrandProduct::all();

        return $dataTable->render('sub-brand.index', compact('categories', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CategoryProduct::all();
        $brands = BrandProduct::all();

        return view('sub-brand.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | max:100 | string',
            'category' => 'integer',
            'brand' => 'integer',
        ]);

        $subBrand = new SubBrandProduct();
        $subBrand->name = $request->name;
        $subBrand->category_product_id = $request->category;
        $subBrand->brand_product_id = $request->brand;
        $subBrand->created_by = Auth::user()->id;
        $subBrand->save();

        toastr()->success('Sub brand produk berhasil ditambahkan');

        return redirect()->route('sub-brand.index');
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
        $subBrand = SubBrandProduct::findOrFail($id);
        $categories = CategoryProduct::all();
        $brands = BrandProduct::all();

        return view('sub-brand.edit',compact('subBrand', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subBrand = SubBrandProduct::findOrFail($id);

        $request->validate([
            'name' => 'required | max:100 | string',
            'category' => 'integer',
            'brand' => 'integer',
        ]);

        $subBrand->name = $request->name;
        $subBrand->category_product_id = $request->category;
        $subBrand->brand_product_id = $request->brand;
        $subBrand->updated_by = Auth::user()->id;
        $subBrand->save();

        toastr()->success('Sub brand produk berhasil diubah');

        return redirect()->route('sub-brand.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subBrand = SubBrandProduct::findOrFail($id);
        $subBrand->deleted_by = Auth::user()->id;
        $subBrand->save();

        $subBrand->delete();

        return response(['status' => 'success', 'message' => 'Sub brand produk berhasil dihapus']);
    }

    public function trashed(SubBrandProductTrashedDataTable $dataTable){
        return $dataTable->render('sub-brand.trashed');
    }

    public function restore($id){

        $subBrand = SubBrandProduct::onlyTrashed()->findOrFail($id);
        $subBrand->deleted_by = NULL;
        $subBrand->save();
        $subBrand->restore();

        toastr()->success('Sub brand produk berhasil dikembalikan');

        return redirect()->route('sub-brand.trashed');
    }

    public function forceDelete($id){
        
        $subBrand = SubBrandProduct::onlyTrashed()->findOrFail($id);
        $subBrand->forceDelete();

        return response(['status' => 'success', 'message' => 'Sub brand produk berhasil dihapus permanen']);
    }
}

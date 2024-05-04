<?php

namespace App\Http\Controllers;

use App\Models\BrandProduct;
use App\Models\CategoryProduct;

use App\Datatables\BrandProductDataTable;
use App\Datatables\BrandProductTrashedDataTable;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BrandProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BrandProductDataTable $dataTable)
    {
        $categories = CategoryProduct::all();
        return $dataTable->render('brand.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CategoryProduct::all();

        return view('brand.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | max:100 | string',
            'category' => 'integer',
        ]);

        $brand = new BrandProduct();
        $brand->name = $request->name;
        $brand->category_product_id = $request->category;
        $brand->created_by = Auth::user()->id;
        $brand->save();

        toastr()->success('Brand produk berhasil ditambahkan');

        return redirect()->route('brand.index');
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
        $brand = BrandProduct::findOrFail($id);
        $categories = CategoryProduct::all();

        return view('brand.edit',compact('brand', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $brand = BrandProduct::findOrFail($id);

        $request->validate([
            'name' => 'required | max:100 | string',
            'category' => 'integer',
        ]);

        $brand->name = $request->name;
        $brand->category_product_id = $request->category;
        $brand->updated_by = Auth::user()->id;
        $brand->save();

        toastr()->success('Brand produk berhasil diubah');

        return redirect()->route('brand.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = BrandProduct::findOrFail($id);
        $brand->deleted_by = Auth::user()->id;
        $brand->save();

        $brand->delete();

        return response(['status' => 'success', 'message' => 'Brand produk berhasil dihapus']);
    }

    public function trashed(BrandProductTrashedDataTable $dataTable){
        return $dataTable->render('brand.trashed');
    }

    public function restore($id){

        $brand = BrandProduct::onlyTrashed()->findOrFail($id);
        $brand->deleted_by = NULL;
        $brand->save();
        $brand->restore();

        toastr()->success('Brand produk berhasil dikembalikan');

        return redirect()->route('brand.trashed');
    }

    public function forceDelete($id){
        
        $brand = BrandProduct::onlyTrashed()->findOrFail($id);
        $brand->forceDelete();

        return response(['status' => 'success', 'message' => 'Brand produk berhasil dihapus permanen']);
    }

    public function autocomplete(Request $request){
        $data = [];

        if($request->filled('q')){
            $data = BrandProduct::select('name', 'id')
                    ->where('name', 'LIKE', '%'.$request->get('q').'%')
                    ->get();
        }

        return response()->json($data);
    }
}

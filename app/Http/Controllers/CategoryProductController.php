<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;

use App\Datatables\CategoryProductDataTable;
use App\Datatables\CategoryProductTrashedDataTable;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryProductDataTable $dataTable)
    {
        return $dataTable->render('category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | max:100 | string',
        ]);

        $category = new CategoryProduct();
        $category->name = $request->name;
        $category->created_by = Auth::user()->id;
        $category->save();

        toastr()->success('Kategori produk berhasil ditambahkan');

        return redirect()->route('category.index');
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
        $category = CategoryProduct::findOrFail($id);

        return view('category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = CategoryProduct::findOrFail($id);

        $request->validate([
            'name' => 'required | max:100 | string',
        ]);

        $category->name = $request->name;
        $category->updated_by = Auth::user()->id;
        $category->save();

        toastr()->success('Kategori produk berhasil diubah');

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = CategoryProduct::findOrFail($id);
        $category->deleted_by = Auth::user()->id;
        $category->save();

        $category->delete();

        return response(['status' => 'success', 'message' => 'Kategori produk berhasil dihapus']);
    }

    public function trashed(CategoryProductTrashedDataTable $dataTable){
        return $dataTable->render('category.trashed');
    }

    public function restore($id){

        $category = CategoryProduct::onlyTrashed()->findOrFail($id);
        $category->deleted_by = NULL;
        $category->save();
        $category->restore();

        toastr()->success('Kategori produk berhasil dikembalikan');

        return redirect()->route('category.trashed');
    }

    public function forceDelete($id){
        
        $category = CategoryProduct::onlyTrashed()->findOrFail($id);
        $category->forceDelete();

        return response(['status' => 'success', 'message' => 'Kategori produk berhasil dihapus permanen']);
    }

    public function autocomplete(Request $request){
        $data = [];

        if($request->filled('q')){
            $data = CategoryProduct::select('name', 'id')
                    ->where('name', 'LIKE', '%'.$request->get('q').'%')
                    ->get();
        }

        return response()->json($data);
    }
}

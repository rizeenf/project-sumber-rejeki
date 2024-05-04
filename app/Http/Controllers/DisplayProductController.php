<?php

namespace App\Http\Controllers;

use App\Models\DisplayProduct;

use App\Datatables\DisplayProductDataTable;
use App\Datatables\DisplayProductTrashedDataTable;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DisplayProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(DisplayProductDataTable $dataTable)
    {
        return $dataTable->render('display.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('display.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | max:100 | string',
            'durability' => 'required | integer',
        ]);

        $display = new DisplayProduct();
        $display->name = $request->name;
        $display->durability = $request->durability;
        $display->created_by = Auth::user()->id;
        $display->save();

        toastr()->success('Display produk berhasil ditambahkan');

        return redirect()->route('display.index');
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
        $display = DisplayProduct::findOrFail($id);

        return view('display.edit',compact('display'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $display = DisplayProduct::findOrFail($id);

        $request->validate([
            'name' => 'required | max:100 | string',
            'durability' => 'required | integer',
        ]);

        $display->name = $request->name;
        $display->durability = $request->durability;
        $display->updated_by = Auth::user()->id;
        $display->save();

        toastr()->success('Display produk berhasil diubah');

        return redirect()->route('display.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $display = DisplayProduct::findOrFail($id);
        $display->deleted_by = Auth::user()->id;
        $display->save();

        $display->delete();

        return response(['status' => 'success', 'message' => 'Display produk berhasil dihapus']);
    }

    public function trashed(DisplayProductTrashedDataTable $dataTable){
        return $dataTable->render('display.trashed');
    }

    public function restore($id){

        $display = DisplayProduct::onlyTrashed()->findOrFail($id);
        $display->deleted_by = NULL;
        $display->save();
        $display->restore();

        toastr()->success('Display Produk berhasil dikembalikan');

        return redirect()->route('display.trashed');
    }

    public function forceDelete($id){
        
        $display = DisplayProduct::onlyTrashed()->findOrFail($id);
        $display->forceDelete();

        return response(['status' => 'success', 'message' => 'Display produk berhasil dihapus permanen']);
    }

    public function autocomplete(Request $request){
        $data = [];

        if($request->filled('q')){
            $data = DisplayProduct::select('name', 'id')
                    ->where('name', 'LIKE', '%'.$request->get('q').'%')
                    ->get();
        }

        return response()->json($data);
    }
}

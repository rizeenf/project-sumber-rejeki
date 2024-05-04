<?php

namespace App\Http\Controllers;

use App\Models\Position;

use App\Datatables\PositionDataTable;
use App\Datatables\PositionTrashedDataTable;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PositionDataTable $dataTable)
    {
        return $dataTable->render('position.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('position.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | max:100 | string',
        ]);

        $position = new Position();
        $position->name = $request->name;
        $position->created_by = Auth::user()->id;
        $position->save();

        toastr()->success('Jabatan berhasil ditambahkan');

        return redirect()->route('position.index');
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
        $position = Position::findOrFail($id);

        return view('position.edit',compact('position'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $position = Position::findOrFail($id);

        $request->validate([
            'name' => 'required | max:100 | string',
        ]);

        $position->name = $request->name;
        $position->updated_by = Auth::user()->id;
        $position->save();

        toastr()->success('Jabatan berhasil diubah');

        return redirect()->route('position.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $position = Position::findOrFail($id);
        $position->deleted_by = Auth::user()->id;
        $position->save();

        $position->delete();

        return response(['status' => 'success', 'message' => 'Jabatan berhasil dihapus']);
    }

    public function trashed(PositionTrashedDataTable $dataTable){
        return $dataTable->render('position.trashed');
    }

    public function restore($id){

        $position = Position::onlyTrashed()->findOrFail($id);
        $position->deleted_by = NULL;
        $position->save();
        $position->restore();

        toastr()->success('Jabatan berhasil dikembalikan');

        return redirect()->route('position.trashed');
    }

    public function forceDelete($id){
        
        $position = Position::onlyTrashed()->findOrFail($id);
        $position->forceDelete();

        return response(['status' => 'success', 'message' => 'Jabatan berhasil dihapus permanen']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Branch;

use App\Datatables\BranchDataTable;
use App\Datatables\BranchTrashedDataTable;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BranchDataTable $dataTable)
    {
        return $dataTable->render('branch.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('branch.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required | max:5 | string',
            'name' => 'required | max:100 | string',
        ]);

        $branch = new Branch();
        $branch->code = $request->code;
        $branch->name = $request->name;
        $branch->notes = $request->notes;
        $branch->created_by = Auth::user()->id;
        $branch->save();

        toastr()->success('Cabang berhasil ditambahkan');

        return redirect()->route('branch.index');
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
        $branch = Branch::findOrFail($id);

        return view('branch.edit',compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $branch = Branch::findOrFail($id);

        $request->validate([
            'code' => 'required | max:5 | string ',
            'name' => 'required | max:100 | string',
        ]);

        
        $branch->code = $request->code;
        $branch->name = $request->name;
        $branch->notes = $request->notes;
        $branch->updated_by = Auth::user()->id;
        $branch->save();

        toastr()->success('Cabang berhasil diubah');

        return redirect()->route('branch.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $branch = Branch::findOrFail($id);
        $branch->deleted_by = Auth::user()->id;
        $branch->save();

        $branch->delete();

        return response(['status' => 'success', 'message' => 'Cabang berhasil dihapus']);
    }

    public function trashed(BranchTrashedDataTable $dataTable){
        return $dataTable->render('branch.trashed');
    }

    public function restore($id){

        $branch = Branch::onlyTrashed()->findOrFail($id);
        $branch->deleted_by = NULL;
        $branch->save();
        $branch->restore();

        toastr()->success('Cabang berhasil dikembalikan');

        return redirect()->route('branch.trashed');
    }

    public function forceDelete($id){
        
        $branch = Branch::onlyTrashed()->findOrFail($id);
        $branch->forceDelete();

        return response(['status' => 'success', 'message' => 'Cabang berhasil dihapus permanen']);
    }
}

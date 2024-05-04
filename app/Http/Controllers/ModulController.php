<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use Spatie\Permission\Models\Permission;

use App\Datatables\ModulDataTable;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ModulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ModulDataTable $dataTable)
    {
        return $dataTable->render('modul.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modul.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $name = strtolower($request->name);

        $modul = new Modul();
        $modul->name = $name;
        $modul->view = empty($request->view) ? 0 : $request->view;
        $modul->detail = empty($request->detail) ? 0 : $request->detail;
        $modul->create = empty($request->create) ? 0 : $request->create;
        $modul->edit = empty($request->edit) ? 0 : $request->edit;
        $modul->delete = empty($request->delete) ? 0 : $request->delete;
        $modul->export = empty($request->export) ? 0 : $request->export;
        $modul->import = empty($request->import) ? 0 : $request->import;
        $modul->created_by = auth()->user()->id;
        $modul->save();

        if(!empty($request->view)){
            $permission = Permission::create(['name' => $name.' view']);
        }

        if(!empty($request->detail)){
            $permission = Permission::create(['name' => $name.' detail']);
        }

        if(!empty($request->create)){
            $permission = Permission::create(['name' => $name.' create']);
        }

        if(!empty($request->edit)){
            $permission = Permission::create(['name' => $name.' edit']);
        }

        if(!empty($request->delete)){
            $permission = Permission::create(['name' => $name.' delete']);
        }

        if(!empty($request->export)){
            $permission = Permission::create(['name' => $name.' export']);
        }

        if(!empty($request->import)){
            $permission = Permission::create(['name' => $name.' import']);
        }

        toastr()->success('Modul berhasil dibuat');

        return redirect()->route('modul.index');
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
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $modul = Modul::findOrFail($id);
        $permission = Permission::where('name', 'LIKE', '%'.$modul->name.'%')->get();

        foreach($permission as $row){
            $row->delete();
        }

        $modul->delete();

        return response(['status' => 'success', 'message' => 'Modul berhasil dihapus']);
    }
}

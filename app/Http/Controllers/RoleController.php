<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Modul;

use App\Datatables\RoleDataTable;
use App\Datatables\PermissionDataTable;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(RoleDataTable $dataTable)
    {
        return $dataTable->render('role.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        $moduls = Modul::all();

        return view('role.create', compact('permissions', 'moduls'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return dd($request->all());
        $request->validate([
            'name' => 'required'
        ]);

        $role = new Role();
        $role->name = $request->name;
        $role->save();

        if(!empty($request->view)){
            foreach($request->view as $row){
                // return $row;
                $role->givePermissionTo($row);
            }
        }

        if(!empty($request->detail)){
            foreach($request->detail as $row){
                // return $row;
                $role->givePermissionTo($row);
            }
        }

        if(!empty($request->create)){
            foreach($request->create as $row){
                // return $row;
                $role->givePermissionTo($row);
            }
        }

        if(!empty($request->edit)){
            foreach($request->edit as $row){
                // return $row;
                $role->givePermissionTo($row);
            }
        }

        if(!empty($request->delete)){
            foreach($request->delete as $row){
                // return $row;
                $role->givePermissionTo($row);
            }
        }

        if(!empty($request->export)){
            foreach($request->export as $row){
                // return $row;
                $role->givePermissionTo($row);
            }
        }

        if(!empty($request->import)){
            foreach($request->import as $row){
                // return $row;
                $role->givePermissionTo($row);
            }
        }

        toastr()->success('Grup akses berhasil dibuat');

        return redirect()->route('role.index');
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
    public function edit(string $id, PermissionDataTable $dataTable)
    {
        $role = Role::findOrFail($id);
        $moduls = Modul::all();
        // $modul = Modul::where('name', $role)->get();
        // $permissionsAccount = $role->getAllPermissions()->toArray();
        $permissionsAccount = $role->getAllPermissions();
        // $permissionAll = Permission::all();
        // $moduls = Modul::all();

        // return dd($permissionsAccount);
        // return collect($permissionsAccount)->contains('name', 'branch view');

        return view('role.edit', compact('role', 'moduls', 'permissionsAccount'));

        // return $dataTable->render('role.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // return dd($request->all());
        // return dd($request->view);
        $request->validate([
            'name' => 'required'
        ]);

        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->save();
        $permissionAccount = $role->getAllPermissions();

        if(!empty($request->view)){
            foreach($request->view as $row){
                // return $row;
                if($permissionAccount->contains('name', $row)){
                    continue;
                }

                $role->givePermissionTo($row);
            }
        }

        if(!empty($request->detail)){
            foreach($request->detail as $row){
                // return $row;
                if($permissionAccount->contains('name', $row)){
                    continue;
                }
                $role->givePermissionTo($row);
            }
        }

        if(!empty($request->create)){
            foreach($request->create as $row){
                // return $row;
                if($permissionAccount->contains('name', $row)){
                    continue;
                }
                $role->givePermissionTo($row);
            }
        }

        if(!empty($request->edit)){
            foreach($request->edit as $row){
                // return $row;
                if($permissionAccount->contains('name', $row)){
                    continue;
                }
                $role->givePermissionTo($row);
            }
        }

        if(!empty($request->delete)){
            foreach($request->delete as $row){
                // return $row;
                if($permissionAccount->contains('name', $row)){
                    continue;
                }
                $role->givePermissionTo($row);
            }
        }

        if(!empty($request->export)){
            foreach($request->export as $row){
                // return $row;
                if($permissionAccount->contains('name', $row)){
                    continue;
                }
                $role->givePermissionTo($row);
            }
        }

        if(!empty($request->import)){
            foreach($request->import as $row){
                // return $row;
                if($permissionAccount->contains('name', $row)){
                    continue;
                }
                $role->givePermissionTo($row);
            }
        }

        toastr()->success('Grup akses berhasil diubah');

        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $permission = $role->getAllPermissions();
        foreach($permission as $row){
            $role->revokePermissionTo($row->name);
        }

        $role->delete();

        return response(['status' => 'success', 'message' => 'Grup akses berhasil dihapus']);
    }

    public function resetPermission(string $id){
        $role = Role::findOrFail($id);
        $permissionAccount = $role->getAllPermissions();
        foreach($permissionAccount as $row){
            $role->revokePermissionTo($row);
        }

        toastr()->success('Grup akses berhasil direset');

        return redirect()->route('role.index');
    }
}

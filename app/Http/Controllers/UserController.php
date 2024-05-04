<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Position;
use Spatie\Permission\Models\Role;

use App\Datatables\UserDataTable;
use App\Datatables\UserTrashedDataTable;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Maatwebsite\Excel\Facades\Excel;
use File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $positions = Position::all();
        $roles = Role::all()->pluck('name');

        return view('user.create', compact('positions', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | max:100',
            'email' => 'required | email',
            'password' => ['required', 'confirmed'],
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->username = strtolower($request->username);
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->position_id = $request->position;
        $user->created_by = Auth::user()->id;
        $user->created_at = date('Y-m-d H:i:s');
        $user->save();

        toastr()->success('Pengguna berhasil ditambahkan');

        return redirect()->route('user.index');
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
        $user = User::findOrFail($id);
        $positions = Position::all();
        $roles = Role::all()->pluck('name');
        // return dd($user->getRoleNames);

        return view('user.edit', compact('user', 'positions', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required | max:100',
            'email' => 'required | email',
            'password' => ['required', 'confirmed'],
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->username = strtolower($request->username);
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->position_id = $request->position;
        $user->updated_by = Auth::user()->id;
        $user->updated_at = date('Y-m-d H:i:s');
        $user->save();

        $user->assignRole($request->access);

        toastr()->success('Pengguna berhasil diubah');

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);;
        $user->deleted_by = Auth::user()->id;
        $user->save();

        $user->delete();

        return response(['status' => 'success', 'message' => 'Pengguna berhasil dihapus']);
    }

    public function trashed(UserTrashedDataTable $dataTable){
        return $dataTable->render('user.trashed');
    }

    public function restore($id){

        $user = User::onlyTrashed()->findOrFail($id);
        $user->deleted_by = NULL;
        $user->save();
        $user->restore();

        toastr()->success('Pengguna berhasil dikembalikan');

        return redirect()->route('user.trashed');
    }

    public function forceDelete($id){
        
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();

        return response(['status' => 'success', 'message' => 'Pengguna berhasil dihapus permanen']);
    }
}

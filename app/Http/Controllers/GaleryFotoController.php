<?php

namespace App\Http\Controllers;

use App\Models\Foto;

use App\DataTables\Scopes\TypeFotoScope;
use App\Datatables\GaleryFotoDataTable;

use Illuminate\Http\Request;

class GaleryFotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GaleryFotoDataTable $dataTable, Request $request)
    {
        // return $dataTable->addScope(new TypeFotoScope($request))->render('galery.index');
        return $dataTable->render('galery.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Foto $foto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Foto $foto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Foto $foto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Foto $foto)
    {
        //
    }
}

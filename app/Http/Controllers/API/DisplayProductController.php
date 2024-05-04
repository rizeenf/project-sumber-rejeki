<?php

namespace App\Http\Controllers\API;

use App\Models\DisplayProduct;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DisplayProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $displays = DisplayProduct::all();

        return response()->json([
            'success' => true,
            'message' => 'list all display product',
            'data' => $displays
        ], 200);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

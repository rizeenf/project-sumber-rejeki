<?php

namespace App\Http\Controllers;

use App\Models\UnproductiveReason;

use App\Datatables\UnproductiveReasonDataTable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnproductiveReasonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UnproductiveReasonDataTable $dataTable)
    {
        return $dataTable->render('unproductive-reason.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('unproductive-reason.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required'
        ]);

        $reason = new UnproductiveReason();
        $reason->name = strtolower($request->name);
        $reason->type = $request->type;
        $reason->created_by = Auth::user()->id;
        $reason->created_at = date('Y-m-d H:i:s');
        $reason->save();

        toastr()->success('Alasan tidak produktif berhasil dibuat');

        return redirect()->route('unproductive-reason.index');
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
        $reason = UnproductiveReason::findOrFail($id);

        return view('unproductive-reason.edit', compact('reason'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required'
        ]);

        $reason = UnproductiveReason::findOrFail($id);
        $reason->name = strtolower($request->name);
        $reason->type = $request->type;
        $reason->created_by = Auth::user()->id;
        $reason->created_at = date('Y-m-d H:i:s');
        $reason->save();

        toastr()->success('Alasan tidak produktif berhasil diubah');

        return redirect()->route('unproductive-reason.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reason = UnproductiveReason::findOrFail($id);
        $reason->delete();

        return response(['status' => 'success', 'message' => 'Alasan tidak produktif berhasil dihapus']);
    }
}

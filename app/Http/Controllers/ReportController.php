<?php

namespace App\Http\Controllers;

use App\Models\HeaderVisit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use App\DataTables\UnproductiveVisitDataTable;
use App\DataTables\GiftingSampleDataTable;

use App\Exports\UnproductiveReasonVisitExport;
use App\Exports\GiftingSampleCustomerExport;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function UnproductiveReason(UnproductiveVisitDataTable $dataTable)
    {
        $users = User::all();
        return $dataTable->render('report.unproductive-visit', compact('users'));
    }

    public function ExportUnproductiveReason(Request $request){
        return Excel::download(new UnproductiveReasonVisitExport($request->start_date, $request->end_date, $request->staff, $request->type), 'Report Unproductive_Visit_'.date('d-M-Y H-i-s').'.xlsx');
    }

    public function GiftingCustomer(GiftingSampleDataTable $dataTable)
    {
        $users = User::all();
        return $dataTable->render('report.gifting-customer', compact('users'));
    }
    
    public function ExportGiftingCustomer(Request $request){
        return Excel::download(new GiftingSampleCustomerExport($request->start_date, $request->end_date, $request->staff), 'Report Pengeluaran_Hadiah atau Sampel_'.date('d-M-Y H-i-s').'.xlsx');
    }
}

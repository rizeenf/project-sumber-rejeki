<?php

namespace App\Http\Controllers;

use App\Datatables\LogActivityDataTable;

use Illuminate\Http\Request;

class LogActivityController extends Controller
{
    public function index(LogActivityDataTable $dataTable){
        return $dataTable->render('log-activity.index');
    }
}

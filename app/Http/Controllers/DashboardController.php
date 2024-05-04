<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use App\Models\HeaderVisit;
use App\Models\OutletVisitProduct;
use App\Models\DetailStoreVisit;

use App\Charts\VisitChart;
use App\Charts\MarketShareChart;
use App\Charts\IncrementQuarterDisplayChart;
use App\Charts\MonthlyDisplayChart;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class DashboardController extends Controller
{

    public function index(VisitChart $chartvisit, MarketShareChart $chartmarketshare, 
    IncrementQuarterDisplayChart $chartincrement, MonthlyDisplayChart $chartmonthlydisplay){
        $store = Customer::where('type', 'S')->get()->count();
        $outlet = Customer::where('type', 'O')->get()->count();
        $user = User::all()->count();
        $visit = HeaderVisit::where('user_id', Auth::user()->id)
            ->where('date', date('Y-m-d'))->get()->count();
        // $kategori = DetailStoreVisit::selectRaw('
        //     COUNT(detail_store_visits.category_product_id) as count_category,
        //     detail_store_visits.category_product_id as category_id,
        //     category_products.name as category_name, 
        //     MONTHNAME(detail_store_visits.created_at) as month
        // ')
        // ->join('category_products', 'category_products.id', 'detail_store_visits.category_product_id')
        // ->whereBetween('detail_store_visits.created_at', [
        //     date('Y-3-01'),
        //     date('Y-3-t')
        // ])
        // ->groupBy('category_product_id', 'category_name','month')
        // // ->where('category_product_id', '1')
        // ->get();
        // dd($kategori->toArray());

        return view('dashboard', ['chartvisit' => $chartvisit->build(), 
            'chartmarketshare' => $chartmarketshare->build(),
            'chartincrement' => $chartincrement->build(),
            'chartmonthlydisplay' => $chartmonthlydisplay->build()],
            compact('store', 'outlet', 'user', 'visit'));
    }
}

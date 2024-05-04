<?php

namespace App\Http\Controllers;

// Traits
use App\Traits\ImageUploadTraits;

// Datatable
use App\Datatables\SummaryVisitDatatable;
use App\Datatables\SummaryVisitSearchDatatable;
use App\Datatables\BreakdownVisitDailyDatatable;
use App\Datatables\BreakdownVisitDailyStoreDataTable;
use App\Datatables\BreakdownVisitDailyOutletDataTable;

// Scope
// use App\DataTables\Scopes\DateRangeVisit;

// Export
use App\Exports\ReportVisitStore;
use App\Exports\ReportVisitOutlet;

// Master
use App\Models\Customer;
use App\Models\BrandProduct;
use App\Models\CategoryProduct;
use App\Models\DisplayProduct;
use App\Models\Product;
use App\Models\UnproductiveReason;
use App\Models\User;

// Transaction
use App\Models\HeaderVisit;
use App\Models\DetailGiftVisit;
use App\Models\Foto;
use App\Models\DetailStoreVisit;
use App\Models\StoreVisitBrand;
use App\Models\StoreVisitUnproductiveReason;
use App\Models\DetailOutletVisit;
use App\Models\OutletVisitProduct;
use App\Models\OutletVisitUnproductiveReason;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Maatwebsite\Excel\Facades\Excel;
use File;

class VisitController extends Controller
{
    use ImageUploadTraits;

    public function list(String $type){
        $customers = Customer::where('type', $type)->orderBy('code', 'ASC')->paginate(12);
        
        return view('visit.list', compact('customers', 'type'));
    }

    public function searchList(String $type, Request $request){
        // dd($request->all());
        $customers = Customer::where('type', $type)
            ->where(function($query) use ($request){
                $query->where('code', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('name', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('area', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('subarea', 'LIKE', '%'.$request->search.'%');
            })
            ->paginate(12);
        // dd($customers);
        
        return view('visit.search-list', compact('customers', 'type'));
    }

    public function create(Request $request, $id){
        $customer = Customer::findOrFail($id);
        $reasons = UnproductiveReason::where('type', $customer->type)->get();
        $lastSerial = HeaderVisit::where('user_id', Auth::user()->id)
                        ->where('date', date('Y-m-d'))
                        ->orderBy('serial', 'DESC')
                        ->first();
        $cekVisit = HeaderVisit::where('user_id', Auth::user()->id)
                        ->where('date', date('Y-m-d'))
                        ->where('customer_id', $id)
                        ->where('time_out', NULL)
                        ->get();
        $generalVisit = '';
        // dd($lastSerial->serial);

        if(!$cekVisit->isEmpty()){
            $generalVisit = HeaderVisit::where('user_id', Auth::user()->id)
                            ->where('date', date('Y-m-d'))
                            ->where('customer_id', $id)
                            ->first();
                            // dd($generalVisit);
            
            return view('visit.create', compact('customer', 'reasons', 'generalVisit'));
        }else{
            $generalVisit = new HeaderVisit();
            $generalVisit->date = date('Y-m-d');
            $generalVisit->serial = empty($lastSerial) ? 1 : $lastSerial->serial+1;
            $generalVisit->time_in = date('H:i:s');
            $generalVisit->customer_id = $id;
            $generalVisit->user_id = Auth::user()->id;
            $generalVisit->created_at = date('Y-m-d H:i:s');
            $generalVisit->save();
            $generalVisit->get();
            // dd($generalVisit);

            return view('visit.create', compact('customer', 'reasons', 'generalVisit'));
        }
        
    }

    public function store(Request $request, String $id){
        $request->validate([
            'photo_visit' => 'required | image | mimes:jpeg,jpg,png',
            'activity' => 'required',
            'banner' => 'required'
        ]);

        $generalVisit = HeaderVisit::findOrFail($id);
        $customer = Customer::findOrFail($request->id_customer);
        
        if(empty($customer->LA) && empty($customer->LA)){
            $customer->LA = $request->lat;
            $customer->LO = $request->lon;
            $customer->save();
        }

        if($customer->type == 'O'){
            $customer->status_registration = $request->status;
            $customer->save();
        }

        if(empty($customer->photo) && !empty($request->photo_visit)){
            $imagePath = $this->updateImage($request, date('d-M-Y His'), $customer->code, $customer->name, 'photo_visit', 'uploads/customer/');
            $customer->photo = empty(!$imagePath) ? $imagePath : $customer->photo;
            $customer->save();
        }

        if(!empty($request->photo_visit)){
            $imagePathVisit = $this->uploadImage($request, date('d-M-Y His'), $request->code, $request->name, 'photo_visit', 'uploads/visit/');

            $fotoVisit = Foto::insert([
                'header_visit_id' => $id,
                'file_name' => $imagePathVisit,
                'file_size' => Image::make($request->photo_visit)->filesize(),
                'type' => 'V',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        if(!empty($request->other_reason)){
            $unproductiveReason = UnproductiveReason::insert([
                'name' => strtolower($request->name_other_reason),
                'type' => $customer->type,
                'created_by' => Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            $lastUnproductive = UnproductiveReason::latest()->first();
            $storeVisitUnproductiveReason = StoreVisitUnproductiveReason::insert([
                'header_visit_id' => $id,
                'unproductive_reason_id' => $lastUnproductive->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

        }

        $generalVisit->time_out = date('H:i:s');
        $generalVisit->LA = $request->lat;
        $generalVisit->LO = $request->lon;
        $generalVisit->banner = $request->banner;
        $generalVisit->status_registration = empty($request->status) ? 'N' : $request->status;
        $generalVisit->activity = $request->activity;
        $generalVisit->note = $request->note;
        $generalVisit->updated_at = date('Y-m-d H:i:s');
        $generalVisit->save();

        if($customer->type == 'S'){
            if(!empty($request->display) && !empty($request->category)){
                if(count($request->display) > count($request->category)){
                    foreach($request->display as $number => $row){
                        $detailStoreVisit = DetailStoreVisit::insert([
                            'header_visit_id' => $id,
                            'category_product_id' => empty($request->category[$number]) ? $request->category[$number-1] : $request->category[$number],
                            'display_product_id' => $row,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);
                    }
                }else{
                    foreach($request->category as $number => $row){
                        $detailStoreVisit = DetailStoreVisit::insert([
                            'header_visit_id' => $id,
                            'category_product_id' => $row,
                            'display_product_id' => empty($request->display[$number]) ? $request->display[$number-1] : $request->display[$number],
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);
                    }
                }
            }

            if(!empty($request->brand)){
                foreach($request->brand as $row){
                    $storeVisitBrand = StoreVisitBrand::insert([
                        'header_visit_id' => $id,
                        'brand_product_id' => $row,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }
            }

            if(!empty($request->reason)){
                foreach($request->reason as $row){
                    $storeVisitUnproductiveReason = StoreVisitUnproductiveReason::insert([
                        'header_visit_id' => $id,
                        'unproductive_reason_id' => $row,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }
            }

            if(!empty($request->photo_display)){
                $imagePathDisplay = $this->uploadImage($request, date('d-M-Y His'), $request->code, $request->name, 'photo_display', 'uploads/display/');

                $fotoDisplay = Foto::insert([
                    'header_visit_id' => $id,
                    'file_name' => $imagePathDisplay,
                    'file_size' => Image::make($request->photo_display)->filesize(),
                    'type' => 'D',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }

            toastr()->success('Data kunjungan toko berhasil disimpan');
            
            return redirect()->route('dashboard');
        }else{
            // dd($request->all());
            $detailOutletVisit = new DetailOutletVisit();
            $detailOutletVisit->header_visit_id = $id;
            $detailOutletVisit->sales_amount = $request->sales_amount;
            $detailOutletVisit->customer_id = $request->store;
            $detailOutletVisit->store_name = $request->store_name;
            $detailOutletVisit->market_name = $request->market_name;
            $detailOutletVisit->mark = $request->mark;
            $detailOutletVisit->created_at = date('Y-m-d H:i:s');
            $detailOutletVisit->updated_at = date('Y-m-d H:i:s');
            $detailOutletVisit->save();

            $purchaseAmount = explode(',', $request->purchaseAmount);
            $qtySample = explode(',', $request->qty_sample);

            if(!empty($request->usedProduct)){
                foreach($request->usedProduct as $number => $row){
                    $outletVisitProduct = OutletVisitProduct::insert([
                        'header_visit_id' => $id,
                        'product_id' => $row,
                        'purchase_price' => $purchaseAmount[$number],
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }
            }

            if(!empty($request->reason)){
                foreach($request->reason as $number => $row){
                    $outletVisitUnproductiveReason = OutletVisitUnproductiveReason::insert([
                        'header_visit_id' => $id,
                        'unproductive_reason_id' => $row,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }
            }

            if(!empty($request->sample)){
                foreach($request->sample as $number => $row){
                    $detailGiftVisit = DetailGiftVisit::insert([
                        'header_visit_id' => $id,
                        'product_id' => $row,
                        'qty' => $qtySample[$number],
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }
            }

            if(!empty($request->photo_sample)){
                $imagePathDisplay = $this->uploadImage($request, date('d-M-Y His'), $request->code, $request->name, 'photo_sample', 'uploads/sample/');

                $fotoDisplay = Foto::insert([
                    'header_visit_id' => $id,
                    'file_name' => $imagePathDisplay,
                    'file_size' => Image::make($request->photo_sample)->filesize(),
                    'type' => 'S',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }

            toastr()->success('Data kunjungan gerai berhasil disimpan');
            
            return redirect()->route('dashboard');
        }
    }

    public function SummaryVisit(SummaryVisitDatatable $dataTable){
        $users = User::all();
        // return $dataTable->with(['from' => date('Y-m-01'), 'to' => date('Y-m-t')])->render('visit.summary', compact('users'));
        return $dataTable->render('visit.summary', compact('users'));
    }

    public function SummaryVisitSearch(SummaryVisitSearchDatatable $dataTable, Request $request){
        // dd($request->all());
        $from = $request->from;
        $to = $request->to;
        return $dataTable->with(['from' => $from, 'to' => $to])->render('visit.summary-search');
    }

    public function DailyVisit(BreakdownVisitDailyDatatable $dataTable, $date, $user){
        $headerVisit = HeaderVisit::selectRaw(
            'header_visits.date as date,
            header_visits.user_id as user_id, 
            users.name as user_name,
            min(header_visits.time_in) as min_time_in,
            max(header_visits.time_out) as max_time_out,
            count(distinct header_visits.serial) as total_visit,
            count(case customers.type when "S" then 1 else NULL end) as store_visit,
            count(case customers.type when "O" then 1 else NULL end) as outlet_visit'
            // count(case fotos.type when "V" then 1 else NULL end) as visit_foto'
        )
        ->groupBy('header_visits.date', 'header_visits.user_id', 'users.name')
        ->join('users', 'header_visits.user_id', '=', 'users.id')
        ->join('customers', 'header_visits.customer_id', '=', 'customers.id')
        // ->leftjoin('fotos', 'header_visits.id', 'fotos.header_visit_id')
        ->where('date', $date)
        ->where('header_visits.user_id', $user)->first();
        // dd($headerVisit);
        return $dataTable->with(['date' => $date, 'user' => $user])->render('visit.header-daily', compact('headerVisit'));
    }

    public function DailyVisitStore(BreakdownVisitDailyStoreDataTable $dataTable, $date, $user){
        $headerVisit = HeaderVisit::selectRaw(
            'header_visits.date as date,
            header_visits.user_id as user_id, 
            users.name as user_name,
            min(header_visits.time_in) as min_time_in,
            max(header_visits.time_out) as max_time_out,
            count(distinct header_visits.customer_id) as total_visit,
            count(case customers.type when "S" then 1 else NULL end) as store_visit,
            count(case customers.type when "O" then 1 else NULL end) as outlet_visit'
            // count(case fotos.type when "V" then 1 else NULL end) as visit_foto'
        )
        ->groupBy('header_visits.date', 'header_visits.user_id', 'users.name')
        ->join('users', 'header_visits.user_id', '=', 'users.id')
        ->join('customers', 'header_visits.customer_id', '=', 'customers.id')
        // ->leftjoin('fotos', 'header_visits.id', 'fotos.header_visit_id')
        ->where('date', $date)
        ->where('header_visits.user_id', $user)->first();
        // dd($headerVisit);
        return $dataTable->with(['date' => $date, 'user' => $user])->render('visit.store-daily', compact('headerVisit'));
    }

    public function DailyVisitOutlet(BreakdownVisitDailyOutletDataTable $dataTable, $date, $user){
        $headerVisit = HeaderVisit::selectRaw(
            'header_visits.date as date,
            header_visits.user_id as user_id, 
            users.name as user_name,
            min(header_visits.time_in) as min_time_in,
            max(header_visits.time_out) as max_time_out,
            count(distinct header_visits.customer_id) as total_visit,
            count(case customers.type when "S" then 1 else NULL end) as store_visit,
            count(case customers.type when "O" then 1 else NULL end) as outlet_visit'
            // count(case fotos.type when "V" then 1 else NULL end) as visit_foto'
        )
        ->groupBy('header_visits.date', 'header_visits.user_id', 'users.name')
        ->join('users', 'header_visits.user_id', '=', 'users.id')
        ->join('customers', 'header_visits.customer_id', '=', 'customers.id')
        // ->leftjoin('fotos', 'header_visits.id', 'fotos.header_visit_id')
        ->where('date', $date)
        ->where('header_visits.user_id', $user)->first();
        // dd($headerVisit);
        return $dataTable->with(['date' => $date, 'user' => $user])->render('visit.outlet-daily', compact('headerVisit'));
    }
    
    public function StoreExport(Request $request){
        // empty($request->start_date) ? $request->start_date = date('Y-m-01') : $request->start_date;
        // empty($request->end_date) ? $request->end_date = date('Y-m-t') : $request->end_date;
        // return Excel::download(new ReportVisitStore($request->start_date, $request->end_date), 'Report Visit_Toko_'.date('d-M-Y H-i-s').'.xlsx');
        return Excel::download(new ReportVisitStore, 'Report Visit_Toko_'.date('d-M-Y H-i-s').'.xlsx');
    }

    public function OutletExport(){
        return Excel::download(new ReportVisitOutlet, 'Report Visit_Gerai_'.date('d-M-Y H-i-s').'.xlsx');
    }
}

<?php

namespace App\DataTables;

use App\Models\HeaderVisit;
use App\Models\DetailOutletVisit;
use App\Models\DetailGiftVisit;
use App\Models\Foto;
use App\Models\OutletVisitProduct;
use App\Models\OutletVisitUnproductiveReason;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BreakdownVisitDailyOutletDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function($query){
                // $btnShow = "<a class='btn btn-info' href='".route('visit.detail-daily', ['date' => $query->date, 'user' => $query->user_id])."'>Detail </a>";
                // $btnEdit = "<a class='btn btn-warning' href='".route('unproductive-reason.edit', $query->date)."'>Ubah </a>";
                // $btnDelete = "<a class='btn btn-danger delete-item' href='".route('unproductive-reason.destroy', $query->date)."'>Hapus </a>";

                // return $btnShow.$btnEdit.$btnDelete;
                // return $btnEdit.$btnDelete;
                // return $btnShow;
            })
            ->addColumn('status', function($query){
                $active = '<i class="badge badge-success">Active</i>';
                $inactive = '<i class="badge badge-danger">Inactive</i>';

                if($query->status == 1){
                    // return $active;
                    return 'Active';
                }else{
                    // return $inactive;
                    return 'Inactive';
                }
            })
            ->addColumn('type_customer', function($query){
                return $query->customer->type == 'S' ? 'Toko' : 'Gerai';
            })
            ->addColumn('user', function($query){
                return $query->user->name;
            })
            ->addColumn('code_customer', function($query){
                return $query->customer->code;
            })
            ->addColumn('name_customer', function($query){
                return $query->customer->name;
            })
            ->addColumn('address_customer', function($query){
                return $query->customer->address;
            })
            ->addColumn('cekin', function($query){
                return $query->time_in;
            })
            ->addColumn('cekout', function($query){
                if(empty($query->time_out)){
                    return 'Belum Selesai Kunjungan';
                }else{
                    return $query->time_out;
                }
            })
            // ->addColumn('display_foto', function($query){
            //     if(!empty($query->foto->where('type', 'D')->first()->file_name)){
            //         return "<img src='".asset($query->foto->where('type', 'D')->first()->file_name)."' 
            //         width='50' id='myImg' class='myImg' alt='".$query->customer->code." - ".$query->customer->name."'>";
            //     }
            // })
            // ->addColumn('display', function($query){
            //     $data ='';
            //     $display = DetailOutletVisit::where('header_visit_id', $query->id)->distinct()->get('display_product_id');
            //     foreach($display as $number => $row){
            //         $data .= $number == 0 ? $row->display->name : ', '.$row->display->name;
            //     }
            //     return $data;
            // })
            ->addColumn('sales_amount', function($query){
                $data = DetailOutletVisit::where('header_visit_id', $query->id)->get();
                foreach($data as $number => $row){
                    return $row->sales_amount;
                }
            })
            ->addColumn('code_store', function($query){
                $data = DetailOutletVisit::where('header_visit_id', $query->id)->get();
                foreach($data as $number => $row){
                    return empty($row->store->code) ? '' : $row->store->code.' - '.$row->store->name;
                }
            })
            ->addColumn('store_name', function($query){
                $data = DetailOutletVisit::where('header_visit_id', $query->id)->get();
                foreach($data as $number => $row){
                    return $row->store_name;
                }
            })
            ->addColumn('market_name', function($query){
                $data = DetailOutletVisit::where('header_visit_id', $query->id)->get();
                foreach($data as $number => $row){
                    return $row->market_name;
                }
            })
            ->addColumn('mark', function($query){
                $data = DetailOutletVisit::where('header_visit_id', $query->id)->get();
                foreach($data as $number => $row){
                    return $row->mark;
                }
            })
            ->addColumn('used_product', function($query){
                $data ='';
                $product = OutletVisitProduct::where('header_visit_id', $query->id)->get();
                foreach($product as $number => $row){
                    $data .= $number == 0 ? $row->product->name : ', '.$row->product->name;
                }
                return $data;
            })
            ->addColumn('product_price', function($query){
                $data ='';
                $product = OutletVisitProduct::where('header_visit_id', $query->id)->get();
                foreach($product as $number => $row){
                    $data .= $number == 0 ? $row->purchase_price : ', '.$row->purchase_price;
                }
                return $data;
            })
            ->addColumn('unproductive_reason', function($query){
                $data ='';
                $product = OutletVisitUnproductiveReason::where('header_visit_id', $query->id)->get();
                foreach($product as $number => $row){
                    $data .= $number == 0 ? $row->unproductive_reason->name : ', '.$row->unproductive_reason->name;
                }
                return $data;
            })
            ->addColumn('sample', function($query){
                $data ='';
                $product = DetailGiftVisit::where('header_visit_id', $query->id)->get();
                foreach($product as $number => $row){
                    $data .= $number == 0 ? $row->product->name : ', '.$row->product->name;
                }
                return $data;
            })
            ->addColumn('qty_sample', function($query){
                $data ='';
                $product = DetailGiftVisit::where('header_visit_id', $query->id)->get();
                foreach($product as $number => $row){
                    $data .= $number == 0 ? $row->qty : ', '.$row->qty;
                }
                return $data;
            })
            ->addColumn('sample_foto', function($query){
                if(!empty($query->foto->where('type', 'S')->first()->file_name)){
                    return "<img src='".asset($query->foto->where('type', 'S')->first()->file_name)."' 
                    width='50' id='myImg' class='myImg' alt='".$query->customer->code." - ".$query->customer->name."'>";
                }
            })
            ->rawColumns(['action', 'status', 'sample_foto']);
            // ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(HeaderVisit $model): QueryBuilder
    {
        $date = $this->date;
        $user = $this->user;
        return $model->newQuery()
            ->with('detail_store.display')
            ->where('date', $date)
            ->where('user_id', $user)
            ->whereHas('customer', function($query){
                $query->where('type', 'O');
            })
            ->orderBy('serial', 'ASC');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('breakdownvisitdailyoutlet-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    // ->dom("Bfrtlip")
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->responsive()
                    ->parameters(["scrollX" => true])
                    ->buttons([
                        // Button::make('excel'),
                        // Button::make('csv'),
                        // Button::make('pdf'),
                        // Button::make('print'),
                        // Button::make('reset'),
                        // Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            ['data' => 'serial', 'title' => 'urutan'],
            ['data' => 'code_customer', 'title' => 'kode'],
            ['data' => 'name_customer', 'title' => 'nama'],
            ['data' => 'sales_amount', 'title' => 'qty jual perhari'],
            ['data' => 'code_store', 'title' => 'toko terdaftar'],
            ['data' => 'store_name', 'title' => 'nama toko'],
            ['data' => 'market_name', 'title' => 'nama pasar'],
            ['data' => 'mark', 'title' => 'patokan'],
            ['data' => 'used_product', 'title' => 'produk yang dipakai'],
            ['data' => 'product_price', 'title' => 'harga produk'],
            ['data' => 'unproductive_reason', 'title' => 'alasan belum pakai'],
            ['data' => 'sample', 'title' => 'sampel'],
            ['data' => 'qty_sample', 'title' => 'qty sampel'],
            ['data' => 'sample_foto', 'title' => 'penyerahan sampel'],
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'BreakdownVisitDailyOutlet_' . date('YmdHis');
    }
}

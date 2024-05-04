<?php

namespace App\DataTables;

use App\Models\HeaderVisit;
use App\Models\DetailStoreVisit;
use App\Models\Foto;
use App\Models\StoreVisitBrand;
use App\Models\StoreVisitUnproductiveReason;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BreakdownVisitDailyStoreDataTable extends DataTable
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
            ->addColumn('display_foto', function($query){
                if(!empty($query->foto->where('type', 'D')->first()->file_name)){
                    return "<img src='".asset($query->foto->where('type', 'D')->first()->file_name)."' 
                    width='50' id='myImg' class='myImg' alt='".$query->customer->code." - ".$query->customer->name."'>";
                }
            })
            ->addColumn('display', function($query){
                $data ='';
                $display = DetailStoreVisit::where('header_visit_id', $query->id)->distinct()->get('display_product_id');
                foreach($display as $number => $row){
                    $data .= $number == 0 ? $row->display->name : ', '.$row->display->name;
                }
                return $data;
            })
            ->addColumn('category', function($query){
                $data ='';
                $display = DetailStoreVisit::where('header_visit_id', $query->id)->distinct()->get('category_product_id');
                foreach($display as $number => $row){
                    $data .= $number == 0 ? $row->category->name : ', '.$row->category->name;
                }
                return $data;
            })
            ->addColumn('brand', function($query){
                $data ='';
                $display = StoreVisitBrand::where('header_visit_id', $query->id)->distinct()->get('brand_product_id');
                foreach($display as $number => $row){
                    $data .= $number == 0 ? $row->brand->name : ', '.$row->brand->name;
                }
                return $data;
            })
            ->addColumn('store_unproductive', function($query){
                $data ='';
                $display = StoreVisitUnproductiveReason::where('header_visit_id', $query->id)->distinct()->get('unproductive_reason_id');
                foreach($display as $number => $row){
                    $data .= $number == 0 ? ucfirst($row->unproductive_reason->name) : ', '.ucfirst($row->unproductive_reason->name);
                }
                return $data;
            })
            ->rawColumns(['action', 'status', 'display_foto']);
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
                $query->where('type', 'S');
            })
            ->orderBy('serial', 'ASC');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('breakdownvisitdailystore-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
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
            ['data' => 'display', 'title' => 'display'],
            ['data' => 'category', 'title' => 'kategori'],
            ['data' => 'brand', 'title' => 'stok tersedia'],
            ['data' => 'store_unproductive', 'title' => 'alasan tidak display'],
            ['data' => 'display_foto', 'title' => 'foto display'],
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'BreakdownVisitDailyStore_' . date('YmdHis');
    }
}

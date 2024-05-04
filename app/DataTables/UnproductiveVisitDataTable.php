<?php

namespace App\DataTables;

use App\Models\HeaderVisit;
use App\Models\StoreVisitUnproductiveReason;
use App\Models\OutletVisitUnproductiveReason;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\Request;

class UnproductiveVisitDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query, Request $request): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('type', function($query){
                $type = $query->customer->type;
                return $type == 'S' ? 'Toko' : 'Gerai';
            })
            ->addColumn('date', function($query){
                // return date('d-m-Y', strtotime($query->date));
                return $query->date;
            })
            ->addColumn('code', function($query){
                return $query->customer->code != null ? $query->customer->code : '';
            })
            ->addColumn('cust_name', function($query){
                return $query->customer->name != null ? $query->customer->name : '';
            })
            ->addColumn('staff', function($query){
                return $query->user->name != null ? $query->user->name : '';
            })
            ->addColumn('reason', function($query){
                $type = $query->customer->type;
                $data ='';
                if($type == 'S'){
                    $reason = StoreVisitUnproductiveReason::where('header_visit_id', $query->id)->get();
                    foreach($reason as $number => $row){
                        $data .= $number == 0 ? $row->unproductive_reason->name : ', '.$row->unproductive_reason->name;
                    }
                }
                else{
                    $reason = OutletVisitUnproductiveReason::where('header_visit_id', $query->id)->get();
                    foreach($reason as $number => $row){
                        $data .= $number == 0 ? $row->unproductive_reason->name : ', '.$row->unproductive_reason->name;
                    }
                }
                return $data;
            })
            ->filter(function ($instance) use ($request) {
                if (!empty($request->get('start_date'))) {
                    $instance->whereBetween('date', [$request->get('start_date'),$request->get('end_date') ]);
                }
                if (!empty($request->get('end_date'))) {
                    $instance->whereBetween('date', [$request->get('start_date'),$request->get('end_date') ]);
                }
                if (!empty($request->get('staff'))) {
                    $instance->where('user_id', $request->get('staff'));
                }
                if (!empty($request->get('type'))) {
                    $instance->whereHas('customer', function($query) use ($request){
                        $query->where('type', $request->get('type'));
                    });
                }
                if (!empty($request->get('search'))) {
                    $search = $request->get('search');
                    $instance->whereHas('customer', function($query) use ($search){
                        $query->where('code', 'LIKE', "%$search%")
                            ->orWhere('name', 'LIKE', "%$search%");
                    });
               }
            })
            ->addColumn('action', function($query){
                // $btnShow = "<a class='btn btn-info' href='".route('visit.detail-daily', ['date' => $query->date, 'user' => $query->user_id])."'>Detail </a>";
                // $btnEdit = "<a class='btn btn-warning' href='".route('unproductive-reason.edit', $query->date)."'>Ubah </a>";
                // $btnDelete = "<a class='btn btn-danger delete-item' href='".route('unproductive-reason.destroy', $query->date)."'>Hapus </a>";

                // return $btnShow.$btnEdit.$btnDelete;
                // return $btnEdit.$btnDelete;
                // return $btnShow;
            })
            // ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(HeaderVisit $model): QueryBuilder
    {
        return $model->newQuery()
            ->with('user')
            ->with('customer')
            ->with('store_reason')
            ->with('outlet_reason')
            ->orWhereHas('store_reason', function($query){
                $query->where('unproductive_reason_id', '!=', null);
            })
            ->orWhereHas('outlet_reason', function($query){
                $query->where('unproductive_reason_id', '!=', null);
            });
            // ->whereBetween('date', [date('Y-m-01'), date('Y-m-t')]);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('unproductivevisit-table')
                    ->columns($this->getColumns())
                    // ->minifiedAjax()
                    ->ajax([
                        'url'  => route('report-unproductive'),
                        'type' => 'GET',
                        'data' => "function(data){
                            data.start_date = $('input[name=start_date]').val(),
                            data.end_date = $('input[name=end_date]').val(),
                            data.staff = $('select[name=staff]').val(),
                            data.type = $('select[name=type]').val(),
                            data.search = $('input[type=search]').val();
                        }"
                    ])
                    //->dom('Bfrtip')
                    // ->dom('lBrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->responsive()
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
            ['data' => 'DT_RowIndex', 'title' => '#', 'class' => 'text-center', 
            'exportable' => false, 'printable' => false, 'searchable' => false, 'visible' => true],
            ['data' => 'date', 'title' => 'tanggal'],
            ['data' => 'staff', 'title' => 'nama staff'],
            ['data' => 'code', 'title' => 'kode'],
            ['data' => 'cust_name', 'title' => 'nama'],
            ['data' => 'type', 'title' => 'tipe'],
            ['data' => 'reason', 'title' => 'alasan tidak produktif'],
            // ['data' => 'action', 'title' => 'aksi', 'class' => 'text-center', 
            // 'exportable' => false, 'printable' => false, 'searchable' => false]
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'UnproductiveVisit_' . date('YmdHis');
    }
}

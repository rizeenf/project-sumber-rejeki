<?php

namespace App\DataTables;

use App\Models\HeaderVisit;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class SummaryVisitDataTable extends DataTable
{
    // protected $exportColumns = [
    //     ['data' => 'date', 'title' => 'tanggal'],
    //     ['data' => 'user', 'title' => 'nama staff'],
    // ];
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query, Request $request): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->filter(function ($instance) use ($request) {
                if (!empty($request->get('start_date'))) {
                    $instance->whereBetween('date', [$request->get('start_date'),$request->get('end_date') ]);
                }
                if (!empty($request->get('end_date'))) {
                    $instance->whereBetween('date', [$request->get('start_date'),$request->get('end_date') ]);
                }
                if (!empty($request->get('staff'))) {
                    $instance->where('header_visits.user_id', $request->get('staff'));
                }
                if (!empty($request->get('search'))) {
                    $instance->where(function($w) use($request){
                       $search = $request->get('search');
                       $w->orWhere('username', 'LIKE', "%$search%");
                   });
               }
            })
            ->addColumn('action', function($query){
                $btnShow = "<a class='btn btn-info' href='".route('visit.detail-daily', ['date' => $query->date, 'user' => $query->user_id])."'>Detail </a>";
                // $btnEdit = "<a class='btn btn-warning' href='".route('unproductive-reason.edit', $query->date)."'>Ubah </a>";
                // $btnDelete = "<a class='btn btn-danger delete-item' href='".route('unproductive-reason.destroy', $query->date)."'>Hapus </a>";

                // return $btnShow.$btnEdit.$btnDelete;
                // return $btnEdit.$btnDelete;
                return $btnShow;
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
            ->addColumn('type', function($query){
                return $query->type == 'S' ? 'Toko' : 'Gerai';
            })
            ->addColumn('user', function($query){
                return $query->user->name;
            })
            ->rawColumns(['action', 'status']);
            // ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(HeaderVisit $model): QueryBuilder
    {
        // return $model->select('date',
        //             'user_id',
        //             DB::raw('COUNT(serial) as total_visit',
        //             DB::raw('COUNT(CASE WHEN customers.type = "S" THEN 1 ELSE 0 END) as store_visit')
        //         ))
        //     ->groupBy('date','user_id');
        $from = $this->from;
        $to = $this->to;
        return $model->selectRaw(
            'header_visits.date as date,
            header_visits.user_id as user_id, 
            users.name as username,
            count(distinct header_visits.serial) as total_visit,
            count(case customers.type when "S" then 1 else NULL end) as store_visit,
            count(case customers.type when "O" then 1 else NULL end) as outlet_visit'
        )
        ->groupBy('header_visits.date', 'header_visits.user_id', 'users.name')
        ->join('users', 'header_visits.user_id', '=', 'users.id')
        ->join('customers', 'header_visits.customer_id', '=', 'customers.id')
        // ->whereBetween('date', [$from, $to])
        ->orderBy('header_visits.date', 'DESC');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('summaryvisit-table')
                    ->columns($this->getColumns())
                    // ->minifiedAjax()
                    ->ajax([
                        'url'  => route('visit.summary'),
                        'type' => 'GET',
                        'data' => "function(data){
                            data.start_date = $('input[name=start_date]').val(),
                            data.end_date = $('input[name=end_date]').val(),
                            data.staff = $('select[name=staff]').val(),
                            data.search = $('input[type=search]').val();
                        }"
                    ])
                    // ->dom('Bfrtip')
                    ->dom('lBrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->responsive()
                    ->buttons([
                        // [ 'extend'=> 'excel', 'exportOptions'=> [ 'modifier'=> [ 'page'=> 'all', 'search'=> 'none' ] ] ],
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
            'exportable' => false, 'printable' => false, 'searchable' => false, 'visible' => false],
            // Column::make('DT_RowIndex')
            //     ->title('#')
            //     ->searchable('false')
            //     ->footer('#')
            //     ->exportable('true')
            //     ->printable('false'),
            ['data' => 'date', 'title' => 'tanggal'],
            ['data' => 'user', 'title' => 'nama staff'],
            ['data' => 'store_visit', 'title' => 'toko'],
            ['data' => 'outlet_visit', 'title' => 'gerai'],
            ['data' => 'total_visit', 'title' => 'total kunjungan'],
            ['data' => 'action', 'title' => 'aksi', 'class' => 'text-center', 
            'exportable' => false, 'printable' => false, 'searchable' => false]
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'SummaryVisit_' . date('YmdHis');
    }
    
    
}

<?php

namespace App\DataTables;

use App\Models\Foto;
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


class GaleryFotoDataTable extends DataTable
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
            ->filter(function ($instance) use ($request) {
                if ($request->get('type') == 'D' || $request->get('type') == 'V' || $request->get('type') == 'S') {
                    $instance->where('type', $request->get('type'));
                }
                // if (!empty($request->get('search'))) {
                //      $instance->where(function($w) use($request){
                //         $search = $request->get('type');
                //         $w->orWhere('name', 'LIKE', "%$search%")
                //         ->orWhere('email', 'LIKE', "%$search%");
                //     });
                // }
            })
            ->addColumn('action', function($query){
                // $btnShow = "<a class='btn btn-info' href='".route('position.show', $query->id)."'>Detail </a>";
                // $btnEdit = "<a class='btn btn-warning' href='".route('display.edit', $query->id)."'>Ubah </a>";
                // $btnDelete = "<a class='btn btn-danger delete-item' href='".route('display.destroy', $query->id)."'>Hapus </a>";

                // // return $btnShow.$btnEdit.$btnDelete;
                // if(Auth::user()->hasPermissionTo('display edit') && Auth::user()->hasPermissionTo('display delete')){
                //     return $btnEdit.'&nbsp'.$btnDelete;
                // }elseif(Auth::user()->hasPermissionTo('display edit')){
                //     return $btnEdit;
                // }elseif(Auth::user()->hasPermissionTo('display delete')){
                //     return $btnDelete;
                // }else{
                //     return '';
                // }
            })
            ->addColumn('status', function($query){
                // $active = '<i class="badge badge-success">Active</i>';
                // $inactive = '<i class="badge badge-danger">Inactive</i>';

                // if($query->status == 1){
                //     // return $active;
                //     return 'Active';
                // }else{
                //     // return $inactive;
                //     return 'Inactive';
                // }
            })
            ->addColumn('foto', function($query){
                // if(!empty($query->foto->where('type', 'D')->first()->file_name)){
                    return "<img src='".asset($query->file_name)."' 
                    width='50' id='myImg' class='myImg' alt='".$query->file_name."'>";
                // }
            })
            ->rawColumns(['action', 'status', 'foto'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Foto $model): QueryBuilder
    {
        return $model->newQuery()->orderBy('created_at', 'DESC');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('galeryfoto-table')
                    ->columns($this->getColumns())
                    // ->minifiedAjax()
                    ->ajax([
                        'url'  => route('galery.index'),
                        'type' => 'GET',
                        'data' => "function(data){
                            data.type = $('select[name=type]').val();
                        }"
                    ])
                    // ->dom('Bfrtip')
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
            'exportable' => false, 'printable' => false, 'searchable' => false],
            ['data' => 'file_name', 'title' => 'nama file'],
            ['data' => 'type', 'title' => 'tipe'],
            ['data' => 'foto', 'title' => 'foto'],
            ['data' => 'action', 'title' => 'aksi', 'class' => 'text-center', 
            'exportable' => false, 'printable' => false, 'searchable' => false]
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'GaleryFoto_' . date('YmdHis');
    }
}

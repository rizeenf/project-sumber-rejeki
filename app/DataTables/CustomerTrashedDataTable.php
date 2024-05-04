<?php

namespace App\DataTables;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CustomerTrashedDataTable extends DataTable
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
                // $btnShow = "<a class='btn btn-info' href='".route('branch.show', $query->id)."'>Detail </a>";
                $btnEdit = "<a class='btn btn-info' href='".route('customer.restore', $query->id)."'>Kembalikan </a>";
                $btnDelete = "<a class='btn btn-danger delete-item' href='".route('customer.force-delete', $query->id)."'>Hapus Permanen</a>";

                // return $btnShow.$btnEdit.$btnDelete;
                return $btnEdit.$btnDelete;
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
            ->editColumn('deleted_at', function($query){
                $formatedDate = date('d-M-Y H:i:s', strtotime($query->deleted_at)); 
                return $formatedDate;
            })
            ->addColumn('by', function($query){
                return $query->deleted_actor->name;
            })
            ->addColumn('regist', function($query){
                if($query->status_registration == 'Y'){
                    return 'Sudah Registrasi/Member';
                }elseif($query->status_registration == 'M'){
                    return 'Mixing/Campuran';
                }else{
                    return 'Belum Registrasi/Non-member';
                }
            })
            ->addColumn('tipe', function($query){
                if($query->type == 'S'){
                    return 'Toko';
                }else{
                    return 'Gerai';
                }
            })
            ->rawColumns(['action', 'status', 'regist', 'tipe'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Customer $model): QueryBuilder
    {
        return $model->newQuery()->onlyTrashed();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('customertrashed-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
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
            ['data' => 'DT_RowIndex', 'title' => '#'],
            ['data' => 'code', 'title' => 'kode'],
            ['data' => 'name', 'title' => 'nama'],
            ['data' => 'regist', 'title' => 'registrasi'],
            ['data' => 'tipe', 'title' => 'tipe'],
            ['data' => 'area', 'title' => 'area'],
            ['data' => 'subarea', 'title' => 'sub area'],
            ['data' => 'deleted_at', 'title' => 'tanggal hapus'],
            ['data' => 'by', 'title' => 'dihapus oleh'],
            ['data' => 'action', 'title' => 'aksi'],
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'CustomerTrashed_' . date('YmdHis');
    }
}

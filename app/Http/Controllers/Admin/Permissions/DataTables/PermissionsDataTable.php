<?php

namespace App\Http\Controllers\Admin\Permissions\DataTables;

use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Gate;

class PermissionsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('created_at', function($record) {
                return $record->created_at->format(config('app.date_time_format'));
            })
            ->editColumn('name', function($record) {
                return $record->name ?? "";
            })  
            ->editColumn('guard_name', function($record) {
                return ucfirst($record->guard_name) ?? "";
            })  
            ->addColumn('action', function ($record) {
                $action = '';
                if (Gate::check('permissions.edit')) {
                    $action .= '<a href="javascript:void(0)" data-href="' . route('admin.permissions.edit', [$record->id]) . '" class="btn btn-sm btn-success edit-item-btn me-2 editRecordBtn"><i class="ri-edit-box-line align-bottom"></i></a>';
                }

                if (Gate::check('permissions.delete')) {
                    $action .= '<button data-href="' . route('admin.permissions.destroy', [$record->id]) . '" class="btn btn-sm btn-danger remove-item-btn delete_role_button deleteRecordBtn"><i class="ri-delete-bin-line"></i></button>';
                }
                return $action;
            }) 
            ->rawColumns(['action']);
    }


    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Master\Permission $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Permission $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('ajaxData_table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('lfrtip')
                    ->orders([[1, 'asc'], [2, 'asc']])
                    ->buttons(
                        Button::make('export'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')->title('#')->orderable(false)->searchable(false),
            Column::make('name')->title(__('Name')),
            Column::make('guard_name')->title(__('Guard Name')),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->addClass('datatable_action text-center'),
        ];
    }

}

<?php

namespace App\Http\Controllers\Admin\Roles\DataTables;

use Spatie\Permission\Models\Role;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Gate;

class RolesDataTable extends DataTable
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
            ->eloquent($query->whereNotIn('id', config('constants.roles.othersRoles')))
            ->addIndexColumn()
            ->editColumn('created_at', function($record) {
                return $record->created_at->format(config('app.date_time_format'));
            })
            ->editColumn('name', function($record) {
                return ucfirst($record->name) ?? "";
            })
            ->addColumn('action', function ($record) {
                $action = '';
                if (Gate::check('roles.edit')) {
                    $action .= '<a href="'.route('admin.roles.edit', [$record->id]).'" class="btn btn-sm btn-success edit-item-btn me-2 editRecordBtn"><i class="ri-edit-box-line align-bottom"></i></a>';
                }
                return $action;
            })
            ->rawColumns(['action','status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Master\Role $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Role $model)
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
                    // ->orderBy([4, 'asc'])
                    ->orders([[1, 'desc']])
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
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->addClass('datatable_action text-center'),
        ];
    }

}

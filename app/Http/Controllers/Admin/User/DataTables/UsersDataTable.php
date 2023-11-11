<?php

namespace App\Http\Controllers\Admin\User\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Gate;

class UsersDataTable extends DataTable
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
            ->eloquent($query->whereHas('roles', function ($query) {
                    $query->whereIn('roles.id', config('constants.roles.staffRoles'));
                })
            )
            ->addIndexColumn()
            ->editColumn('created_at', function($record) {
                return $record->created_at->format(config('app.date_time_format'));
            })
            ->editColumn('name', function($record) {
                return ucfirst($record->name) ?? "";
            })  
            ->editColumn('roles.name', function($record) {
                return $record->getRoleNames()->first() ?? "";
            })
            ->editColumn('department_id', function($record) {
                return $record->department->name ?? "";
            })
            ->editColumn('status', function($record) {
                $checkedStatus = ($record->status == 1) ? 'checked' : '';
                $status = 1;
                if($record->status == 1){
                    $status = 0;
                }
                $html = '<label class="form-check form-switch text-center form-switch-lg">
                    <input class="toggle_switch_chk form-check-input" id="normal'.$record->id.'" type="checkbox" value="'.$status.'" '.$checkedStatus.' data-status_id="'.$record->id.'" data-href="'.route('admin.users.status',[$record->id]).'">
                    </label>';
                return $html ?? "";
            })
            ->addColumn('action', function ($record) {
                $action = '';
                // if (Gate::check('user.show')) {
                //     $action .= '<a href="javascript:void(0)" data-href="' . route('admin.users.show', [$record->id]) . '" class="btn btn-sm btn-primary view-item-btn me-2 showRecordBtn"><i class="ri-add-fill align-bottom"></i></a>';
                // }
                // if (Gate::check('eligiblity_criteria.access')) {
                    $action .= '<a href="'.route('admin.asign-brands.index', ['user'=>$record->id]).'" class="btn btn-sm btn-info edit-item-btn me-2"><i class="ri-add-fill align-bottom"></i></a>';
                // }
                if (Gate::check('user.edit')) {
                    $action .= '<a href="javascript:void(0)" data-href="' . route('admin.users.edit', [$record->id]) . '" class="btn btn-sm btn-success edit-item-btn me-2 editRecordBtn"><i class="ri-edit-box-line align-bottom"></i></a>';
                }

                if (Gate::check('user.delete')) {
                    $action .= '<button data-href="' . route('admin.users.destroy', [$record->id]) . '" class="btn btn-sm btn-danger remove-item-btn delete_role_button deleteRecordBtn"><i class="ri-delete-bin-line"></i></button>';
                }
                return $action;
            })
            ->filterColumn('roles.name', function ($query, $keyword) {
                $query->whereHas('roles', function($q) use($keyword){
                    $q->whereIn('roles.id', config('constants.roles.staffRoles'));
                    $q->where('roles.name', 'like', ["%$keyword%"]);
                });
            }) 
            ->rawColumns(['action','status']);
    }

            /*
            ->eloquent($query->whereHas('roles', function ($query) {
                    $query->whereIn('roles.id', config('constants.roles.staffRoles'));
                })
            )
            */
    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Master\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
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
                    ->orders([[1, 'desc'], [4, 'asc']])
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
            Column::make('roles.name')->title(__('Role'))->orderable(false),
            Column::make('username')->title(__('Username')),
            Column::make('email')->title(__('Email')),
            Column::make('phone')->title(__('Phone Number')),
            Column::make('department_id')->title(__('Department')),
            Column::make('status')->title(__('Status'))->addClass('text-center'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->addClass('datatable_action text-center'),
        ];
    }

}

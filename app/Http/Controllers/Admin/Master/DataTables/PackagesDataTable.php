<?php

namespace App\Http\Controllers\Admin\Master\DataTables;

use App\Models\Master\Package;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Gate;

class PackagesDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('created_at', function ($record) {
                return $record->created_at->format(config('app.date_time_format'));
            })
            ->editColumn('name', function ($record) {
                return ucfirst($record->name) ?? "";
            })
            ->editColumn('brand_id', function ($record) {
                return ucfirst($record->brand->name) ?? "";
            })
            ->editColumn('amount', function ($record) {
                return ucfirst($record->amount) ?? "";
            })
            ->editColumn('comission', function ($record) {
                return ucfirst($record->comission) ?? "";
            })
            
            ->editColumn('status', function ($record) {
                $checkedStatus = ($record->status == 1) ? 'checked' : '';
                $status = 1;
                if ($record->status == 1) {
                    $status = 0;
                }
                $html = '<label class="form-check form-switch text-center form-switch-lg">
                    <input class="toggle_switch_chk form-check-input" id="normal' . $record->id . '" type="checkbox" value="' . $status . '" ' . $checkedStatus . ' data-status_id="' . $record->id . '" data-href="' . route('master.packages.status', [$record->id]) . '">
                </label>';
                return $html ?? "";
            })
            ->addColumn('action', function ($record) {
                $action = '';
                
                // if (Gate::check('eligiblity_criteria.access')) {
                //     $action .= '<a href="'.route('master.eligiblity.index', ['bank'=>$record->id]).'" class="btn btn-sm btn-info edit-item-btn me-2">Criteria</a>';
                // }
                
                if (Gate::check('packages.edit')) {
                    $action .= '<a href="javascript:void(0)" data-href="' . route('master.packages.edit', [$record->id]) . '" class="btn btn-sm btn-success edit-item-btn me-2 editRecordBtn"><i class="ri-edit-box-line align-bottom"></i></a>';
                }

                if (Gate::check('packages.delete')) {
                    $action .= '<button data-href="' . route('master.packages.destroy', [$record->id]) . '" class="btn btn-sm btn-danger remove-item-btn delete_role_button deleteRecordBtn"><i class="ri-delete-bin-line"></i></button>';
                }
              
                return $action;
            })
            ->rawColumns(['action', 'status']);
    }

    public function query(Package $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('ajaxData_table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('lfrtip')
            ->orders([[1, 'asc']])
            ->buttons(
                Button::make('export'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')->title('#')->addClass('text-center')->orderable(false)->searchable(false),
            Column::make('name')->title('Name'),
            Column::make('brand_id')->title('Brand')->addClass('text-center'),
            Column::make('amount')->title('Amount')->addClass('text-center'),
            Column::make('comission')->title('Comission')->addClass('text-center'),
            Column::make('status')->title('Status')->addClass('text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('datatable_action text-center'),
        ];
    }
}

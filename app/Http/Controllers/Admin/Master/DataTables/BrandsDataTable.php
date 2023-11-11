<?php

namespace App\Http\Controllers\Admin\Master\DataTables;

use App\Models\Master\Brand;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Gate;

class BrandsDataTable extends DataTable
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
            ->editColumn('attach_document', function ($record) {
                if ($record->attach_document) {
                    $html = '<img src="' . asset($record->attach_document) . '" border="0" width="50" class="img-rounded" align="center" />';
                    return $html;
                } else {
                    return ''; // Or any default image or message you want to display when there's no image.
                }
            })
            ->editColumn('status', function ($record) {
                $checkedStatus = ($record->status == 1) ? 'checked' : '';
                $status = 1;
                if ($record->status == 1) {
                    $status = 0;
                }
                $html = '<label class="form-check form-switch text-center form-switch-lg">
                    <input class="toggle_switch_chk form-check-input" id="normal' . $record->id . '" type="checkbox" value="' . $status . '" ' . $checkedStatus . ' data-status_id="' . $record->id . '" data-href="' . route('master.brands.status', [$record->id]) . '">
                </label>';
                return $html ?? "";
            })
            ->addColumn('action', function ($record) {
                $action = '';
                
                // if (Gate::check('eligiblity_criteria.access')) {
                //     $action .= '<a href="'.route('master.eligiblity.index', ['bank'=>$record->id]).'" class="btn btn-sm btn-info edit-item-btn me-2">Criteria</a>';
                // }
                
                if (Gate::check('brands.edit')) {
                    $action .= '<a href="javascript:void(0)" data-href="' . route('master.brands.edit', [$record->id]) . '" class="btn btn-sm btn-success edit-item-btn me-2 editRecordBtn"><i class="ri-edit-box-line align-bottom"></i></a>';
                }

                if (Gate::check('brands.delete')) {
                    $action .= '<button data-href="' . route('master.brands.destroy', [$record->id]) . '" class="btn btn-sm btn-danger remove-item-btn delete_role_button deleteRecordBtn"><i class="ri-delete-bin-line"></i></button>';
                }
              
                return $action;
            })
            ->rawColumns(['action', 'status', 'attach_document']);
    }

    public function query(Brand $model)
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
            Column::make('attach_document')->title('Logo')->addClass('text-center'),
            Column::make('status')->title('Status')->addClass('text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('datatable_action text-center'),
        ];
    }
}

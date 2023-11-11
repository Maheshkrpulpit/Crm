<?php

namespace App\Http\Controllers\Admin\Master\DataTables;

use App\Models\Master\AsignBrand;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Gate;

class AsignBrandsDataTable extends DataTable
{
    public function dataTable($query)
    {
        $userFilter = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;

        if ($userFilter !== null) {
            $query->where('user_id', $userFilter);
        }
        return datatables()
            ->eloquent($query)
            
            ->addIndexColumn()
            ->editColumn('created_at', function ($record) {
                return $record->created_at->format(config('app.date_time_format'));
            })
            ->editColumn('user_id', function ($record) {
                return ucfirst($record->user->name) ?? "";
            })
            ->editColumn('brand_id', function ($record) {
                return ucfirst($record->brand->name) ?? "";
            })
            ->editColumn('comission', function ($record) {
                return $record->comission == 1? "Enable" : "Disable";
            })
            ->editColumn('amount', function ($record) {
                return ucfirst($record->amount) ?? "";
            })
            ->addColumn('action', function ($record) {
                $action = '';
                
                if (Gate::check('asign_brands.edit')) {
                    $action .= '<a href="javascript:void(0)" data-href="' . route('admin.asign-brands.edit', [$record->id]) . '" class="btn btn-sm btn-success edit-item-btn me-2 editRecordBtn"><i class="ri-edit-box-line align-bottom"></i></a>';
                }

                if (Gate::check('asign_brands.delete')) {
                    $action .= '<button data-href="' . route('admin.asign-brands.destroy', [$record->id]) . '" class="btn btn-sm btn-danger remove-item-btn delete_role_button deleteRecordBtn"><i class="ri-delete-bin-line"></i></button>';
                }
              
                return $action;
            })
            ->rawColumns(['action']);
    }

    public function query(AsignBrand $model)
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
            Column::make('user_id')->title('User Name'),
            Column::make('brand_id')->title('Brand')->addClass('text-center'),
            Column::make('amount')->title('Amount')->addClass('text-center'),
            Column::make('comission')->title('Comission Status')->addClass('text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('datatable_action text-center'),
        ];
    }
}

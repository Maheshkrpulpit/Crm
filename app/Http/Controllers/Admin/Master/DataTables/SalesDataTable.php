<?php

namespace App\Http\Controllers\Admin\Master\DataTables;

use App\Models\Master\AsignBrand;
use App\Models\Master\Sale;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Yajra\DataTables\Html\Editor\Fields\Select;

class SalesDataTable extends DataTable
{   
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('created_at', function ($record) {
                return $record->created_at->format(config('app.date_time_format'));
            })            
            ->editColumn('package_id', function ($record) {
                return $record->packages->name ?? '';
            })
            ->editColumn('user_id', function ($record) {
                return $record->user->name ?? '';
            })
            ->editColumn('brand_id', function ($record) {
                return $record->brand->name ?? '';
            })
            ->addColumn('action', function ($record) {
                $action = '';
                // if (Gate::check('students.show')) {
                    $action .= '<a href="' . route('sales.show', [$record->id]) . '"  class="btn btn-sm btn-primary view-item-btn me-2 showRecordBtn"><i class="ri-eye-fill align-bottom"></i></a>';
                // }
                // if (Gate::check('packages.edit')) {
                    $action .= '<a href="' . route('sales.edit', [$record->id]) . '" class="btn btn-sm btn-success edit-item-btn me-2"><i class="ri-edit-box-line align-bottom"></i></a>';
                // }

                return $action;
            })
            ->rawColumns(['action']);
    }

    public function query(Sale $model)
    {
        $query = $model->with(['user', 'brand', 'state', 'packages']);

        if (auth()->user()->getRoleNames()->first() != 'Admin') {
            $department_id = auth()->user()->department_id;
            $asignBrand = AsignBrand::where('user_id', auth()->user()->id)->pluck("brand_id")->toArray();

            if ($department_id == 1) {
                $query->where(['user_id' => auth()->user()->id]);
            } else if ($department_id == 2) {
                $query->where(['order_status' => 'Sale'])->whereIn('brand_id', $asignBrand);
            } else if ($department_id == 3) {
                $query->where(['order_status' => 'Quility done'])->whereIn('brand_id', $asignBrand);
            } else if ($department_id == 4) {
                $query->where(['order_status' => 'Processed'])->whereIn('brand_id', $asignBrand);
            } else if ($department_id == 5) {
                $query->where(['order_status' => 'Paid'])->whereIn('brand_id', $asignBrand);
            }
        }

        return $query->newQuery();
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
            Column::make('package_id')->title('Package'),
            Column::make('brand_id')->title('Brand')->addClass('text-center'),
            Column::make('user_id')->title('User Name'),
            Column::make('first_name')->title('Name'),
            Column::make('email')->title('Email'),
            Column::make('mobile_number')->title('Mobile Number'),
            Column::make('state.name')->title('State')->addClass('text-center'),
            Column::make('order_status')->title('Order Status')->addClass('text-center'),
            Column::make('created_at')->title('Date')->addClass('text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('datatable_action text-center'),
        ];
    }
}


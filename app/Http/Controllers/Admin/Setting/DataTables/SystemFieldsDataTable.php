<?php

namespace App\Http\Controllers\Admin\Setting\DataTables;

use App\Models\Master\AcademicYear;
use App\Models\Setting\SystemField;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Gate;

use Carbon\Carbon;

class SystemFieldsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $fieldTypes = [
            1 => 'Text',
            2 => 'Number',
            3 => 'Checkbox',
            4 => 'Radio',
            5 => 'Textarea',
            6 => 'Select',
            7 => 'File',
            8 => 'Multiple',
            9 => 'Email',
            10 => 'Date',
        ];
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('created_at', function($record) {
                return $record->created_at->format(config('app.date_time_format'));
            })
            ->editColumn('name', function($record) {
                return $record->name ?? "";
            })
            ->editColumn('label', function($record) {
                return ucfirst($record->label) ?? "";
            })
            ->addColumn('type', function ($record) use ($fieldTypes) {
                $type = $record->type;
                return $fieldTypes[$type] ?? 'Unknown';
            })
            ->editColumn('grid', function($record) {
                return ucfirst($record->grid) ?? "";
            })
            ->editColumn('status', function($record) {
                $checkedStatus = ($record->status == 1) ? 'checked' : '';
                $status = 1;
                if($record->status == 1){
                    $status = 0;
                }
                $html = '<label class="form-check form-switch text-center form-switch-lg">
                   <input class="toggle_switch_chk form-check-input" id="normal'.$record->id.'" type="checkbox" value="'.$status.'" '.$checkedStatus.' data-status_id="'.$record->id.'" data-href="'.route('settings.system-fields.status',[$record->id]).'">
                    </label>';
                return $html ?? "";
            })
            ->editColumn('Require', function($record) {
                $checkedRequiredStatus = ($record->is_required == 1) ? 'checked' : '';
                $is_required = 1;
                if($record->is_required == 1){
                    $is_required = 0;
                }
                $html = '<label class="form-check form-switch text-center form-switch-lg">
                   <input class="toggle_switch_chk form-check-input" id="normal_required'.$record->id.'" type="checkbox" value="'.$is_required.'" '.$checkedRequiredStatus.' data-status_id="'.$record->id.'" data-href="'.route('settings.system-fields.requiredStatus',[$record->id]).'">
                    </label>';
                return $html ?? "";
            })
            ->addColumn('action', function ($record) {
                $action = '';


                if (Gate::check('system_fields.edit')) {
                    $action .= '<a href="javascript:void(0)" data-href="' . route('settings.system-fields.edit', [$record->id]) . '" class="btn btn-sm btn-success edit-item-btn me-2 editRecordBtn"><i class="ri-edit-box-line align-bottom"></i></a>';
                }

                // if (Gate::check('system_fields.delete')) {
                //     $action .= '<button data-href="' . route('settings.system-fields.destroy', [$record->id]) . '" class="btn btn-sm btn-danger remove-item-btn delete_role_button deleteRecordBtn"><i class="ri-delete-bin-line"></i></button>';
                // }
                return $action;
            })
            /*->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(created_at,'%d-%M-%Y') like ?", ["%$keyword%"]); //date_format when searching using date
            })  */
            ->rawColumns(['action','Require','status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Setting\SystemField $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SystemField $model)
    {
        return $model->orderBy('id')->newQuery();
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
            Column::make('name')->title(lang('Name')),
            Column::make('label')->title(lang('Label')),
            Column::make('type')->title(lang('Type')),
            Column::make('grid')->title(lang('Bootstrap Column')),
            Column::make('status')->title(lang('Status'))->addClass('text-center'),
            Column::make('Require')->title(lang('Require'))->addClass('text-center'),
           // Column::make('created_at')->title(lang('Created At')),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->addClass('datatable_action text-center'),
        ];
    }

}

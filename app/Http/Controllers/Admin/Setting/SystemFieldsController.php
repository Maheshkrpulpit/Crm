<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Admin\Setting\DataTables\SystemFieldsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Setting\SystemField;
use App\Models\Setting\FieldType;
use App\Models\Setting\FieldValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Admin\SystemField\StoreRequest;
use App\Http\Requests\Admin\SystemField\UpdateRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\DB;

class SystemFieldsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return //\Illuminate\Http\Response
     */

    public function index(SystemFieldsDataTable $dataTable){
       abort_if(Gate::denies('system_fields.access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $dataTable->render('admin.settings.systemFields.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
       abort_if(Gate::denies('system_fields.create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($request->ajax()) {
            $editing=[];
            $fieldType = FieldType::pluck('name','id');
            $viewHTML = view('admin.settings.systemFields.create')->with(['fieldType'=>$fieldType,'editing'=>$editing])->render();
            return response()->json(array('success' => true, 'htmlView'=>$viewHTML));
        }
        return view('admin.settings.systemFields.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        abort_if(Gate::denies('system_fields.create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            

            
            $fieldType = $request->type;
            $fieldValue = $request->input('value');
            $systemField_id = SystemField::create([
                'name' => $request->name,
                'label' => $request->label,
                'order' => $request->order,
                'grid' => $request->grid,
                'type' => $request->type,
                'show_on_table' => $request->show_on_table,
                'status' => $request->status,
                'values' => json_encode($request->input('value')),
            ]);

            //Add Column sales_table
            $tableName = 'sales'; // Replace with your table name
            $columnName = $request->input('name'); // Get the column name from the request
            if($systemField_id->id > 0){
                if (!Schema::hasColumn($tableName, $columnName)) {
                    Schema::table($tableName, function (Blueprint $table) use ($columnName) {
                        $table->string($columnName)->nullable(); // Adjust the column definition as needed
                    });
    
                }
            };
            if (!Schema::hasColumn($tableName, $columnName)) {
                Schema::table($tableName, function (Blueprint $table) use ($columnName) {
                    $table->string($columnName)->nullable(); // Adjust the column definition as needed
                });

            };
            //Field Value
                if (!empty($fieldValue)) {
                    foreach ($fieldValue as $fieldValueName) {
                        if ($fieldValueName !== null) {
                            FieldValue::create([
                                'system_field_id' => $systemField_id->id,
                                'field_type_id' => $fieldType,
                                'value' => $fieldValueName,
                            ]);
                        }
                    }
                } 
         $response = [
             'success'    => true,
             'message'   =>  __('The System Field is added successfully')
         ];
         return response()->json($response);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting\SystemField $systemField
     * @return \Illuminate\Http\Response
     */
    public function show(SystemField $systemField)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting\SystemField $systemField
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, SystemField $systemField)
    {
        if($request->ajax()) {
            $editing = $systemField ? true : false;
            $fieldType = FieldType::pluck('name','id');
            $viewHTML = view('admin.settings.systemFields.edit')->with(['systemField'=>$systemField,'editing'=>$editing,'fieldType'=>$fieldType])->render();
            return response()->json(array('success' => true, 'htmlView'=>$viewHTML));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting\SystemField $systemField
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, SystemField $systemField)
    {
        abort_if(Gate::denies('system_fields.edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $inputs = $request->all();
            $inputs['status'] = $request->has('status') ? $request->status : 0;
            $inputs['show_on_table'] = $request->has('show_on_table') ? $request->show_on_table : 0;
            $systemField->update($inputs);
            $response = [
                'success' => true,
                'message' => __('The System Field is updated successfully'),
            ];
            return response()->json($response);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting\SystemField $systemField
     * @return \Illuminate\Http\Response
     */
    public function destroy(SystemField $systemField)
    {
        //
    }

    public function changeStatus(Request $request, SystemField $systemField){
    
        if ($request->ajax()){
            $validator = Validator::make($request->all(), [
                'status'     => [
                    'required',
                    'numeric',
                    'in:0,1'
                ],
            ]);
            if ($validator->fails()){
                return response()->json(['success'=>false,'errors'=>$validator->getMessageBag()->toArray(),'message'=>lang('Error Occurred!')],400);
            }

            $systemField->update(['status' => $request->status]);
            $response = [
                'status'    => 'true',
                'message'   =>  lang("Field is updated successfully."),
            ];
            return response()->json($response);
        }
    }

    public function changeRequiredStatus(Request $request, SystemField $systemField){

        if ($request->ajax()){
            $validator = Validator::make($request->all(), [
                'status'     => [
                    'required',
                    'numeric',
                    'in:0,1'
                ],
            ]);
            if ($validator->fails()){
                return response()->json(['success'=>false,'errors'=>$validator->getMessageBag()->toArray(),'message'=>lang('Error Occurred!')],400);
            }

            //$systemField->update(['is_required' => $request->requireStatus]);
            $systemField->is_required = $request->status;
            $systemField->save();
            $response = [
                'status'    => 'true',
                'message'   =>  lang("Field is updated successfully."),
            ];
            return response()->json($response);
        }
    }
}

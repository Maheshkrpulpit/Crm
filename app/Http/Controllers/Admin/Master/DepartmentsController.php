<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Master\Department;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Master\Department\StoreRequest;
use App\Http\Requests\Master\Department\UpdateRequest;
use App\Http\Controllers\Admin\Master\DataTables\DepartmentsDataTable;

class DepartmentsController extends Controller
{
    public function index(DepartmentsDataTable $dataTable){
        abort_if(Gate::denies('departments.access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $dataTable->render('admin.master.departments.index');
    }

    public function create(Request $request)
    {
        abort_if(Gate::denies('departments.create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($request->ajax()){
            $viewHTML = view('admin.master.departments.create')->render();
            return response()->json(['success'=>true, 'htmlView'=>$viewHTML]);
        }
        return view('admin.master.departments.create');
    }
    // stores
    public function store(StoreRequest $request)
    {
               abort_if(Gate::denies('departments.create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
               if ($request->ajax()) {
                Department::create($request->all());
                $response = [
                    'success'    => true,
                    'message'   =>  __('The Department is added successfully')
                ];
                return response()->json($response);
            }
    }

    public function edit(Request $request, Department $department)
    {
        if($request->ajax()) {
            $viewHTML = view('admin.master.departments.edit')->with(['department'=>$department])->render();
            return response()->json(array('success' => true, 'htmlView'=>$viewHTML));
        }
    }

    public function update(UpdateRequest $request, Department $department)
    {
        abort_if(Gate::denies('departments.edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($request->ajax()){
            $inputs = $request->all();
            $department->update($inputs);
            $response = [
                'success'  =>true,
                'message'  => __ ('The Department is upadated successfully'),
            ];
            return response()->json($response);
        }
    }

    public function destroy(Department $department)
    {
         abort_if(Gate::denies('departments.delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $department->delete();
        $response=[
            'success' =>true,
            'message' => __('The Department is deleted successfully'),
        ];
        return response()->json($response);
    }

    public function changeStatus(Request $request, Department $department){
        abort_if(Gate::denies('departments.edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()){
            $validator = Validator::make($request->all(), [
                'status'     => [
                    'required',
                    'numeric',
                    'in:0,1'
                ],
            ]);
            if ($validator->fails()){
                return response()->json(['success'=>false,'errors'=>$validator->getMessageBag()->toArray(),'message'=>'Error Occured!'],400);
            }
            $department->update(['status' => $request->status]);
            $response = [
                'status'    => 'true',
                'message'   =>  __('The Department status is updated successfully'),
            ];
            return response()->json($response);
        }
    }
}

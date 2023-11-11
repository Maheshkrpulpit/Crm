<?php

namespace App\Http\Controllers\Admin\Roles;

use Gate;
use Validator;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;

use App\Http\Requests\Admin\Role\StoreRequest;
use App\Http\Requests\Admin\Role\UpdateRequest;

use App\Http\Controllers\Admin\Roles\DataTables\RolesDataTable;

class RolesController extends Controller
{
    public function index(RolesDataTable $dataTable){
        abort_if(Gate::denies('roles.access'), Response::HTTP_FORBIDDEN, '403 Forbidden');        
        return $dataTable->render('admin.roles.index');
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        abort_if(Gate::denies('roles.create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.roles.create')->with(['permissions' => getFormattedPermissions()]);
    }

    public function store(StoreRequest $request)
    {        
        abort_if(Gate::denies('roles.create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $role = Role::create($request->all());
        $role->syncPermissions($request->input('permissions', []));
        $response = [
            'success'    => true,
            'msg'   =>  __('The Role added successfully')
        ];
        return redirect()->route('admin.roles.index')->with('status', $response);
    }

    public function edit(Request $request, Role $role)
    {   
        abort_if(Gate::denies('roles.edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $roleAssignPermissions = $role->permissions->pluck('name','id')->toArray();
        return view('admin.roles.edit')->with(['role' => $role,'roleAssignPermissions' => $roleAssignPermissions, 'permissions' => getFormattedPermissions()]);
    }

    public function update(UpdateRequest $request, Role $role)
    {
        abort_if(Gate::denies('roles.edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $inputs = $request->all();
            $inputs['status'] = $request->status ?? 0;
            $role->update($inputs);
            $role->permissions()->sync($request->input('permissions', []));
            $response = [
                'success'    => true,
                'msg'   =>  __('The Role updated successfully')
            ];
            return redirect()->route('admin.roles.index')->with('status', $response);
    }

    public function show(Request $request, Role $role){
        abort_if(Gate::denies('roles.show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($request->ajax()) {
            $viewHTML = view('admin.roles.show', compact('role'))->render();
            return response()->json(array('success' => true, 'htmlView'=>$viewHTML));
        }
    }


    public function destroy(Request $request, Role $role)
    {
        abort_if(Gate::denies('roles.delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');        
        $role->delete();
        $response = [
            'success'    => true,
            'message'   =>  __('The Role deleted successfully')
        ];
        return response()->json($response);
    }

    public function changeStatus(Request $request, Role $role){
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
            $role->update(['status' => $request->status]);
            $response = [
                'status'    => 'true',
                'message'   =>  __('The Role status updated successfully')
            ];
            return response()->json($response);
        }
    }
}
<?php

namespace App\Http\Controllers\Admin\Permissions;

use Gate;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

use App\Http\Requests\Admin\Permission\StoreRequest;
use App\Http\Requests\Admin\Permission\UpdateRequest;

use App\Http\Controllers\Admin\Permissions\DataTables\PermissionsDataTable;

class PermissionsController extends Controller
{
    public function index(PermissionsDataTable $dataTable){
        abort_if(Gate::denies('permissions.access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $dataTable->render('admin.permissions.index');
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        abort_if(Gate::denies('permissions.create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($request->ajax()) {
            $viewHTML = view('admin.permissions.create')->render();
            return response()->json(array('success' => true, 'htmlView'=>$viewHTML));
        }
        return view('admin.permissions.create');
    }

    public function store(StoreRequest $request)
    {        
        abort_if(Gate::denies('permissions.create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            Permission::create($request->all());
            $response = [
                'success'    => true,
                'message'   =>  __('The Permission added successfully')
            ];
            return response()->json($response);
        }
    }

    public function edit(Request $request, Permission $permission)
    {
        abort_if(Gate::denies('permissions.edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($request->ajax()) {
            $viewHTML = view('admin.permissions.edit',compact('permission'))->render();
            return response()->json(array('success' => true, 'htmlView'=>$viewHTML));
        }
    }

    public function update(UpdateRequest $request, Permission $permission)
    {
        abort_if(Gate::denies('permissions.edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            dd($request->all(), $permission);
            $permission->update($request->all());
            $response = [
                'success'    => true,
                'message'   =>  __('The Permission updated successfully')
            ];
            return response()->json($response);
        }
    }

    public function show(Request $request, Permission $permissions){
        abort_if(Gate::denies('permissions.show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($request->ajax()) {
            $viewHTML = view('admin.permissions.show', compact('permissions'))->render();
            return response()->json(array('success' => true, 'htmlView'=>$viewHTML));
        }
    }


    public function destroy(Request $request, Permission $permissions)
    {
        abort_if(Gate::denies('permissions.delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');        
        $permissions->delete();
        $response = [
            'success'    => true,
            'message'   =>  __('The Permission deleted successfully')
        ];
        return response()->json($response);
    }
}
<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Master\Department;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;

use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\UpdateRequest;

use App\Http\Controllers\Admin\User\DataTables\UsersDataTable;

class UsersController extends Controller
{
    public function index(UsersDataTable $dataTable){
        abort_if(Gate::denies('user.access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $roles = Role::whereIn('id',config('constants.roles.staffRoles'))->get()->pluck('name','name');
        $status = [1 => 'Active',0 => 'Inactive'];
        return $dataTable->render('admin.users.index', compact('roles','status'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        abort_if(Gate::denies('user.create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($request->ajax()) {
            $department = Department::where('status',1)->pluck('name','id');
            $roles = Role::whereIn('id',config('constants.roles.staffRoles'))->get()->pluck('name','id');
            $viewHTML = view('admin.users.create')->with(['roles' => $roles,'department'=>$department])->render();
            return response()->json(array('success' => true, 'htmlView'=>$viewHTML));
        }
        return view('admin.user.create');
    }

    public function store(StoreRequest $request)
    {        
        abort_if(Gate::denies('user.create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $user = User::create($request->all());
            $user->roles()->sync($request->input('roles', []));
            $response = [
                'success'    => true,
                'message'   =>  __('The User added successfully')
            ];
            return response()->json($response);
        }
    }

    public function edit(Request $request, User $user)
    {
        abort_if(Gate::denies('user.edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($request->ajax()) {
            $department = Department::where('status',1)->pluck('name','id');
            $roles = Role::whereIn('id',config('constants.roles.staffRoles'))->get()->pluck('name','id');
            $viewHTML = view('admin.users.edit')->with(['user' => $user, 'roles' => $roles,'department'=>$department])->render();
            return response()->json(array('success' => true, 'htmlView'=>$viewHTML));
        }
    }

    public function update(UpdateRequest $request, User $user)
    {
        abort_if(Gate::denies('user.edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $inputs = $request->all();
            $inputs['status'] = $request->status ?? 0;
            $user->update($inputs);
            $user->roles()->sync($request->input('roles', []));
            $response = [
                'success'    => true,
                'message'   =>  __('The User updated successfully')
            ];
            return response()->json($response);
        }
    }

    public function show(Request $request, User $user){
        abort_if(Gate::denies('user.show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($request->ajax()) {
            $viewHTML = view('admin.users.show', compact('user'))->render();
            return response()->json(array('success' => true, 'htmlView'=>$viewHTML));
        }
    }


    public function destroy(Request $request, User $user)
    {
        abort_if(Gate::denies('user.delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');        
        $user->delete();
        $response = [
            'success'    => true,
            'message'   =>  __('The User deleted successfully')
        ];
        return response()->json($response);
    }

    public function changeStatus(Request $request, User $user){
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
            $user->update(['status' => $request->status]);
            $response = [
                'status'    => 'true',
                'message'   =>  __('The User status updated successfully')
            ];
            return response()->json($response);
        }
    }
    
}
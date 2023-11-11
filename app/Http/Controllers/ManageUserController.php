<?php

namespace App\Http\Controllers;

// use App\BusinessLocation;
// use App\Contact;
// use App\System;
use App\Models\User;
use App\Utils\ModuleUtil;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Activitylog\Models\Activity;


class ManageUserController extends Controller
{
    /**
     * Constructor
     *
     * @param Util $commonUtil
     * @return void
     */
    public function __construct(ModuleUtil $moduleUtil)
    {
        $this->moduleUtil = $moduleUtil;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (!auth()->user()->can('user.view') && !auth()->user()->can('user.create')) {
            abort(403, 'Unauthorized action.');
        }

        // echo 'dfld';die;

        if (request()->ajax()) {
            $business_id = request()->session()->get('user.business_id');
            $user_id = request()->session()->get('user.id');

            $users = User::where('id', '>', 0)->whereHas('roles', function ($query) {

                $query->where('name', '!=', 'student');

            });

            return Datatables::of($users)
                // ->editColumn('email', '{{$email}} @if(empty($allow_login)) <span class="label bg-gray">@lang("lang_v1.login_not_allowed")</span>@endif')
                ->addColumn(
                    'role',
                    function ($row) {
                        $role_name = $this->moduleUtil->getUserRoleName($row->id);
                        return $role_name;
                    }
                )
                ->addColumn(
                    'action', function ($row) {
                    $html = '';
                    $role_name = $this->moduleUtil->getUserRoleName($row->id);

                    if ($role_name != 'superadmin'):
                        if (auth()->user()->can("user.update")):
                            //    $html.='<a href="'.action("ManageUserController@edit", [$row->id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>'.__("locale.buttons.edit").'</a>
                            // &nbsp;';
                            $html .= '<a href="' . action("ManageUserController@edit", [$row->id]) . '"><i
                        class="ri-pencil-fill align-bottom text-muted"></i></a>
                        &nbsp;';
                        endif;
                        // @can("user.view")
                        // <a href="{{action(\'ManageUserController@show\', [$id])}}" class="btn btn-xs btn-info"><i class="fa fa-eye"></i> @lang("messages.view")</a>
                        // &nbsp;
                        // @endcan
                        if (auth()->user()->can("user.delete")):
                            //  $html.='<button data-href="'.action("ManageUserController@destroy", [$row->id]).'" class="btn btn-xs btn-danger delete_user_button"><i class="glyphicon glyphicon-trash"></i> '.__("locale.buttons.delete").'</button>';
                            $html .= '<button data-href==="' . action("ManageUserController@destroy", [$row->id]) . '" class="delete_user_button"> <i
                    class="ri-delete-bin-fill align-bottom text-muted"></i></button>';
                        endif;
                    endif;

                    return $html;

                })
                // ->filterColumn('full_name', function ($query, $keyword) {
                //     $query->whereRaw("CONCAT(COALESCE(surname, ''), ' ', COALESCE(first_name, ''), ' ', COALESCE(last_name, '')) like ?", ["%{$keyword}%"]);
                // })
                ->removeColumn('id')
                ->rawColumns(['action', 'username', 'email'])
                ->make(true);
        }

        return view('manage_user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('user.create')) {
            abort(403, 'Unauthorized action.');
        }


        $roles = Role::pluck('name', 'id')->toArray();

        return view('manage_user.create')
            ->with(compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('user.create')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'role' => 'required',
        ]);


        try {


            $request->merge(array('password' => \Hash::make($request->password)));


            $user = User::create($request->all());

            $role = Role::find($request->role);

            $user->assignRole($role->name);

            $output = ['success' => 1,
                'msg' => __("locale.messages.add_success", ['model' => __('locale.models.user')])
            ];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

            $output = ['success' => 0,
                'msg' => __("locale.messages.something_went_wrong")
            ];
        }

        return redirect('users')->with('status', $output);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!auth()->user()->can('user.view')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = request()->session()->get('user.business_id');

        $user = User::where('business_id', $business_id)
            ->with(['contactAccess'])
            ->find($id);

        //Get user view part from modules
        $view_partials = $this->moduleUtil->getModuleData('moduleViewPartials', ['view' => 'manage_user.show', 'user' => $user]);

        $users = User::forDropdown($business_id, false);

        $activities = Activity::forSubject($user)
            ->with(['causer', 'subject'])
            ->latest()
            ->get();

        return view('manage_user.show')->with(compact('user', 'view_partials', 'users', 'activities'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->can('user.update')) {
            abort(403, 'Unauthorized action.');
        }


        $user = User::find($id);

        $roles = Role::pluck('name', 'id')->toArray();


        return view('manage_user.edit')
            ->with(compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('user.update')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate(['email' => 'required|unique:users,email,' . $id]);

        try {

            DB::beginTransaction();


            $user_data = array('name' => $request->name, 'email' => $request->email, 'phone' => $request->phone);
            $user = User::find($id);

            $user->update($user_data);
            $role_id = $request->input('role');
            $user_role = $user->roles->first();
            $previous_role = !empty($user_role->id) ? $user_role->id : 0;
            if ($previous_role != $role_id && $role_id != null) {


                $role = Role::findOrFail($role_id);
                $user->assignRole($role->name);
            }


            $output = ['success' => 1,
                'msg' => __("locale.messages.update_success", ['model' => __('locale.models.user')])
            ];

            DB::commit();

        } catch (\Exception $e) {

            DB::rollBack();

            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

            $output = ['success' => 0,
                'msg' => __("locale.messages.something_went_wrong")
            ];
        }

        return redirect('users')->with('status', $output);
    }

    private function getAdmins()
    {
        $business_id = request()->session()->get('user.business_id');
        $admins = User::role('Admin#' . $business_id)->get();

        return $admins;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->user()->can('user.delete')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            try {


                $user = User::find($id);


                $user->delete();
                $output = ['success' => true,
                    'msg' => __("locale.messages.delete_success", ['Model' => __('locale.models.user')])
                ];
            } catch (\Exception $e) {
                \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

                $output = ['success' => false,
                    'msg' => __("locale.messages.something_went_wrong")
                ];
            }

            return $output;
        }
    }

    /**
     * Retrives roles array (Hides admin role from non admin users)
     *
     * @param int $business_id
     * @return array $roles
     */
    private function getRolesArray($business_id)
    {
        $roles_array = Role::where('business_id', $business_id)->get()->pluck('name', 'id');
        $roles = [];

        $is_admin = $this->moduleUtil->is_admin(auth()->user(), $business_id);

        foreach ($roles_array as $key => $value) {
            if (!$is_admin && $value == 'Admin#' . $business_id) {
                continue;
            }
            $roles[$key] = str_replace('#' . $business_id, '', $value);
        }
        return $roles;
    }
}

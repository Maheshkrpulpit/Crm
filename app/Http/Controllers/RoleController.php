<?php

namespace App\Http\Controllers;

use Gate;
//use App\SellingPriceGroup;
use App\Utils\ModuleUtil;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * All Utils instance.
     *
     */
    protected $moduleUtil;

    /**
     * Create a new controller instance.
     *
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
        if (!auth()->user()->can('roles.view')) {
            abort(403, 'Unauthorized action.');
        }
        if (request()->ajax()) {
            //$business_id = request()->session()->get('user.business_id');
            $currentRoleIds = auth()->user()->roles->pluck('id','id')->toArray();
            $roles = Role::select(['name', 'id']);
            if(!in_array(1,$currentRoleIds)){
                $roles = $roles->whereNot('id',1);
            }            

            return DataTables::of($roles)
                ->addColumn('action', function ($row) {
                    $action = '';
                    if (Gate::check('roles.update')) {
                        $action .= '<a href="' . action('RoleController@edit', [$row->id]) . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> ' . __("locale.buttons.edit") . '</a>';
                    }
                    if (Gate::check('roles.delete')) {
                        $action .= '&nbsp
                            <button data-href="' . action('RoleController@destroy', [$row->id]) . '" class="btn btn-xs btn-danger delete_role_button"><i class="glyphicon glyphicon-trash"></i> ' . __("locale.buttons.delete") . '</button>';
                    }
                    
                    return $action;
                })
                // ->editColumn('name', function ($row) use ($business_id) {
                //     $role_name = str_replace('#'. $business_id, '', $row->name);
                //     if (in_array($role_name, ['Admin', 'Cashier'])) {
                //         $role_name = __('lang_v1.' . $role_name);
                //     }
                //     return $role_name;
                // })
                ->removeColumn('id')
                ->removeColumn('is_default')
              
                ->rawColumns([1])
                ->make(false);
        }

        return view('role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('roles.create')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = 1;//request()->session()->get('user.business_id');

       // $selling_price_groups = SellingPriceGroup::where('business_id', $business_id)
                                    // ->active()
                                    // ->get();

       // $module_permissions = $this->moduleUtil->getModuleData('user_permissions');

        $common_settings = !empty(session('business.common_settings')) ? session('business.common_settings') : [];

        $permissions=Permission::orderBy('name','asc')->get();

        return view('role.create')
                ->with(compact(  'common_settings','permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('roles.create')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $role_name = $request->input('name');
            $permissions = $request->input('permissions');
          //  $business_id = $request->session()->get('user.business_id');

             $count = Role::where('name', $role_name)->count();
            
             if ($count == 0) {
            //     $is_service_staff = 0;
            //     if ($request->input('is_service_staff') == 1) {
            //         $is_service_staff = 1;
            //     }

                $role = Role::create([
                            'name' => $role_name,
                           
                        ]);

                //Include selling price group permissions
                $spg_permissions = $request->input('radio_option');
                if (!empty($spg_permissions)) {
                    foreach ($spg_permissions as $spg_permission) {
                        $permissions[] = $spg_permission;
                    }
                }

                $radio_options = $request->input('radio_option');
                if (!empty($radio_options)) {
                    foreach ($radio_options as $key => $value) {
                        $permissions[] = $value;
                    }
                }

                $this->__createPermissionIfNotExists($permissions);

                if (!empty($permissions)) {
                    $role->syncPermissions($permissions);
                }
                $output = ['success' => 1,
                            'msg' => __("locale.messages.add_success",['Model'=>__('Role')])
                        ];
            } else {
                $output = ['success' => 0,
                            'msg' =>  __("locale.messages.already_exist",['Model'=>__('Role')])
                        ];
            }
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = ['success' => 0,
                            'msg' => __("locale.messages.something_went_wrong")
                        ];
        }
        return redirect('roles')->with('status', $output);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        

        if (!auth()->user()->can('roles.update')) {
            abort(403, 'Unauthorized action.');
        }

       // $business_id = request()->session()->get('user.business_id');
        $role = Role::with(['permissions'])
                    ->find($id);

        if($role->name=='superadmin')
        {
            abort(403, 'Unauthorized action.');

        }
        $role_permissions = [];
        foreach ($role->permissions as $role_perm) {
            $role_permissions[] = $role_perm->name;
        }

      //  $selling_price_groups = SellingPriceGroup::where('business_id', $business_id)
                                    // ->active()
                                    // ->get();

       // $module_permissions = $this->moduleUtil->getModuleData('user_permissions');

       // $common_settings = !empty(session('business.common_settings')) ? session('business.common_settings') : [];
        $permissions=Permission::orderBy('name','asc')->get();


        return view('role.edit')
            ->with(compact('role', 'role_permissions','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('roles.update')) {
            abort(403, 'Unauthorized action.');
        }

        $role = Role::find($id);

        if($role->name=='superadmin')
        {
            abort(403, 'Unauthorized action.');
            
        }

        try {
            $role_name = $request->input('name');

             
            $permissions = $request->input('permissions');
          //  $business_id = $request->session()->get('user.business_id');

            $count = Role::where('name', $role_name)
                        ->where('id', '!=', $id)
                        
                        ->count();
            if ($count == 0) {
                $role = Role::findOrFail($id);

                if ($role) {
                    // if ($role->name == 'Cashier#' . $business_id) {
                    //     $role->is_default = 0;
                    // }

                    // $is_service_staff = 0;
                    // if ($request->input('is_service_staff') == 1) {
                    //     $is_service_staff = 1;
                    // }
                    // $role->is_service_staff = $is_service_staff;
                    $role->name = $role_name;
                    $role->save();

                    //Include selling price group permissions
                    $spg_permissions = $request->input('spg_permissions');
                    if (!empty($spg_permissions)) {
                        foreach ($spg_permissions as $spg_permission) {
                            $permissions[] = $spg_permission;
                        }
                    }

                    $radio_options = $request->input('radio_option');
                    if (!empty($radio_options)) {
                        foreach ($radio_options as $key => $value) {
                            $permissions[] = $value;
                        }
                    }

                    $this->__createPermissionIfNotExists($permissions);

                    if (!empty($permissions)) {
                        $role->syncPermissions($permissions);
                    }

                    $output = ['success' => 1,
                            'msg' =>  __("locale.messages.update_success",['Model'=>__('Role')])
                        ];
                } else {
                    $output = ['success' => 0,
                            'msg' => __("user.role_is_default")
                        ];
                }
            } else {
                $output = ['success' => 0,
                            'msg' => __("locale.messages.already_exist",['Model'=>__('Role')])
                        ];
            }
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = ['success' => 0,
                            'msg' => __("locale.messages.something_went_wrong")
                        ];
        }

        return redirect('roles')->with('status', $output);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->user()->can('roles.delete')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            try {
              //  $business_id = request()->user()->business_id;

                $role = Role::find($id);

                if (!$role->name != 'superadmin') {
                    $role->delete();
                    $output = ['success' => true,
                            'msg' =>  __("locale.messages.delete_success",['Model'=>__('Role')])
                            ];
                } else {
                    $output = ['success' => 0,
                            'msg' => __("user.role_is_default")
                        ];
                }
            } catch (\Exception $e) {
                \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
                $output = ['success' => false,
                            'msg' => __("locale.messages.something_went_wrong")
                        ];
            }

            return $output;
        }
    }

    /**
     * Creates new permission if doesn't exist
     *
     * @param  array  $permissions
     * @return void
     */
    private function __createPermissionIfNotExists($permissions)
    {
        $exising_permissions = Permission::whereIn('name', $permissions)
                                    ->pluck('name')
                                    ->toArray();

        $non_existing_permissions = array_diff($permissions, $exising_permissions);

        if (!empty($non_existing_permissions)) {
            foreach ($non_existing_permissions as $new_permission) {
                $time_stamp = \Carbon::now()->toDateTimeString();
                Permission::create([
                    'name' => $new_permission,
                    'guard_name' => 'web'
                ]);
            }
        }
    }
}

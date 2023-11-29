<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\Sale;
use App\Models\Master\Brand;
use App\Models\User;
use App\Models\Master\Package;
use App\Http\Controllers\Admin\Master\DataTables\SalesDataTable;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Session;

class SalesController extends Controller
{
    public function index(SalesDataTable $dataTable){
        $userID = auth()->id();
        $brand_data = Brand::where('status',1)->pluck('name','id');
        if(auth()->user()->getRoleNames()->first() != 'Admin'){
            $user_data = User::where(['status'=>1, 'department_id'=>1])->pluck('name','id');
         }else{
            $user_data = User::where(['status'=>1])->pluck('name','id');
            // dd($user_data);
        }
        
        return $dataTable->render('admin.master.sales.index',compact('brand_data','user_data'));
    }

    public function create(Request $request)
    {
        $userID = auth()->id();
        $roles = DB::table('model_has_roles')
            ->where('model_id', $userID)
            ->select('role_id')
            ->get();
        $userDepartment = User::where('id', $userID)->value('department_id');
        if(($roles['0']->role_id) == 3 && $userDepartment == 1){
            $brand_id = $request->brand_id;
            $package = Package::where(['brand_id'=>$brand_id, 'status'=>1])->get();
            return view('admin.master.sales.create', compact('brand_id','package','userID'));
        }else{
            return redirect()->route('sales.index');
        }
       
    }

    public function store(Request $request){
            $params_validate = [
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'mobile_number' => 'required|numeric|min:10|max:12',
                'alternate_mobile_number' => 'required|numeric|min:10|max:12',
                'social_security_number' => 'required|numeric|min:9|max:10',
                'date_of_birth' => 'required',
                'email' => 'required|email',
                'state_id' => 'required|string',
                'package_id' => 'required|string',
                'source' => 'required|string',
                'zip_code' => 'required|string',
                'prospect' => 'required|string',
                'order_status' => 'required|string',
                'father_mobile_number' => 'required|string',
                'father_occupation' => 'required',
                'city' => 'required|string',
                'screen_shot' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
                'audio' => 'required|image|mimes:mp3,wav',
                'previous_address' => 'required|string',
                'street_address' => 'required|string',
                'full_address' => 'required|string',
            ];
            $fields = get_system_fields(true);
            foreach ($fields as $field) {
                if ($field->is_required) {
                    $params_validate[$field->name] = 'required';
                }
            }
            $sale = Sale::create($request->all());

            if ($request->hasFile('screen_shot')) {
                if ($sale->getMedia('sale_screen_shot_photo') !== null && count($sale->getMedia('sale_screen_shot_photo')) > 0) {
                    $sale->clearMediaCollection('sale_screen_shot_photo');
                }
                $sale_data = $sale->addMedia($request->file('screen_shot')->getPathName())->toMediaCollection('sale_screen_shot_photo');
                $url = $sale_data->getUrl();
                $sale->screen_shot = $url;

            }
            if ($request->hasFile('audio')) {
                if ($sale->getMedia('sale_audio_file') !== null && count($sale->getMedia('sale_audio_file')) > 0) {
                    $sale->clearMediaCollection('sale_audio_file');
                }
                $sale_data = $sale->addMedia($request->file('audio')->getPathName())->toMediaCollection('sale_audio_file');
                $url = $sale_data->getUrl();
                $sale->audio = $url ;

            }
            $sale->save();
            $msg = "The Sale is added successfully";
            return redirect()->route('sales.index')->with('Success', $msg);
    }
     
    public function edit(Request $request){
            // $brand_id = $request->brand_id;
            $id=$request->sale;
            $sales = Sale::find($id);
            $package = Package::where(['brand_id'=>$sales->brand_id, 'status'=>1])->get();
            return view('admin.master.sales.edit', compact('sales','package'));
    }
     
    public function update(Request $request){
        // dd($request->all());
        $id =$request->sale;
        $sale = Sale::find($id);
        $inputs = $request->all();
        if ($request->hasFile('audio')) {
            $sale->clearMediaCollection('sale_audio_file');
            $mediaItem = $sale->addMedia($request->file('audio'))
                ->toMediaCollection('sale_audio_file');
            $url = $mediaItem->getUrl();
            $inputs['audio'] = $url;

        }
        if ($request->hasFile('screen_shot')) {
            $sale->clearMediaCollection('sale_screen_shot_photo');
            $mediaItem = $sale->addMedia($request->file('screen_shot'))
                ->toMediaCollection('sale_screen_shot_photo');
            $url = $mediaItem->getUrl();
            $inputs['screen_shot'] = $url;
        }
        $sale->update($inputs);
        if($request->input('order_status')!= null){
            DB::table('remarks')->insert([
                'comment' => $request->input('comment'),
                'order_status' => $request->input('order_status'),
                'sale_id' => $request->sale,
                'user_id' => auth()->id(),
                'created_at' => now(), 
            ]);
        }
        $msg = "The Sale data is updated successfully";
        return redirect()->route('sales.index')->with('Success', $msg);
    }

    public function show(Sale $sale)
    {
        // abort_if(Gate::denies('students.show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // dd($sale);
        $remarks = DB::table('remarks')->where('sale_id', $sale->id)->get();
        // DD($remarks);
        return view('admin.master.sales.show', compact('sale','remarks'));
    }
}

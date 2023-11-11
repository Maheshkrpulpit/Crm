<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Master\Package;
use App\Models\Master\Brand;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Master\Package\StoreRequest;
use App\Http\Requests\Master\Package\UpdateRequest;
use App\Http\Controllers\Admin\Master\DataTables\PackagesDataTable;

class PackagesController extends Controller
{
    public function index(PackagesDataTable $dataTable){
        abort_if(Gate::denies('packages.access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $dataTable->render('admin.master.packages.index');
    }

    public function create(Request $request)
    {
        abort_if(Gate::denies('packages.create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($request->ajax()){
            $brand = Brand::where('status', 1)->pluck('name','id');
            $viewHTML = view('admin.master.packages.create')->with('brands',$brand)->render();
            return response()->json(['success'=>true, 'htmlView'=>$viewHTML]);
        }
        return view('admin.master.packages.create');
    }
    // stores
    public function store(StoreRequest $request)
    {
               abort_if(Gate::denies('packages.create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
               if ($request->ajax()) {
                Package::create($request->all());
                $response = [
                    'success'    => true,
                    'message'   =>  __('The Package is added successfully')
                ];
                return response()->json($response);
            }
    }

    public function edit(Request $request, Package $package)
    {
        if($request->ajax()) {
            $brand = Brand::where('status', 1)->pluck('name','id');
            $viewHTML = view('admin.master.packages.edit')->with(['package'=>$package,'brands'=>$brand])->render();
            return response()->json(array('success' => true, 'htmlView'=>$viewHTML));
        }
    }

    public function update(UpdateRequest $request, Package $package)
    {
        abort_if(Gate::denies('packages.edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($request->ajax()){
            $inputs = $request->all();
            $package->update($inputs);
            $response = [
                'success'  =>true,
                'message'  => __ ('The Package is upadated successfully'),
            ];
            return response()->json($response);
        }
    }

    public function destroy(Package $package)
    {
         abort_if(Gate::denies('packages.delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $package->delete();
        $response=[
            'success' =>true,
            'message' => __('The Package is deleted successfully'),
        ];
        return response()->json($response);
    }

    public function changeStatus(Request $request, Package $package){
        abort_if(Gate::denies('packages.edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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
            $package->update(['status' => $request->status]);
            $response = [
                'status'    => 'true',
                'message'   =>  __('The Package status is updated successfully'),
            ];
            return response()->json($response);
        }
    }
}

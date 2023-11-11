<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Master\Brand;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Master\Brand\StoreRequest;
use App\Http\Requests\Master\Brand\UpdateRequest;
use App\Http\Controllers\Admin\Master\DataTables\BrandsDataTable;

class BrandsController extends Controller
{
    public function index(BrandsDataTable $dataTable){
        abort_if(Gate::denies('brands.access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $dataTable->render('admin.master.brands.index');
    }

    public function create(Request $request)
    {
        abort_if(Gate::denies('brands.create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($request->ajax()){
            $viewHTML = view('admin.master.brands.create')->render();
            return response()->json(['success'=>true, 'htmlView'=>$viewHTML]);
        }
        return view('admin.master.brands.create');
    }
    // stores
    public function store(StoreRequest $request)
    {
               abort_if(Gate::denies('brands.create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
               if ($request->ajax()) {
                $brand = Brand::create($request->all());

                if ($request->hasFile('attach_document')) {
                    if ($brand->getMedia('brand_photo') !== null && count($brand->getMedia('brand_photo')) > 0) {
                        $brand->clearMediaCollection('brand_photo');
                    }
                    $brand_data = $brand->addMedia($request->file('attach_document')->getPathName())->toMediaCollection('brand_photo');
                    $url = $brand_data->getUrl();
                }
                $brand->attach_document = $url;
                $brand->save();
                $response = [
                    'success'    => true,
                    'message'   =>  __('The Brand is added successfully')
                ];
                return response()->json($response);
            }
    }

    public function edit(Request $request, Brand $brand)
    {
        if($request->ajax()) {
            $viewHTML = view('admin.master.brands.edit')->with(['brand'=>$brand])->render();
            return response()->json(array('success' => true, 'htmlView'=>$viewHTML));
        }
    }

    public function update(UpdateRequest $request, Brand $brand)
    {
        abort_if(Gate::denies('brands.edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($request->ajax()){
            $inputs = $request->all();
            if ($request->hasFile('attach_document')) {
                $brand->clearMediaCollection('brand_photo');
                $mediaItem = $brand->addMedia($request->file('attach_document'))
                    ->toMediaCollection('brand_photo');
                $url = $mediaItem->getUrl();
                $inputs['attach_document'] = $url;
            }
            $brand->update($inputs);
            $response = [
                'success'  =>true,
                'message'  => __ ('The Brand is upadated successfully'),
            ];
            return response()->json($response);
        }
    }

    public function destroy(Brand $brand)
    {
         abort_if(Gate::denies('brands.delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $brand->delete();
        $response=[
            'success' =>true,
            'message' => __('The Brand is deleted successfully'),
        ];
        return response()->json($response);
    }

    public function changeStatus(Request $request, Brand $brand){
        abort_if(Gate::denies('brands.edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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
            $brand->update(['status' => $request->status]);
            $response = [
                'status'    => 'true',
                'message'   =>  __('The Brand status is updated successfully'),
            ];
            return response()->json($response);
        }
    }
}

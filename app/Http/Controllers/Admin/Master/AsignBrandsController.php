<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Master\AsignBrand;
use App\Models\Master\Brand;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Master\AsignBrand\StoreRequest;
use App\Http\Requests\Master\AsignBrand\UpdateRequest;
use App\Http\Controllers\Admin\Master\DataTables\AsignBrandsDataTable;

class AsignBrandsController extends Controller
{
    public function index(Request $request, AsignBrandsDataTable $dataTable){
        abort_if(Gate::denies('asign_brands.access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user_id = $request->user;
        return $dataTable->render('admin.master.asignBrands.index', compact('user_id'));
    }

    public function create(Request $request)
    {
        abort_if(Gate::denies('asign_brands.create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($request->ajax()){
            $user_id = $request->user_id;
            $brand = Brand::where('status', 1)->pluck('name','id');
            $viewHTML = view('admin.master.asignBrands.create')->with(['brand'=>$brand, 'user_id'=>$user_id])->render();
            return response()->json(['success'=>true, 'htmlView'=>$viewHTML]);
        }
        return view('admin.master.asignBrands.create');
    }
    // stores
    public function store(StoreRequest $request)
    {
               abort_if(Gate::denies('asign_brands.create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
               if ($request->ajax()) {
                // dd($request->all());
                $users = $request['user_id'];
                $brand_id = $request['brand_id'];
                $comission = $request['comission'];
                $amount = $request['amount'];
                foreach ($users as $key => $user) {
                    AsignBrand::create([
                        'user_id' => $user,
                        'brand_id' => $brand_id[$key],
                        'comission' => isset($comission[$key]) && $comission[$key] == 1 ? 1 : 0,
                        'amount' => $amount[$key],
                    ]);
                }
                
                $response = [
                    'success'    => true,
                    'message'   =>  __('The Asign Brand is added successfully')
                ];
                return response()->json($response);
            }
    }

    public function edit(Request $request, AsignBrand $asignBrand)
    {
        if($request->ajax()) {
            $brand = Brand::where('status', 1)->pluck('name','id');
            $viewHTML = view('admin.master.asignBrands.edit')->with(['asignBrand'=>$asignBrand,'brand'=>$brand])->render();
            return response()->json(array('success' => true, 'htmlView'=>$viewHTML));
        }
    }

    public function update(Request $request, AsignBrand $asignBrand)
    {
        abort_if(Gate::denies('asign_brands.edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $users = $request->user_id;
            $brand_ids = $request->brand_id;
            $comission = $request->comission;
            $amounts = $request->amount;
            $recordId = $asignBrand->id;
            foreach ($users as $key => $user) {
                $asignBrand = AsignBrand::find($recordId);
                if (!$asignBrand) {
                    $response = [
                        'success' => false,
                        'message' => __('The Asign Brand does not exist'),
                    ];
                    return response()->json($response);
                }
                $asignBrand->update([
                    'user_id' => $user,
                    'brand_id' => $brand_ids[$key],
                    'comission' => isset($comission[$key]) && $comission[$key] == 1 ? 1 : 0,
                    'amount' =>isset($comission[$key]) && $comission[$key] == 1 ?  $amounts[$key] : 0,
                    //  $amounts[$key],
                ]);
            }

            $response = [
                'success' => true,
                'message' => __('The Asign Brand is updated successfully'),
            ];
            return response()->json($response);
        }
    }

    public function destroy(AsignBrand $asignBrand)
    {
         abort_if(Gate::denies('asign_brands.delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $asignBrand->delete();
        $response=[
            'success' =>true,
            'message' => __('The Asign Brand is deleted successfully'),
        ];
        return response()->json($response);
    }

    
}

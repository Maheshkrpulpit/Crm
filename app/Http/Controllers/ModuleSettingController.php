<?php

namespace App\Http\Controllers;

use App\Models\ModuleSetting;
use Illuminate\Http\Request;

class ModuleSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            try {

             if($request->has('modules')):
  

            \DB::transaction(function() use ($request) {

                ModuleSetting::whereNotIn('code',$request->modules)->update(array('status'=>0,'updated_by'=>auth()->id()));

                foreach($request->modules as $code):

                ModuleSetting::updateOrCreate(['code'=>$code],['code'=>$code,'status'=>1,'updated_by'=>auth()->id()]);

                endforeach;
      
        });
            endif;

            $output = ['success' => 1,
                            'msg' => __("The module settings updated successfully")
                        ];



        } catch (Exception $e) {

            $output = ['error' => 1,
                            'msg' => __("something went wrong"),
                        ];
                
            }


            
            return redirect()->route('settings.index.tab',$request->tab)->with(['status'=>$output])->withTab($request->tab??'');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ModuleSetting  $moduleSetting
     * @return \Illuminate\Http\Response
     */
    public function show(ModuleSetting $moduleSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ModuleSetting  $moduleSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(ModuleSetting $moduleSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ModuleSetting  $moduleSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ModuleSetting $moduleSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ModuleSetting  $moduleSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(ModuleSetting $moduleSetting)
    {
        //
    }
}

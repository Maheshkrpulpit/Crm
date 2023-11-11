<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentSetting;

class PaymentSettingController extends Controller
{
    public function index($tab='flutterwave')
    {
        $paymentGateways=PaymentSetting::all();
       
        return view('settings.payment.index',compact('paymentGateways','tab'));
    }


    public function store(Request $request)
    {
        switch ($request->tab) {

            case 'atompay':

                $request->validate(['mode'=>'required','login'=>'required','password'=>'required','client_code'=>'required','hash_request_key'=>'required','hash_response_key'=>'required']);

                $options=$request->only('mode','login','password','client_code','hash_response_key','hash_request_key');


                break;

                case 'flutterwave':

        $request->validate(['FLW_PUBLIC_KEY'=>'required','FLW_SECRET_KEY'=>'required','FLW_SECRET_HASH'=>'required']);

                $options=$request->only('FLW_PUBLIC_KEY','FLW_SECRET_KEY','FLW_SECRET_HASH');

                $this->setOptions($options);




                break;
            
            default:
                // code...
                break;
        }
    

            
            

            try {


                 $this->updateDefault($request);

                PaymentSetting::updateOrCreate(['title'=>$request->tab],['options'=>json_encode($options),'status'=>$request->status??0,'is_default'=>$request->is_default??0]);

                
                
                $response= ['success' => 1,
                        'msg' => __("locale.messages.update_success",['model'=>__('locale.models.payment_settings')]),
                        'type'=>'success',];
         
             
         } catch (Exception $e) {

             if(config('app.debug') == true):

            $response= ['success' => 0,
                        'msg' => $e->getMessage(),
                        'type'=>'danger',
                    ];

         else:

            $response= ['success' => 0,
                        'msg' => __('locale.messages.something_went_wrong'),
                        'type'=>'danger',
                    ];


         endif;
            }


        return redirect()->back()->with(['status'=>$response])->withTab($request->tab??'');
    }

    public function setOptions($options)
    {
        foreach($options as $key=> $option):

                   $this->setEnv($key,$option);

                endforeach;
    }

    public function updateDefault($request)
    {
             if(isset($request->is_default)):

                    PaymentSetting::where('id','>',0)->update(['is_default'=>0]);

                endif;

    }

    public static function setEnv($key, $value)
    {
        $file_path = base_path('.env');
        $data      = file($file_path);
        $data      = array_map(function ($data) use ($key, $value) {
            return stristr($data, $key) ? "$key=\"$value\"\n" : $data;
        }, $data);

        // Write file
        $env_file = fopen($file_path, 'w') or die('Unable to open file!');
        fwrite($env_file, implode('', $data));
        fclose($env_file);
    }
}

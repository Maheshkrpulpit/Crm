<?php

namespace App\Http\Controllers;

use App\Models\SystemSetting;
use Illuminate\Http\Request;

class SystemSettingController extends Controller
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
    public function emailSetting(Request $request)
    {
        $request->validate(['mail_host' => 'required', 'mail_username' => 'required']);
        // echo '<pre>';print_r($request->file('logo')->getPathName());die;

        try {

            \DB::beginTransaction();


            $email_settings = array('mail_from_name' => $request->mail_from_name, 'mail_host' => $request->mail_host,
                                     'mail_password'=>$request->mail_password,'mail_username'=>$request->mail_username,
                                     'mail_port'=>$request->mail_port,'mail_encryption'=>$request->mail_encryption);


            $exist = ['name' => 'email'];





            $settings = SystemSetting::updateOrCreate($exist, array('options'=>json_encode($email_settings),'updated_by'=>auth()->id()));



            foreach($email_settings as $key=> $value)
            {
               $this->setEnv(strtoupper($key),$value);
            }






          
            $output = [
                'success' => 1,
                'msg' => __("locale.messages.update_success", ['model' => __('locale.models.email_settings')]),
                'type' => 'success',
            ];

            \DB::commit();

            


            return redirect()->route('settings.index.tab', $request->tab)->with(['status' => $output])->withTab($request->tab ?? '');
        } catch (Exception $e) {
            \DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SystemSetting  $systemSetting
     * @return \Illuminate\Http\Response
     */
    public function show(SystemSetting $systemSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SystemSetting  $systemSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(SystemSetting $systemSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SystemSetting  $systemSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SystemSetting $systemSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SystemSetting  $systemSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(SystemSetting $systemSetting)
    {
        //
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

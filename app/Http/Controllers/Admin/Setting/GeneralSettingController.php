<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Models\GeneralSetting;
use App\Models\User;
use Illuminate\Http\Request;

class GeneralSettingController extends Controller
{
    public function index()
    {
        $general_settings_all = GeneralSetting::get();
        $general_setting = [];
        foreach ($general_settings_all as $value) {
            $general_setting[$value->setting_key] = $value->setting_value;
        }
        return view('admin.settings.general_settings', compact('general_setting'));
    }

    public function generalSave(Request $request)
    {
        /* if (!auth()->user()->can('user.create')) {
             abort(403, 'Unauthorized action.');
         }*/

        try {

            foreach ($request->except('_token') as $key => $value) {
                set_general_setting($key, $value);
            }

            $output = [
                'success' => 1,
                'msg' => lang("General settings was successfully updated.", "alerts"),
            ];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

            $output = [
                'success' => 0,
                'msg' => lang("Something went wrong!", "alerts"),
            ];
        }
        if($request->ajax()){
            return $output;
        }

        return redirect()->back()->with('status', $output);
    }

    public function saveLogo(Request $request)
    {
        $condition = ['key' => "required"];
        $key = $request->key;
        if ($key == 'dark_logo') {
            $condition['dark_logo'] = 'required|image|mimes:jpeg,png,jpg,svg|max:2048|dimensions:min_width=290,min_height=51';
        } else if ($key == 'light_logo') {
            $condition['light_logo'] = 'required|image|mimes:jpeg,png,jpg,svg|max:2048|dimensions:min_width=290,min_height=51';
        } else if ($key == 'dark_logo_small') {
            $condition['dark_logo_small'] = 'required|image|mimes:jpeg,png,jpg,svg|max:2048|dimensions:min_width=32,min_height=32';
        } else if ($key == 'light_logo_small') {
            $condition['light_logo_small'] = 'required|image|mimes:jpeg,png,jpg,svg|max:2048|dimensions:min_width=32,min_height=32';
        }

        /*else if ($key == 'print_logo') {
            $condition['print_logo'] = 'required|image|mimes:jpeg,png,jpg,svg|max:2048|dimensions:min_width=184,min_height=170';
        } else if ($key == 'admin_logo') {
            $condition[$key] = 'required|image|mimes:jpeg,png,jpg,svg|max:2048|dimensions:min_width=290,min_height=51';
        } else if ($key == 'admin_small_logo') {
            $condition[$key] = 'required|image|mimes:jpeg,png,jpg,svg|max:2048|dimensions:min_width=32,min_height=32';
        } else if ($key == 'app_logo') {
            $condition[$key] = 'required|image|mimes:jpeg,png,jpg,svg|max:2048|dimensions:min_width=290,min_height=51';
        } else if ($key == 'admin_login_background') {
            $condition[$key] = 'required|image|mimes:jpeg,png,jpg,svg|max:2048|dimensions:min_width=1460,min_height=1080';
        } else if ($key == 'user_login_background') {
            $condition[$key] = 'required|image|mimes:jpeg,png,jpg,svg|max:2048|dimensions:min_width=1460,min_height=1080';
        }*/

        $request->validate($condition);
        try {
            \DB::beginTransaction();
            $user = User::where('id', auth()->user()->id)->first();

            if ($request->has($key)) {

                if ($user->getMedia($key) !== null && count($user->getMedia($key)) > 0) {
                    $user->clearMediaCollection($key);
                }

                $logo_data = $user->addMedia($request->file($key)->getPathName())
                    ->toMediaCollection($key);

                $logo = $logo_data->getUrl();

                set_general_setting($key . '_url', $logo);

                $output = [
                    'status' => 1,
                    'type' => 'success',
                    'msg' => lang("General settings was successfully updated.", "alerts"),
                    'data' => $logo
                ];

                \DB::commit();
            } else {
                $output = [
                    'status' => 0,
                    'type' => 'failure',
                    'msg' => lang("Something went wrong!", "alerts"),
                    'data' => null
                ];
            }

        } catch (Exception $e) {
            \DB::rollBack();
            $output = [
                'status' => 0,
                'msg' => lang("Something went wrong!", "alerts"),
                'type' => 'failure',
                'data' => null
            ];
        }

        return $output;
    }
}

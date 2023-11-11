<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\ThemeSetting;

class ThemeSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('settings::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('settings::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        try {
            $exist = ['user_id' => $user->id];
            $themeSetting = $request->themeSetting;
            unset($themeSetting['defaultAttribute']);
            ThemeSetting::updateOrCreate($exist, ['user_id' => $user->id, 'config' => json_encode($themeSetting)]);
            $response = array('status' => 1, 'message' => lang('Theme updated successfully.'), 'type' => 'success');
        } catch (Exception $e) {
            $response = array('status' => 1, 'message' => lang('Try after sometime.'), 'type' => 'danger');
        }
        return $response;
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('settings::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('settings::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}

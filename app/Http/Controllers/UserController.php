<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=auth()->user();
        return view('profile.index',compact('user'));
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
        //
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
        $user=auth()->user();

        if($user->id == $id):
            return view('profile.edit',compact('user'));
        else:
           return redirect(404);
        endif;
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
        $request->validate(['first_name'=>'required','email'=>'required|unique:users,id,'.$id]);

        try {

            \App\Models\User::find($id)->update($request->all());

           $output = [
                'success' => 1,
                'msg' => __("locale.messages.update_success", ['model' => __('locale.models.user')]),
                'type' => 'success',
            ];

             return redirect()->route('user.profile')->with(['status' => $output]);

            
        } catch (Exception $e) {
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updatePassword(Request $request ,$id)
    {

        if(auth()->id()==$id):
            $user=auth()->user();
        $request->validate(['password_confirmation'=>'required_with:password|same:password','password' => 'required|confirmed','old_password'=>'required']);
        if (\Hash::check($request->old_password, $user->password)) { 
   $user->fill([
    'password' => \Hash::make($request->password)
    ])->save();

        $output = [
                'success' => 1,
                'msg' => __("locale.messages.update_success", ['model' => __('locale.models.password')]),
                'type' => 'success',
            ];

             return redirect()->route('user.profile')->with(['status' => $output]);
    }
   endif;
}

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\User;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Hash;


class ChangePasswordController extends Controller {
    public function index(Request $request)
    {
		$request->session()->flash('pageName', 'Password Management');
        return view('admin.changepassword.index');

	}
    public function update(Request $request)
	{
        $rules = array(
                'old_password'=>'required|min:6',
                'new_password'    => 'required|min:6|different:old_password',
                'confirm_password'=>'required|min:6|same:new_password',
        );
        $input=$request->all();
        //print_r($input);die;
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
          // send back to the page with the input data and errors
          return Redirect::back()->withInput()->withErrors($validator);
          $request->session()->put('pageName', 'Password Management');
        }elseif (Hash::check($input['old_password'], Auth::user()->password)) {

                $user = User::find(Auth::user()->id);
                $user->password = Hash::make($input['new_password']);
                $user->save();
                $request->session()->flash('pageName', 'Password Management');
                $request->session()->flash('status', 'Password Updated Successfully');
                return Redirect::back()->with('success', true)->with('message','Successfully updated.');
        } else  {
            $request->session()->flash('pageName', 'Password Management');
            return Redirect::back()->withErrors('Incorrect old password');
        }

	}
    
}
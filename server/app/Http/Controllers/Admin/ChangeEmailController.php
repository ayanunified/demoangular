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


class ChangeEmailController extends Controller {
    public function index(Request $request)
    {
		$request->session()->flash('pageName', 'Email Management');
        return view('admin.changeemail.index');

	}
    public function update(Request $request)
	{
        $rules = array(
                'email'=>'required|email|unique:users',
        );
        $input=$request->all();
        //print_r($input);die;
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
          // send back to the page with the input data and errors
          $request->session()->put('pageName', 'Email Management');
          return Redirect::back()->withInput()->withErrors($validator);
        }else {

                $user = User::find(Auth::user()->id);
                $user->email =$input['email'];
                $user->save();
                $request->session()->flash('pageName', 'Email Management');
                 $request->session()->flash('status', 'Email Updated Successfully');
                return Redirect::back()->with('success', true)->with('message','Successfully updated.');
       

		//return redirect()->route('admin.homepage.index');
	}
	}
    
}
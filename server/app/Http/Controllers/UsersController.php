<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;
use File;
class UsersController extends Controller
{
    /**
     * Show a list of users
     * @return \Illuminate\View\View
     */
    public function index()
    {
		//echo 123;die;
        $users = User::where('role_id',2)->get();
        //print_r($users[0]->image);die;
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show a page of user creation
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::lists('title', 'id');

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Insert new user into the system
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $input = $request->all();
        //print_r($input);die;
        $input['password'] = Hash::make($input['password']);
        $input['name']=$input['first_name'].' '.$input['last_name'];
        $rules = array(
                'first_name'=>'required',
                'last_name'=>'required',
                'email'    => 'required|email|unique:users,email', // make sure the email is an actual email
                'password' => 'required|min:6',
               //'image' => 'required' // password can only be alphanumeric and has to be greater than 3 characters
           );
            if(Input::file('image')){
              $rules['image']='required|image';
              //$extension = Input::file('image')->getClientOriginalExtension();
              //$extension_accept=array('jpg','jpeg','png','gif');
              //if(inarray($extension_accept))
            }
           // print_r($rules);die;
			//$file = array('image' => Input::file('image'));
			// setting up rules
			//$rules = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
			// doing the validation, passing post data, rules and the messages
			$validator = Validator::make($input, $rules);
			if ($validator->fails()) {
			  // send back to the page with the input data and errors
			  return Redirect::back()->withInput()->withErrors($validator);
			}
			else {
			  // checking file is valid.
              if(Input::file('image')){
			  if (Input::file('image')->isValid()) {
				$destinationPath = 'uploads/profile'; // upload path
				$thumbPath = 'uploads/profile/thumb';
				$extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
				$fileName = rand(11111,99999).'.'.$extension; // renameing image
				if(Input::file('image')->move($destinationPath, $fileName)){ // uploading file to given path
				Image::make($destinationPath.'/'.$fileName)->resize(100, 100)->save($thumbPath.'/'.$fileName);
                $input['image']=$fileName;
				//User::where('id', $id)->update(['image' => $fileName]);
                //File::Delete('uploads/profile/'.$user->image);
               // File::Delete('uploads/profile/thumb/'.$user->image);
				
				}
			  }
			  else {
				return Redirect::back()->withInput()->withErrors('Please upload a image file');
			  }
              }
		}
        //unset($input['image']);
        $user = User::create($input);

        return redirect()->route('users.index')->withMessage(trans('quickadmin::admin.users-controller-successfully_created'));
    }

    /**
     * Show a user edit page
     *
     * @param $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user  = User::findOrFail($id);
        $roles = Role::lists('title', 'id');

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update our user information
     *
     * @param Request $request
     * @param         $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $input = $request->all();
        $input['name']=$input['first_name'].' '.$input['last_name'];
       // print_r($input);die;
         // getting all of the post data
            $rules = array(
                'first_name'=>'required',
                'last_name'=>'required',
                'email'    => 'required|email|unique:users,email,'.$id, // make sure the email is an actual email
               //'image' => 'required' // password can only be alphanumeric and has to be greater than 3 characters
           );
            if(Input::file('image')){
              $rules['image']='required|image|max:8000';
              //$extension = Input::file('image')->getClientOriginalExtension();
              //$extension_accept=array('jpg','jpeg','png','gif');
              //if(inarray($extension_accept))
            }
           // print_r($rules);die;
			//$file = array('image' => Input::file('image'));
			// setting up rules
			//$rules = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
			// doing the validation, passing post data, rules and the messages
			$validator = Validator::make($input, $rules);
			if ($validator->fails()) {
			  // send back to the page with the input data and errors
			  return Redirect::back()->withInput()->withErrors($validator);
			}
			else {
			  // checking file is valid.
              if(Input::file('image')){
			  if (Input::file('image')->isValid()) {
				$destinationPath = 'uploads/profile'; // upload path
				$thumbPath = 'uploads/profile/thumb';
				$extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
				$fileName = rand(11111,99999).'.'.$extension; // renameing image
				if(Input::file('image')->move($destinationPath, $fileName)){ // uploading file to given path
				Image::make($destinationPath.'/'.$fileName)->resize(100, 100)->save($thumbPath.'/'.$fileName);
				User::where('id', $id)->update(['image' => $fileName]);
                File::Delete('uploads/profile/'.$user->image);
                File::Delete('uploads/profile/thumb/'.$user->image);
				
				}
			  }
			  else {
				return Redirect::back()->withInput()->withErrors('Please upload a image file');
			  }
              }
		}
        unset($input['image']);
        //$input['password'] = Hash::make($input['password']);
        $user->update($input);

        return redirect()->route('users.index')->withMessage(trans('quickadmin::admin.users-controller-successfully_updated'));
    }

    /**
     * Destroy specific user
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        User::destroy($id);
        if($user){
          File::Delete('uploads/profile/'.$user->image);
          File::Delete('uploads/profile/thumb/'.$user->image);  
        }
        return redirect()->route('users.index')->withMessage(trans('quickadmin::admin.users-controller-successfully_deleted'));
    }
    public function massDelete(Request $request)
    {
       
        $image_delete=json_decode($request->get('delete_image'));
        foreach($image_delete as $object)
        {
            File::Delete('uploads/profile/'.$object);
             File::Delete('uploads/profile/thumb/'.$object);  
        }
        if ($request->get('toDelete') != 'mass') {
            $toDelete = json_decode($request->get('toDelete'));
            User::destroy($toDelete);
            //echo 1;die;
        } else {
            //echo 2;die;
            User::where('role_id',2)->delete();
        }

        return redirect()->route('users.index');
    }
}

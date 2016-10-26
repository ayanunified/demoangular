<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\LoginLogs;
use App\Http\Requests\CreateLoginLogsRequest;
use App\Http\Requests\UpdateLoginLogsRequest;
use Illuminate\Http\Request;

use App\Customers;


class LoginLogsController extends Controller {

	/**
	 * Display a listing of loginlogs
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $loginlogs = LoginLogs::with("customers")->get();
        $request->session()->flash('pageName', 'Login Logs');
		return view('admin.loginlogs.index', compact('loginlogs'));
	}

	/**
	 * Show the form for creating a new loginlogs
	 *
     * @return \Illuminate\View\View
	 */
	public function create(Request $request)
	{
	    $customers = Customers::lists("legalName", "id")->prepend('Please select', '');

	    $request->session()->flash('pageName', 'Login Logs');
	    return view('admin.loginlogs.create', compact("customers"));
	}

	/**
	 * Store a newly created loginlogs in storage.
	 *
     * @param CreateLoginLogsRequest|Request $request
	 */
	public function store(CreateLoginLogsRequest $request)
	{
	    
		LoginLogs::create($request->all());
		$request->session()->flash('pageName', 'Login Logs');
		return redirect()->route('admin.loginlogs.index');
	}

	/**
	 * Show the form for editing the specified loginlogs.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id,Request $request)
	{
		$loginlogs = LoginLogs::find($id);
	    $customers = Customers::lists("legalName", "id")->prepend('Please select', '');

	    $request->session()->flash('pageName', 'Login Logs');
		return view('admin.loginlogs.edit', compact('loginlogs', "customers"));
	}

	/**
	 * Update the specified loginlogs in storage.
     * @param UpdateLoginLogsRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateLoginLogsRequest $request)
	{
		$loginlogs = LoginLogs::findOrFail($id);

        

		$loginlogs->update($request->all());
		$request->session()->flash('pageName', 'Login Logs');
		return redirect()->route('admin.loginlogs.index');
	}

	/**
	 * Remove the specified loginlogs from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id,Request $request)
	{
		LoginLogs::destroy($id);
		$request->session()->flash('pageName', 'Login Logs');
		$request->session()->flash('status', 'Log Deleted Successfully');
		return redirect()->route('admin.loginlogs.index');
	}

    /**
     * Mass delete function from index page
     * @param Request $request
     *
     * @return mixed
     */
    public function massDelete(Request $request)
    {
        if ($request->get('toDelete') != 'mass') {
            $toDelete = json_decode($request->get('toDelete'));
            LoginLogs::destroy($toDelete);
        } else {
            LoginLogs::whereNotNull('id')->delete();
        }
        $request->session()->flash('pageName', 'Login Logs');
        $request->session()->flash('status', 'Log Deleted Successfully');
        return redirect()->route('admin.loginlogs.index');
    }

}

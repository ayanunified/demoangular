<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Memberships;
use App\Http\Requests\CreateMembershipsRequest;
use App\Http\Requests\UpdateMembershipsRequest;
use Illuminate\Http\Request;



class MembershipsController extends Controller {

	/**
	 * Display a listing of memberships
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $memberships = Memberships::all();
        $request->session()->flash('pageName', 'Membership Management');
		return view('admin.memberships.index', compact('memberships'));
	}

	/**
	 * Show the form for creating a new memberships
	 *
     * @return \Illuminate\View\View
	 */
	public function create(Request $request)
	{
	    
	    
	    return view('admin.memberships.create');
	}

	/**
	 * Store a newly created memberships in storage.
	 *
     * @param CreateMembershipsRequest|Request $request
	 */
	public function store(CreateMembershipsRequest $request)
	{
	    
		Memberships::create($request->all());
		$request->session()->flash('pageName', 'Membership Management');
		$request->session()->flash('status', 'Membership Created Successfully');
		return redirect()->route('admin.memberships.index');
	}

	/**
	 * Show the form for editing the specified memberships.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id,Request $request)
	{
		$memberships = Memberships::find($id);
	    
	    $request->session()->flash('pageName', 'Membership Management');
		return view('admin.memberships.edit', compact('memberships'));
	}

	/**
	 * Update the specified memberships in storage.
     * @param UpdateMembershipsRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateMembershipsRequest $request)
	{
		$memberships = Memberships::findOrFail($id);

        

		$memberships->update($request->all());
		$request->session()->flash('pageName', 'Membership Management');
		$request->session()->flash('status', 'Membership Updated Successfully');
		return redirect()->route('admin.memberships.index');
	}

	/**
	 * Remove the specified memberships from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id,Request $request)
	{
		$memberships = Memberships::find($id);
		$memberships->forceDelete();
		$request->session()->flash('pageName', 'Membership Management');
		$request->session()->flash('status', 'Membership Deleted Successfully');
		return redirect()->route('admin.memberships.index');
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
            foreach($toDelete as $delete)
            {
            	$memberships = Memberships::find($delete);
				$memberships->forceDelete();
            }
        } else {
            Memberships::whereNotNull('id')->delete();
        }
        $request->session()->flash('pageName', 'Membership Management');
        $request->session()->flash('status', 'Membership Deleted Successfully');
        return redirect()->route('admin.memberships.index');
    }

}

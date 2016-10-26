<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Dashboardimages;
use App\Http\Requests\CreateDashboardimagesRequest;
use App\Http\Requests\UpdateDashboardimagesRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;


class DashboardimagesController extends Controller {

	/**
	 * Display a listing of dashboardimages
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $dashboardimages = Dashboardimages::all();
        $request->session()->flash('pageName', 'Dashboard Banner Management');
		return view('admin.dashboardimages.index', compact('dashboardimages'));
	}

	/**
	 * Show the form for creating a new dashboardimages
	 *
     * @return \Illuminate\View\View
	 */
	public function create(Request $request)
	{
	    
	    $request->session()->flash('pageName', 'Dashboard Banner Management');
	    return view('admin.dashboardimages.create');
	}

	/**
	 * Store a newly created dashboardimages in storage.
	 *
     * @param CreateDashboardimagesRequest|Request $request
	 */
	public function store(CreateDashboardimagesRequest $request)
	{
	    $request->session()->flash('pageName', 'Dashboard Banner Management');
		 $request->session()->flash('status', 'Dashboard Banner Created Successfully');
	    $request = $this->saveFiles($request);
		Dashboardimages::create($request->all());
		 
		return redirect()->route('admin.dashboardimages.index');
	}

	/**
	 * Show the form for editing the specified dashboardimages.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id,Request $request)
	{
		$dashboardimages = Dashboardimages::find($id);
	    
	     $request->session()->flash('pageName', 'Dashboard Banner Management');
		return view('admin.dashboardimages.edit', compact('dashboardimages'));
	}

	/**
	 * Update the specified dashboardimages in storage.
     * @param UpdateDashboardimagesRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateDashboardimagesRequest $request)
	{
		$request->session()->flash('pageName', 'Dashboard Banner Management');
		$request->session()->flash('status', 'Dashboard Banner Updated Successfully');
		$dashboardimages = Dashboardimages::findOrFail($id);

        $request = $this->saveFiles($request);

		$dashboardimages->update($request->all());
		 
		return redirect()->route('admin.dashboardimages.index');
	}

	/**
	 * Remove the specified dashboardimages from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id,Request $request)
	{
		Dashboardimages::destroy($id);
		 $request->session()->flash('pageName', 'Dashboard Banner Management');
		 $request->session()->flash('status', 'Dashboard Banner Deleted Successfully');
		return redirect()->route('admin.dashboardimages.index');
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
            Dashboardimages::destroy($toDelete);
        } else {
            Dashboardimages::whereNotNull('id')->delete();
        }
         $request->session()->flash('pageName', 'Dashboard Banner Management');
         $request->session()->flash('status', 'Dashboard Banner Deleted Successfully');
        return redirect()->route('admin.dashboardimages.index');
    }

}

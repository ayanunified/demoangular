<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Reportpatients;
use App\Http\Requests\CreateReportpatientsRequest;
use App\Http\Requests\UpdateReportpatientsRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;


class ReportpatientsController extends Controller {

	/**
	 * Display a listing of reportpatients
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $reportpatients = Reportpatients::all();

        $request->session()->flash('pageName', 'Report Banner Management');
		return view('admin.reportpatients.index', compact('reportpatients'));
	}

	/**
	 * Show the form for creating a new reportpatients
	 *
     * @return \Illuminate\View\View
	 */
	public function create(Request $request)
	{
	    
	    $request->session()->flash('pageName', 'Report Banner Management');
	    return view('admin.reportpatients.create');
	}

	/**
	 * Store a newly created reportpatients in storage.
	 *
     * @param CreateReportpatientsRequest|Request $request
	 */
	public function store(CreateReportpatientsRequest $request)
	{
	    $request->session()->flash('pageName', 'Report Banner Management');
		$request->session()->flash('status', 'Banner Created Successfully');
	    $request = $this->saveFiles($request);
		Reportpatients::create($request->all());
		
		return redirect()->route('admin.reportpatients.index');
	}

	/**
	 * Show the form for editing the specified reportpatients.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id,Request $request)
	{
		$reportpatients = Reportpatients::find($id);
	    
	    $request->session()->flash('pageName', 'Report Banner Management');
		return view('admin.reportpatients.edit', compact('reportpatients'));
	}

	/**
	 * Update the specified reportpatients in storage.
     * @param UpdateReportpatientsRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateReportpatientsRequest $request)
	{
		$request->session()->flash('pageName', 'Report Banner Management');
		$request->session()->flash('status', 'Banner Updated Successfully');
		$reportpatients = Reportpatients::findOrFail($id);

        $request = $this->saveFiles($request);

		$reportpatients->update($request->all());
		
		return redirect()->route('admin.reportpatients.index');
	}

	/**
	 * Remove the specified reportpatients from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id,Request $request)
	{
		Reportpatients::destroy($id);
		$request->session()->flash('pageName', 'Report Banner Management');
		 $request->session()->flash('status', 'Banner Deleted Successfully');
		return redirect()->route('admin.reportpatients.index');
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
            Reportpatients::destroy($toDelete);
        } else {
            Reportpatients::whereNotNull('id')->delete();
        }
        $request->session()->flash('pageName', 'Report Banner Management');
        $request->session()->flash('status', 'Banner Deleted Successfully');
        return redirect()->route('admin.reportpatients.index');
    }

}

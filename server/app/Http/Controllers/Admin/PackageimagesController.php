<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Packageimages;
use App\Http\Requests\CreatePackageimagesRequest;
use App\Http\Requests\UpdatePackageimagesRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;


class PackageimagesController extends Controller {

	/**
	 * Display a listing of packageimages
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $packageimages = Packageimages::all();
        $request->session()->flash('pageName', 'Package Banner Management');
		return view('admin.packageimages.index', compact('packageimages'));
	}

	/**
	 * Show the form for creating a new packageimages
	 *
     * @return \Illuminate\View\View
	 */
	public function create(Request $request)
	{
	    
	    $request->session()->flash('pageName', 'Package Banner Management');
	    return view('admin.packageimages.create');
	}

	/**
	 * Store a newly created packageimages in storage.
	 *
     * @param CreatePackageimagesRequest|Request $request
	 */
	public function store(CreatePackageimagesRequest $request)
	{
	    $request->session()->flash('pageName', 'Package Banner Management');
		$request->session()->flash('status', 'Package Banner Created Successfully');
	    $request = $this->saveFiles($request);
		Packageimages::create($request->all());
		
		return redirect()->route('admin.packageimages.index');
	}

	/**
	 * Show the form for editing the specified packageimages.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id,Request $request)
	{
		$packageimages = Packageimages::find($id);
	    
	    $request->session()->flash('pageName', 'Package Banner Management');
		return view('admin.packageimages.edit', compact('packageimages'));
	}

	/**
	 * Update the specified packageimages in storage.
     * @param UpdatePackageimagesRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdatePackageimagesRequest $request)
	{
		$request->session()->flash('pageName', 'Package Banner Management');
		$request->session()->flash('status', 'Package Banner Updated Successfully');
		$packageimages = Packageimages::findOrFail($id);

        $request = $this->saveFiles($request);

		$packageimages->update($request->all());
		
		return redirect()->route('admin.packageimages.index');
	}

	/**
	 * Remove the specified packageimages from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id,Request $request)
	{
		Packageimages::destroy($id);
		$request->session()->flash('pageName', 'Package Banner Management');
		$request->session()->flash('status', 'Package Banner Deleted Successfully');
		return redirect()->route('admin.packageimages.index');
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
            Packageimages::destroy($toDelete);
        } else {
            Packageimages::whereNotNull('id')->delete();
        }
        $request->session()->flash('pageName', 'Package Banner Management');
        $request->session()->flash('status', 'Package Banner Deleted Successfully');
        return redirect()->route('admin.packageimages.index');
    }

}

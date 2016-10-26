<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\SiteSettings;
use App\Http\Requests\CreateSiteSettingsRequest;
use App\Http\Requests\UpdateSiteSettingsRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;


class SiteSettingsController extends Controller {

	/**
	 * Display a listing of sitesettings
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    	{
        	//$sitesettings = SiteSettings::all();

		//return view('admin.sitesettings.index', compact('sitesettings'));
		$sitesettings = SiteSettings::find(1);
	    
	    $request->session()->flash('pageName', 'Site Settings Management');
		return view('admin.sitesettings.edit', compact('sitesettings'));
	}

	/**
	 * Show the form for creating a new sitesettings
	 *
     * @return \Illuminate\View\View
	 */
	public function create(Request $request)
	{
	    
	    $request->session()->flash('pageName', 'Site Settings Management');
	    return view('admin.sitesettings.create');
	}

	/**
	 * Store a newly created sitesettings in storage.
	 *
     * @param CreateSiteSettingsRequest|Request $request
	 */
	public function store(CreateSiteSettingsRequest $request)
	{
	    $request = $this->saveFiles($request);
		SiteSettings::create($request->all());
		$request->session()->flash('pageName', 'Site Settings Management');
		$request->session()->flash('status', 'Site Settings Created Successfully');
		return redirect()->route('admin.sitesettings.index');
	}

	/**
	 * Show the form for editing the specified sitesettings.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id,Request $request)
	{
		$sitesettings = SiteSettings::find($id);
	    
	    $request->session()->flash('pageName', 'Site Settings Management');
		return view('admin.sitesettings.edit', compact('sitesettings'));
	}

	/**
	 * Update the specified sitesettings in storage.
     * @param UpdateSiteSettingsRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateSiteSettingsRequest $request)
	{
		$sitesettings = SiteSettings::findOrFail($id);
		$request->session()->flash('pageName', 'Site Settings Management');
		$request->session()->flash('status', 'Site Settings Updated Successfully');
        $request = $this->saveMembershipPdf($request);

		$sitesettings->update($request->all());
		
		return redirect()->route('admin.sitesettings.index');
	}

	/**
	 * Remove the specified sitesettings from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id,Request $request)
	{
		SiteSettings::destroy($id);
		$request->session()->flash('pageName', 'Site Settings Management');
		$request->session()->flash('status', 'Site Settings Deleted Successfully');
		return redirect()->route('admin.sitesettings.index');
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
            SiteSettings::destroy($toDelete);
        } else {
            SiteSettings::whereNotNull('id')->delete();
        }
        $request->session()->flash('pageName', 'Site Settings Management');
        $request->session()->flash('status', 'Site Settings Deleted Successfully');
        return redirect()->route('admin.sitesettings.index');
    }

}

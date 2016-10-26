<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\AboutUs;
use App\Http\Requests\CreateAboutUsRequest;
use App\Http\Requests\UpdateAboutUsRequest;
use Illuminate\Http\Request;



class AboutUsController extends Controller {

	/**
	 * Display a listing of aboutus
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $aboutus = AboutUs::find(1);
        $request->session()->flash('pageName', 'AboutUs Management');
		return view('admin.aboutus.edit', compact('aboutus'));
        //$aboutus = AboutUs::all();

		//return view('admin.aboutus.index', compact('aboutus'));
	}

	/**
	 * Show the form for creating a new aboutus
	 *
     * @return \Illuminate\View\View
	 */
	public function create(Request $request)
	{
	    
	    $request->session()->flash('pageName', 'AboutUs Management');
	    return view('admin.aboutus.create');
	}

	/**
	 * Store a newly created aboutus in storage.
	 *
     * @param CreateAboutUsRequest|Request $request
	 */
	public function store(CreateAboutUsRequest $request)
	{
	    
		AboutUs::create($request->all());
		$request->session()->flash('pageName', 'AboutUs Management');
		$request->session()->flash('status', 'About Us Created Successfully');
		return redirect()->route('admin.aboutus.index');
	}

	/**
	 * Show the form for editing the specified aboutus.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id,Request $request)
	{
		$aboutus = AboutUs::find($id);
	    
	    $request->session()->flash('pageName', 'AboutUs Management');
		return view('admin.aboutus.edit', compact('aboutus'));
	}

	/**
	 * Update the specified aboutus in storage.
     * @param UpdateAboutUsRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateAboutUsRequest $request)
	{
		$aboutus = AboutUs::findOrFail($id);

        

		$aboutus->update($request->all());
		$request->session()->flash('pageName', 'AboutUs Management');
		$request->session()->flash('status', 'About Us Updated Successfully');
		return redirect()->route('admin.aboutus.index');
	}

	/**
	 * Remove the specified aboutus from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id,Request $request)
	{
		AboutUs::destroy($id);
		$request->session()->flash('pageName', 'AboutUs Management');
		$request->session()->flash('status', 'About Us Deleted Successfully');
		return redirect()->route('admin.aboutus.index');
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
            AboutUs::destroy($toDelete);
        } else {
            AboutUs::whereNotNull('id')->delete();
        }
        $request->session()->flash('pageName', 'AboutUs Management');
        $request->session()->flash('status', 'About Us Deleted Successfully');
        return redirect()->route('admin.aboutus.index');
    }

}

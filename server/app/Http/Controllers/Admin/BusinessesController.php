<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Businesses;
use App\Http\Requests\CreateBusinessesRequest;
use App\Http\Requests\UpdateBusinessesRequest;
use Illuminate\Http\Request;



class BusinessesController extends Controller {

	/**
	 * Display a listing of businesses
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $businesses = Businesses::all();
        $request->session()->flash('pageName', 'Business Management');

		return view('admin.businesses.index', compact('businesses'));
	}

	/**
	 * Show the form for creating a new businesses
	 *
     * @return \Illuminate\View\View
	 */
	public function create(Request $request)
	{
	    
	    $request->session()->flash('pageName', 'Business Management');
	    return view('admin.businesses.create');
	}

	/**
	 * Store a newly created businesses in storage.
	 *
     * @param CreateBusinessesRequest|Request $request
	 */
	public function store(CreateBusinessesRequest $request)
	{
	    
		Businesses::create($request->all());
		$request->session()->flash('pageName', 'Business Management');
		$request->session()->flash('status', 'Business Created Successfully');
		return redirect()->route('admin.businesses.index');
	}

	/**
	 * Show the form for editing the specified businesses.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id,Request $request)
	{
		$businesses = Businesses::find($id);
	    
	    $request->session()->flash('pageName', 'Business Management');
		return view('admin.businesses.edit', compact('businesses'));
	}

	/**
	 * Update the specified businesses in storage.
     * @param UpdateBusinessesRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateBusinessesRequest $request)
	{
		$businesses = Businesses::findOrFail($id);

        

		$businesses->update($request->all());
		$request->session()->flash('pageName', 'Business Management');
		$request->session()->flash('status', 'Business Updated Successfully');
		return redirect()->route('admin.businesses.index');
	}

	/**
	 * Remove the specified businesses from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id,Request $request)
	{
		$businesses = Businesses::find($id);
		$businesses->forceDelete();
		$request->session()->flash('pageName', 'Business Management');
		$request->session()->flash('status', 'Business Deleted Successfully');
		return redirect()->route('admin.businesses.index');
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
            	$businesses = Businesses::find($delete);
				$businesses->forceDelete();
            }
        } else {
            Businesses::whereNotNull('id')->delete();
        }
        $request->session()->flash('pageName', 'Business Management');
        $request->session()->flash('status', 'Business Deleted Successfully');
        return redirect()->route('admin.businesses.index');
    }

}

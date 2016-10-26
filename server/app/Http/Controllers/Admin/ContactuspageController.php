<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Contactuspage;
use App\Http\Requests\CreateContactuspageRequest;
use App\Http\Requests\UpdateContactuspageRequest;
use Illuminate\Http\Request;



class ContactuspageController extends Controller {

	/**
	 * Display a listing of contactuspage
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
   	{
  //       	$contactuspage = Contactuspage::find(1);
	    
	    
		// return view('admin.contactuspage.edit', compact('contactuspage'));

		$contactuspage = Contactuspage::all();
		$request->session()->flash('pageName', 'Service Management');
		return view('admin.contactuspage.index', compact('contactuspage'));
	}

	/**
	 * Show the form for creating a new contactuspage
	 *
     * @return \Illuminate\View\View
	 */
	public function create(Request $request)
	{
	    $request->session()->flash('pageName', 'Service Management');
	    return view('admin.contactuspage.create');
	}

	/**
	 * Store a newly created contactuspage in storage.
	 *
     * @param CreateContactuspageRequest|Request $request
	 */
	public function store(CreateContactuspageRequest $request)
	{
	    //$request = $this->saveFilesService($request);

		Contactuspage::create($request->all());
		$request->session()->flash('pageName', 'Service Management');
		 $request->session()->flash('status', 'Service Created Successfully');
		return redirect()->route('admin.contactuspage.index');
	}

	/**
	 * Show the form for editing the specified contactuspage.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id,Request $request)
	{
		$contactuspage = Contactuspage::find($id);
	    
	    $request->session()->flash('pageName', 'Service Management');
		return view('admin.contactuspage.edit', compact('contactuspage'));
	}

	/**
	 * Update the specified contactuspage in storage.
     * @param UpdateContactuspageRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateContactuspageRequest $request)
	{
		$contactuspage = Contactuspage::findOrFail($id);

        

		$contactuspage->update($request->all());
		$request->session()->flash('pageName', 'Service Management');
		 $request->session()->flash('status', 'Service Updated Successfully');
		return redirect()->route('admin.contactuspage.index');
	}

	/**
	 * Remove the specified contactuspage from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id,Request $request)
	{
		Contactuspage::destroy($id);
		$request->session()->flash('pageName', 'Service Management');
		 $request->session()->flash('status', 'Service Deleted Successfully');
		return redirect()->route('admin.contactuspage.index');
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
            Contactuspage::destroy($toDelete);
        } else {
            Contactuspage::whereNotNull('id')->delete();
        }
        $request->session()->flash('pageName', 'Service Management');
        $request->session()->flash('status', 'Service Deleted Successfully');
        return redirect()->route('admin.contactuspage.index');
    }

}

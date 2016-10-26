<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\FaqManagement;
use App\Http\Requests\CreateFaqManagementRequest;
use App\Http\Requests\UpdateFaqManagementRequest;
use Illuminate\Http\Request;



class FaqManagementController extends Controller {

	/**
	 * Display a listing of faqmanagement
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $faqmanagement = FaqManagement::all();
        $request->session()->flash('pageName', 'Faq Management');
		return view('admin.faqmanagement.index', compact('faqmanagement'));
	}

	/**
	 * Show the form for creating a new faqmanagement
	 *
     * @return \Illuminate\View\View
	 */
	public function create(Request $request)
	{
	    
	    $request->session()->flash('pageName', 'Faq Management');
	    return view('admin.faqmanagement.create');
	}

	/**
	 * Store a newly created faqmanagement in storage.
	 *
     * @param CreateFaqManagementRequest|Request $request
	 */
	public function store(CreateFaqManagementRequest $request)
	{
	    
		FaqManagement::create($request->all());
		$request->session()->flash('pageName', 'Faq Management');
		 $request->session()->flash('status', 'Faq Created Successfully');
		return redirect()->route('admin.faqmanagement.index');
	}

	/**
	 * Show the form for editing the specified faqmanagement.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id,Request $request)
	{
		$faqmanagement = FaqManagement::find($id);
	    
	    $request->session()->flash('pageName', 'Faq Management');
		return view('admin.faqmanagement.edit', compact('faqmanagement'));
	}

	/**
	 * Update the specified faqmanagement in storage.
     * @param UpdateFaqManagementRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateFaqManagementRequest $request)
	{
		$faqmanagement = FaqManagement::findOrFail($id);

        

		$faqmanagement->update($request->all());
		$request->session()->flash('pageName', 'Faq Management');
		$request->session()->flash('status', 'Faq Updated Successfully');
		return redirect()->route('admin.faqmanagement.index');
	}

	/**
	 * Remove the specified faqmanagement from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id,Request $request)
	{
		FaqManagement::destroy($id);
		$request->session()->flash('pageName', 'Faq Management');
		$request->session()->flash('status', 'Faq Deleted Successfully');
		return redirect()->route('admin.faqmanagement.index');
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
            FaqManagement::destroy($toDelete);
        } else {
            FaqManagement::whereNotNull('id')->delete();
        }
        $request->session()->flash('pageName', 'Faq Management');
        $request->session()->flash('status', 'Faq Deleted Successfully');
        return redirect()->route('admin.faqmanagement.index');
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Customers;
use App\Http\Requests\CreateCustomersRequest;
use App\Http\Requests\UpdateCustomersRequest;
use Illuminate\Http\Request;

use App\Businesses;
use App\Memberships;


class CustomersController extends Controller {

	/**
	 * Display a listing of customers
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $customers = Customers::with("businesses")->with("memberships")->get();
        $request->session()->flash('pageName', 'Customer Management');
		return view('admin.customers.index', compact('customers'));
	}

	/**
	 * Show the form for creating a new customers
	 *
     * @return \Illuminate\View\View
	 */
	public function create(Request $request)
	{
	    $businesses = Businesses::lists("name", "id")->prepend('Please select', '');
	    $memberships  = Memberships::lists("type_name", "id")->prepend('Please select', '');
	    
        $status = Customers::$status;
        $membership_type = Customers::$membership_type;
        $request->session()->flash('pageName', 'Customer Management');
	    return view('admin.customers.create', compact("businesses", "status", "memberships"));
	}

	/**
	 * Store a newly created customers in storage.
	 *
     * @param CreateCustomersRequest|Request $request
	 */
	public function store(CreateCustomersRequest $request)
	{
	    
		$input = $request->all();
		$legalname = $input['first_name'].' '.$input['last_name'];
		$input['legalName'] = trim($legalname);
		Customers::create($input);
		$request->session()->flash('pageName', 'Customer Management');
		$request->session()->flash('status', 'Customer Created Successfully');
		return redirect()->route('admin.customers.index');
	}

	/**
	 * Show the form for editing the specified customers.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id,Request $request)
	{
		$customers = Customers::find($id);
	    $businesses = Businesses::lists("name", "id")->prepend('Please select', '');
	    $memberships  = Memberships::lists("type_name", "id")->prepend('Please select', '');

	    
        $status = Customers::$status;
        $membership_type = Customers::$membership_type;
        $request->session()->flash('pageName', 'Customer Management');
		return view('admin.customers.edit', compact('customers', "businesses", "status", "memberships"));
	}

	/**
	 * Update the specified customers in storage.
     * @param UpdateCustomersRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateCustomersRequest $request)
	{
		$customers = Customers::findOrFail($id);

        $input = $request->all();
		$legalname = $input['first_name'].' '.$input['last_name'];
		$input['legalName'] = trim($legalname);

		$customers->update($input);
		$request->session()->flash('pageName', 'Customer Management');
		$request->session()->flash('status', 'Customer Updated Successfully');
		return redirect()->route('admin.customers.index');
	}

	/**
	 * Remove the specified customers from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id,Request $request)
	{
		Customers::destroy($id);
		$request->session()->flash('pageName', 'Customer Management');
		$request->session()->flash('status', 'Customer Deleted Successfully');
		return redirect()->route('admin.customers.index');
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
            Customers::destroy($toDelete);
        } else {
            Customers::whereNotNull('id')->delete();
        }
        $request->session()->flash('pageName', 'Customer Management');
        $request->session()->flash('status', 'Customer Deleted Successfully');
        return redirect()->route('admin.customers.index');
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\PaymentTypes;
use App\Http\Requests\CreatePaymentTypesRequest;
use App\Http\Requests\UpdatePaymentTypesRequest;
use Illuminate\Http\Request;



class PaymentTypesController extends Controller {

	/**
	 * Display a listing of paymenttypes
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $paymenttypes = PaymentTypes::all();

		return view('admin.paymenttypes.index', compact('paymenttypes'));
	}

	/**
	 * Show the form for creating a new paymenttypes
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.paymenttypes.create');
	}

	/**
	 * Store a newly created paymenttypes in storage.
	 *
     * @param CreatePaymentTypesRequest|Request $request
	 */
	public function store(CreatePaymentTypesRequest $request)
	{
	    
		PaymentTypes::create($request->all());

		return redirect()->route('admin.paymenttypes.index');
	}

	/**
	 * Show the form for editing the specified paymenttypes.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$paymenttypes = PaymentTypes::find($id);
	    
	    
		return view('admin.paymenttypes.edit', compact('paymenttypes'));
	}

	/**
	 * Update the specified paymenttypes in storage.
     * @param UpdatePaymentTypesRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdatePaymentTypesRequest $request)
	{
		$paymenttypes = PaymentTypes::findOrFail($id);

        

		$paymenttypes->update($request->all());

		return redirect()->route('admin.paymenttypes.index');
	}

	/**
	 * Remove the specified paymenttypes from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		PaymentTypes::destroy($id);

		return redirect()->route('admin.paymenttypes.index');
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
            PaymentTypes::destroy($toDelete);
        } else {
            PaymentTypes::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.paymenttypes.index');
    }

}

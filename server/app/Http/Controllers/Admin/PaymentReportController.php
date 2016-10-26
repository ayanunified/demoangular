<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\PaymentReport;
use App\Http\Requests\CreatePaymentReportRequest;
use App\Http\Requests\UpdatePaymentReportRequest;
use Illuminate\Http\Request;

use App\Customers;


class PaymentReportController extends Controller {

	/**
	 * Display a listing of paymentreport
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $paymentreport = PaymentReport::with(array("customers","memberships"))->get();
        $request->session()->flash('pageName', 'Payments Management');

		return view('admin.paymentreport.index', compact('paymentreport'));
	}

	/**
	 * Show the form for creating a new paymentreport
	 *
     * @return \Illuminate\View\View
	 */
	public function create(Request $request)
	{
	    $customers = Customers::lists("legalName", "id")->prepend('Please select', '');

	    $request->session()->flash('pageName', 'Payments Management');
	    return view('admin.paymentreport.create', compact("customers"));
	}

	/**
	 * Store a newly created paymentreport in storage.
	 *
     * @param CreatePaymentReportRequest|Request $request
	 */
	public function store(CreatePaymentReportRequest $request)
	{
	    
		PaymentReport::create($request->all());
		$request->session()->flash('pageName', 'Payments Management');
		$request->session()->flash('status', 'Payment Created Successfully');
		return redirect()->route('admin.paymentreport.index');
	}

	/**
	 * Show the form for editing the specified paymentreport.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id,Request $request)
	{
		$paymentreport = PaymentReport::find($id);
	    $customers = Customers::lists("legalName", "id")->prepend('Please select', '');

	    $request->session()->flash('pageName', 'Payments Management');
		return view('admin.paymentreport.edit', compact('paymentreport', "customers"));
	}

	/**
	 * Update the specified paymentreport in storage.
     * @param UpdatePaymentReportRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdatePaymentReportRequest $request)
	{
		$paymentreport = PaymentReport::findOrFail($id);

        

		$paymentreport->update($request->all());
		$request->session()->flash('pageName', 'Payments Management');
		$request->session()->flash('status', 'Payment Updated Successfully');
		return redirect()->route('admin.paymentreport.index');
	}

	/**
	 * Remove the specified paymentreport from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id,Request $request)
	{
		PaymentReport::destroy($id);
		$request->session()->flash('pageName', 'Payments Management');
		$request->session()->flash('status', 'Payment Deleted Successfully');
		return redirect()->route('admin.paymentreport.index');
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
            PaymentReport::destroy($toDelete);
        } else {
            PaymentReport::whereNotNull('id')->delete();
        }
        $request->session()->flash('pageName', 'Payments Management');
        $request->session()->flash('status', 'Payment Deleted Successfully');
        return redirect()->route('admin.paymentreport.index');
    }

}

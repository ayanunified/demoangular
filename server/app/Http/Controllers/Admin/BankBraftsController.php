<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\BankBrafts;
use App\Http\Requests\CreateBankBraftsRequest;
use App\Http\Requests\UpdateBankBraftsRequest;
use Illuminate\Http\Request;

use App\Customers;


class BankBraftsController extends Controller {

	/**
	 * Display a listing of bankbrafts
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $bankbrafts = BankBrafts::with("customers")->get();

		return view('admin.bankbrafts.index', compact('bankbrafts'));
	}

	/**
	 * Show the form for creating a new bankbrafts
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    $customers = Customers::lists("legalName", "id")->prepend('Please select', '');

	    
	    return view('admin.bankbrafts.create', compact("customers"));
	}

	/**
	 * Store a newly created bankbrafts in storage.
	 *
     * @param CreateBankBraftsRequest|Request $request
	 */
	public function store(CreateBankBraftsRequest $request)
	{
	    
		BankBrafts::create($request->all());

		return redirect()->route('admin.bankbrafts.index');
	}

	/**
	 * Show the form for editing the specified bankbrafts.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$bankbrafts = BankBrafts::find($id);
	    $customers = Customers::lists("legalName", "id")->prepend('Please select', '');

	    
		return view('admin.bankbrafts.edit', compact('bankbrafts', "customers"));
	}

	/**
	 * Update the specified bankbrafts in storage.
     * @param UpdateBankBraftsRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateBankBraftsRequest $request)
	{
		$bankbrafts = BankBrafts::findOrFail($id);

        

		$bankbrafts->update($request->all());

		return redirect()->route('admin.bankbrafts.index');
	}

	/**
	 * Remove the specified bankbrafts from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		BankBrafts::destroy($id);

		return redirect()->route('admin.bankbrafts.index');
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
            BankBrafts::destroy($toDelete);
        } else {
            BankBrafts::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.bankbrafts.index');
    }

}

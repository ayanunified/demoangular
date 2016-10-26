<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\CreditCardTypes;
use App\Http\Requests\CreateCreditCardTypesRequest;
use App\Http\Requests\UpdateCreditCardTypesRequest;
use Illuminate\Http\Request;



class CreditCardTypesController extends Controller {

	/**
	 * Display a listing of creditcardtypes
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $creditcardtypes = CreditCardTypes::all();

		return view('admin.creditcardtypes.index', compact('creditcardtypes'));
	}

	/**
	 * Show the form for creating a new creditcardtypes
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.creditcardtypes.create');
	}

	/**
	 * Store a newly created creditcardtypes in storage.
	 *
     * @param CreateCreditCardTypesRequest|Request $request
	 */
	public function store(CreateCreditCardTypesRequest $request)
	{
	    
		CreditCardTypes::create($request->all());

		return redirect()->route('admin.creditcardtypes.index');
	}

	/**
	 * Show the form for editing the specified creditcardtypes.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$creditcardtypes = CreditCardTypes::find($id);
	    
	    
		return view('admin.creditcardtypes.edit', compact('creditcardtypes'));
	}

	/**
	 * Update the specified creditcardtypes in storage.
     * @param UpdateCreditCardTypesRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateCreditCardTypesRequest $request)
	{
		$creditcardtypes = CreditCardTypes::findOrFail($id);

        

		$creditcardtypes->update($request->all());

		return redirect()->route('admin.creditcardtypes.index');
	}

	/**
	 * Remove the specified creditcardtypes from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		CreditCardTypes::destroy($id);

		return redirect()->route('admin.creditcardtypes.index');
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
            CreditCardTypes::destroy($toDelete);
        } else {
            CreditCardTypes::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.creditcardtypes.index');
    }

}

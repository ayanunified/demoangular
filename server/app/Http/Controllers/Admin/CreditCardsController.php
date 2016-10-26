<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\CreditCards;
use App\Http\Requests\CreateCreditCardsRequest;
use App\Http\Requests\UpdateCreditCardsRequest;
use Illuminate\Http\Request;

use App\CreditCardTypes;
use App\Customers;


class CreditCardsController extends Controller {

	/**
	 * Display a listing of creditcards
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $creditcards = CreditCards::with("creditcardtypes")->with("customers")->get();

		return view('admin.creditcards.index', compact('creditcards'));
	}

	/**
	 * Show the form for creating a new creditcards
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    $creditcardtypes = CreditCardTypes::lists("type_name", "id")->prepend('Please select', '');
$customers = Customers::lists("legalName", "id")->prepend('Please select', '');

	    
	    return view('admin.creditcards.create', compact("creditcardtypes", "customers"));
	}

	/**
	 * Store a newly created creditcards in storage.
	 *
     * @param CreateCreditCardsRequest|Request $request
	 */
	public function store(CreateCreditCardsRequest $request)
	{
	    
		CreditCards::create($request->all());

		return redirect()->route('admin.creditcards.index');
	}

	/**
	 * Show the form for editing the specified creditcards.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$creditcards = CreditCards::find($id);
	    $creditcardtypes = CreditCardTypes::lists("type_name", "id")->prepend('Please select', '');
$customers = Customers::lists("legalName", "id")->prepend('Please select', '');

	    
		return view('admin.creditcards.edit', compact('creditcards', "creditcardtypes", "customers"));
	}

	/**
	 * Update the specified creditcards in storage.
     * @param UpdateCreditCardsRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateCreditCardsRequest $request)
	{
		$creditcards = CreditCards::findOrFail($id);

        

		$creditcards->update($request->all());

		return redirect()->route('admin.creditcards.index');
	}

	/**
	 * Remove the specified creditcards from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		CreditCards::destroy($id);

		return redirect()->route('admin.creditcards.index');
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
            CreditCards::destroy($toDelete);
        } else {
            CreditCards::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.creditcards.index');
    }

}

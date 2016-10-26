<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Patients;
use App\Http\Requests\CreatePatientsRequest;
use App\Http\Requests\UpdatePatientsRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;

use App\Customers;


class PatientsController extends Controller {

	/**
	 * Display a listing of patients
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $patients = Patients::with("customers")->get();

		return view('admin.patients.index', compact('patients'));
	}

	/**
	 * Show the form for creating a new patients
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    $customers = Customers::lists("legalName", "id")->prepend('Please select', '');

	    
        $gender = Patients::$gender;

	    return view('admin.patients.create', compact("customers", "gender"));
	}

	/**
	 * Store a newly created patients in storage.
	 *
     * @param CreatePatientsRequest|Request $request
	 */
	public function store(CreatePatientsRequest $request)
	{
	    $request = $this->savePatientImage($request);
		Patients::create($request->all());

		return redirect()->route('admin.patients.index');
	}

	/**
	 * Show the form for editing the specified patients.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$patients = Patients::find($id);
	    $customers = Customers::lists("legalName", "id")->prepend('Please select', '');

	    
        $gender = Patients::$gender;

		return view('admin.patients.edit', compact('patients', "customers", "gender"));
	}

	/**
	 * Update the specified patients in storage.
     * @param UpdatePatientsRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdatePatientsRequest $request)
	{
		$patients = Patients::findOrFail($id);
		$request = $this->savePatientImage($request);

		$patients->update($request->all());

		return redirect()->route('admin.patients.index');
	}

	/**
	 * Remove the specified patients from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Patients::destroy($id);

		return redirect()->route('admin.patients.index');
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
            Patients::destroy($toDelete);
        } else {
            Patients::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.patients.index');
    }

}

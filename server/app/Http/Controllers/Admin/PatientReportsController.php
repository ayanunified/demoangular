<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use DB;
use App\PatientReports;
use App\Http\Requests\CreatePatientReportsRequest;
use App\Http\Requests\UpdatePatientReportsRequest;
use Illuminate\Http\Request;

use App\Patients;
use App\Customers;
use App\BehaviorLists;
use App\ReportBehaviour;


class PatientReportsController extends Controller {

	/**
	 * Display a listing of patientreports
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $patientreports = PatientReports::with("patients")->with("customers")->with('behaviorreported')->get();
        $behaviorlists = BehaviorLists::lists("type_name", "id");
         $request->session()->flash('pageName', 'Report Management');
		return view('admin.patientreports.index', compact('patientreports','behaviorlists'));
	}

	public function view($id,Request $request)
	{
		$patientreports = PatientReports::find($id);
		$behaviors = PatientReports::find($id)->behaviorreported;
		$patients = PatientReports::find($id)->patients;
		$customers = PatientReports::find($id)->customers;
		$behaviorlists = BehaviorLists::lists("type_name", "id");
		$request->session()->flash('pageName', 'Report Management');
		return view('admin.patientreports.view',compact('patientreports','patients','customers','behaviors','behaviorlists'));
	}

	/**
	 * Show the form for creating a new patientreports
	 *
     * @return \Illuminate\View\View
	 */
	public function create(Request $request)
	{
	    $patients = Patients::select(DB::raw("CONCAT(ssn,'-' ,first_name ,' ', last_name) AS full_name, id")
    )->lists("full_name", "id")->prepend('Please select', '');
		$customers = Customers::lists("legalName", "id")->prepend('Please select', '');
		$behaviorlists = BehaviorLists::lists("type_name", "id")->prepend('Please select', '');
		$gender = Patients::$gender;
        $report_reason = PatientReports::$report_reason;
        $request->session()->flash('pageName', 'Report Management');
	    return view('admin.patientreports.create', compact("patients","gender", "customers", "behaviorlists", "report_reason"));
	}

	/**
	 * Store a newly created patientreports in storage.
	 *
     * @param CreatePatientReportsRequest|Request $request
	 */
	public function store(CreatePatientReportsRequest $request)
	{
	    
		$input = $request->all();
		$behaviours = isset($input['behaviorlists_id'])?$input['behaviorlists_id']:array();
		$input['behaviorlists_id'] = ""; 
		$input['created_at'] = date('Y-m-d H:i:s');
    	$insertArray['first_name'] = $input['first_name'];
    	$insertArray['last_name'] = $input['last_name'];
    	$insertArray['dob'] = $input['dob'];
    	$insertArray['gender'] = $input['gender'];
    	$insertArray['ssn'] = $input['ssn'];
    	$patient = Patients::where('first_name',trim($input['first_name']))->where('last_name',trim($input['last_name']))->where('ssn',trim($input['ssn']))->get()->toArray();
    	if(count($patient)==0)
    	{
    		$insertArray['customers_id'] = $input['customers_id'];
    		$insertArray['created_at'] = date('Y-m-d H:i:s');
    		$patient_id = Patients::insertGetId($insertArray);
    	}
    	else if(count($patient)==1)
    	{
    		$patient_id = $patient[0]['id'];
    		$patientDetails = Patients::findOrFail($patient_id);
    		$patientDetails->update($insertArray);
    	}
    	$input['patients_id'] = $patient_id;
    	$rawreportArray = PatientReports::create($input);
		$reportArray= $rawreportArray->toArray();
		foreach($behaviours as $behaviourList)
    	{
    		if($behaviourList!="")
    		{
	    		$behaviourData['report_id'] =$reportArray['id'];
	    		$behaviourData['behaviorlists_id'] = $behaviourList;
	    		ReportBehaviour::insertGetId($behaviourData);
	    	}	
    	}

    	$request->session()->flash('pageName', 'Report Management');
    	$request->session()->flash('status', 'Report Created Successfully');
		return redirect()->route('admin.patientreports.index');
	}

	/**
	 * Show the form for editing the specified patientreports.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id,Request $request)
	{
		$patientreports = PatientReports::find($id);
		$patients = PatientReports::find($id)->patients;
		$behaviors = PatientReports::find($id)->behaviorreported;
		$behaviourShown = PatientReports::find($id)->behaviorreported->lists('behaviorlists_id')->toArray();
		$customers = Customers::lists("legalName", "id")->prepend('Please select', '');
		$behaviorlists = BehaviorLists::lists("type_name", "id")->prepend('Please select', '');
		$gender = Patients::$gender;
        $report_reason = PatientReports::$report_reason;
        $request->session()->flash('pageName', 'Report Management');
		return view('admin.patientreports.edit', compact('patientreports','gender','behaviourShown', 'behaviors',"patients", "customers", "behaviorlists", "report_reason"));
	}

	/**
	 * Update the specified patientreports in storage.
     * @param UpdatePatientReportsRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdatePatientReportsRequest $request)
	{
		$patientreports = PatientReports::findOrFail($id);

        $input = $request->all();
        $insertArray['first_name'] = $input['first_name'];
    	$insertArray['last_name'] = $input['last_name'];
    	$insertArray['dob'] = $input['dob'];
    	$insertArray['gender'] = $input['gender'];
    	$insertArray['ssn'] = $input['ssn'];
    	$patient = Patients::where('first_name',trim($input['first_name']))->where('last_name',trim($input['last_name']))->where('ssn',trim($input['ssn']))->get()->toArray();
    	if(count($patient)==0)
    	{
    		$insertArray['customers_id'] = $input['customers_id'];
    		$insertArray['created_at'] = date('Y-m-d H:i:s');
    		$patient_id = Patients::insertGetId($insertArray);
    	}
    	else if(count($patient)==1)
    	{
    		$patient_id = $patient[0]['id'];
    		$patientDetails = Patients::findOrFail($patient_id);
    		$patientDetails->update($insertArray);
    	}
    	$input['patients_id'] = $patient_id;
		$behaviours = isset($input['behaviorlists_id'])?$input['behaviorlists_id']:array();

		$input['behaviorlists_id'] = ""; 
		$reportbehaviors = ReportBehaviour::where('report_id',$id)->get()->toArray();
    	foreach($reportbehaviors as $reportbehavior)
    	{
    		$deleteBehavior = ReportBehaviour::find($reportbehavior['id']);
    		$deleteBehavior->delete();
    	}
		foreach($behaviours as $behaviourList)
    	{
    		$behaviourData['report_id'] =$id;
    		$behaviourData['behaviorlists_id'] = $behaviourList;
    		ReportBehaviour::insertGetId($behaviourData);
    	}

		$patientreports->update($input);
		$request->session()->flash('pageName', 'Report Management');
		$request->session()->flash('status', 'Report Updated Successfully');
		return redirect()->route('admin.patientreports.index');
	}

	/**
	 * Remove the specified patientreports from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id,Request $request)
	{
		PatientReports::destroy($id);
		$request->session()->flash('pageName', 'Report Management');
		$request->session()->flash('status', 'Report Deleted Successfully');
		return redirect()->route('admin.patientreports.index');
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
            PatientReports::destroy($toDelete);
        } else {
            PatientReports::whereNotNull('id')->delete();
        }
        $request->session()->flash('pageName', 'Report Management');
         $request->session()->flash('status', 'Report Deleted Successfully');
        return redirect()->route('admin.patientreports.index');
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\PatientsLooks;
use App\Http\Requests\CreatePatientsLooksRequest;
use App\Http\Requests\UpdatePatientsLooksRequest;
use Illuminate\Http\Request;
use Validator;
use App\Customers;
use App\ReportBehaviour;
use App\PatientReports;


class PatientsLooksController extends Controller {

	/**
	 * Display a listing of patientslooks
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        
        $customers = Customers::lists("legalName", "id")->prepend('Please select', '');
        $request->session()->flash('pageName', 'Patients Looks Management');
		return view('admin.patientslooks.index', compact('customers'));
	}
	public function showlist(Request $request)
	{
		$rules = array(
                'customer_search_id'=>'required',
        );
        $input=$request->all();
        //print_r($input);die;
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
          // send back to the page with the input data and errors
          $request->session()->flash('pageName', 'Patients Looks Management');
          return Redirect::back()->withInput()->withErrors($validator);
        }else {
			$reqarray = $request->all();
			$customer_search_id= isset($reqarray['customer_search_id'])?$reqarray['customer_search_id']:0;
			$from_date = isset($reqarray['from_date'])?$reqarray['from_date']:'0000-00-00';
			$to_date = isset($reqarray['to_date'])?$reqarray['to_date']:'0000-00-00';
			$patientslooks = PatientsLooks::where(array('customers_id'=>$customer_search_id))->whereBetween('created_at',array($from_date.' 00:00:00',$to_date.' 23:59:59'))->orderBy('id','desc')->with("customers")->get();
			$customers = Customers::lists("legalName", "id")->prepend('Please select', '');
			$request->session()->flash('pageName', 'Patients Looks Management');
			return view('admin.patientslooks.list',compact('patientslooks','customers','reqarray'));
		}	
	}
	public function view($id,Request $request)
	{
		$reports = PatientReports::whereIn('id',explode(',',$id))->with('patients')->with('customers')->get()->toArray();
		$totalAmount = 0;
		$behaviorReport = 0;
		$reportedBy = array();
		$finalsendData = array();
		foreach($reports as $key=>$patientReport)
		{
			$behaviorShown ='';
			$totalAmount = $totalAmount + $patientReport['balance_amount'];
			
			if(!in_array($patientReport['customers_id'],$reportedBy))
			{
				array_push($reportedBy,$patientReport['customers_id']);
			}
			$senddata['id'] = $patientReport['id'];
			$senddata['name'] = $patientReport['patients']['first_name'].' '.$patientReport['patients']['last_name'];
			$senddata['ssn'] = $patientReport['patients']['ssn'];
			$senddata['balance_amount'] = $patientReport['balance_amount'];
			$senddata['report_reason'] = $patientReport['report_reason'];
			$senddata['service_date'] = $patientReport['service_date'];
			$behaviors = ReportBehaviour::where('report_id',$patientReport['id'])->with('behaviorlists')->get()->toArray();
			if(count($behaviors)>0)
			{
				++$behaviorReport;
			}
			foreach($behaviors as $newkey=>$behavior)
			{
				$behaviorShown .= ','.$behavior['behaviorlists']['type_name'];
			}

			$senddata['behavior'] = ltrim($behaviorShown,',');
			array_push($finalsendData,$senddata);
		}
		$data['totalDue'] = $totalAmount;
		$data['totalBehaviorReport'] = $behaviorReport;
		$data['reportCount'] = count($reportedBy);
		$data['data'] = $finalsendData;
		$request->session()->flash('pageName', 'Patients Looks Management');
		return view('admin.patientslooks.view',compact('data'));
	}
	/**
	 * Show the form for creating a new patientslooks
	 *
     * @return \Illuminate\View\View
	 */
	public function create(Request $request)
	{
	    $customers = Customers::lists("legalName", "id")->prepend('Please select', '');

	    $request->session()->flash('pageName', 'Patients Looks Management');
	    return view('admin.patientslooks.create', compact("customers"));
	}

	/**
	 * Store a newly created patientslooks in storage.
	 *
     * @param CreatePatientsLooksRequest|Request $request
	 */
	public function store(CreatePatientsLooksRequest $request)
	{
	    
		PatientsLooks::create($request->all());
		$request->session()->flash('pageName', 'Patients Looks Management');
		return redirect()->route('admin.patientslooks.index');
	}

	/**
	 * Show the form for editing the specified patientslooks.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id,Request $request)
	{
		$patientslooks = PatientsLooks::find($id);
	    $customers = Customers::lists("legalName", "id")->prepend('Please select', '');

	    $request->session()->flash('pageName', 'Patients Looks Management');
		return view('admin.patientslooks.edit', compact('patientslooks', "customers"));
	}

	/**
	 * Update the specified patientslooks in storage.
     * @param UpdatePatientsLooksRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdatePatientsLooksRequest $request)
	{
		$patientslooks = PatientsLooks::findOrFail($id);

        

		$patientslooks->update($request->all());
		$request->session()->flash('pageName', 'Patients Looks Management');
		return redirect()->route('admin.patientslooks.index');
	}

	/**
	 * Remove the specified patientslooks from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id,Request $request)
	{
		PatientsLooks::destroy($id);
		$request->session()->flash('pageName', 'Patients Looks Management');
		$request->session()->flash('status', 'Report Deleted Successfully');
		return redirect()->route('admin.patientslooks.index');
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
            PatientsLooks::destroy($toDelete);
        } else {
            PatientsLooks::whereNotNull('id')->delete();
        }
        $request->session()->flash('pageName', 'Patients Looks Management');
        $request->session()->flash('status', 'Report Deleted Successfully');
        return redirect()->route('admin.patientslooks.index');
    }

}

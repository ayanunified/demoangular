<?php
namespace Laraveldaily\Quickadmin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customers;
use App\PatientReports;

class QuickadminController extends Controller
{
    /**
     * Show QuickAdmin dashboard page
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $customers = Customers::where('status','Active')->get()->toArray();
		$patients = PatientReports::get()->toArray();
		$customersCount = count($customers);
		$patientsCount = count($patients);
        $request->session()->flash('pageName', 'Dashboard Management');
        return view('admin.dashboard',compact('customersCount','patientsCount'));
    }
}
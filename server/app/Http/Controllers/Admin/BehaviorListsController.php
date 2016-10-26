<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\BehaviorLists;
use App\Http\Requests\CreateBehaviorListsRequest;
use App\Http\Requests\UpdateBehaviorListsRequest;
use Illuminate\Http\Request;



class BehaviorListsController extends Controller {

	/**
	 * Display a listing of behaviorlists
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $behaviorlists = BehaviorLists::all();
        $request->session()->flash('pageName', 'Behaviour Management');
		return view('admin.behaviorlists.index', compact('behaviorlists'));
	}

	/**
	 * Show the form for creating a new behaviorlists
	 *
     * @return \Illuminate\View\View
	 */
	public function create(Request $request)
	{
	    
	    $request->session()->flash('pageName', 'Behaviour Management');
	    return view('admin.behaviorlists.create');
	}

	/**
	 * Store a newly created behaviorlists in storage.
	 *
     * @param CreateBehaviorListsRequest|Request $request
	 */
	public function store(CreateBehaviorListsRequest $request)
	{
	    
		BehaviorLists::create($request->all());
		$request->session()->flash('pageName', 'Behaviour Management');
		$request->session()->flash('status', 'Behaviour Created Successfully');
		return redirect()->route('admin.behaviorlists.index');
	}

	/**
	 * Show the form for editing the specified behaviorlists.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id,Request $request)
	{
		$behaviorlists = BehaviorLists::find($id);
	    
	    $request->session()->flash('pageName', 'Behaviour Management');
		return view('admin.behaviorlists.edit', compact('behaviorlists'));
	}

	/**
	 * Update the specified behaviorlists in storage.
     * @param UpdateBehaviorListsRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateBehaviorListsRequest $request)
	{
		$behaviorlists = BehaviorLists::findOrFail($id);

        

		$behaviorlists->update($request->all());
		$request->session()->flash('pageName', 'Behaviour Management');
		$request->session()->flash('status', 'Behaviour Updated Successfully');
		return redirect()->route('admin.behaviorlists.index');
	}

	/**
	 * Remove the specified behaviorlists from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id,Request $request)
	{
		$behaviour = BehaviorLists::find($id);
		$behaviour->forceDelete();
		$request->session()->flash('pageName', 'Behaviour Management');
		$request->session()->flash('status', 'Behaviour Deleted Successfully');
		return redirect()->route('admin.behaviorlists.index');
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
            foreach($toDelete as $delete)
            {
            	$behaviour = BehaviorLists::find($delete);
				$behaviour->forceDelete();
            }
        } else {
            BehaviorLists::whereNotNull('id')->delete();
        }
        $request->session()->flash('pageName', 'Behaviour Management');
        $request->session()->flash('status', 'Behaviour Deleted Successfully');
        return redirect()->route('admin.behaviorlists.index');
    }

}

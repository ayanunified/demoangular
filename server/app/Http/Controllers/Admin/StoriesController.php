<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Stories;
use App\Http\Requests\CreateStoriesRequest;
use App\Http\Requests\UpdateStoriesRequest;
use Illuminate\Http\Request;



class StoriesController extends Controller {

	/**
	 * Display a listing of stories
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        //$stories = Stories::all();

		//return view('admin.stories.index', compact('stories'));
		$stories = Stories::find(1);
	    
	    $request->session()->flash('pageName', 'Stories Management');
		return view('admin.stories.edit', compact('stories'));
	}

	/**
	 * Show the form for creating a new stories
	 *
     * @return \Illuminate\View\View
	 */
	public function create(Request $request)
	{
	    
	    $request->session()->flash('pageName', 'Stories Management');
	    return view('admin.stories.create');
	}

	/**
	 * Store a newly created stories in storage.
	 *
     * @param CreateStoriesRequest|Request $request
	 */
	public function store(CreateStoriesRequest $request)
	{
	    
		Stories::create($request->all());
		$request->session()->flash('pageName', 'Stories Management');
		$request->session()->flash('status', 'Stories Created Successfully');
		return redirect()->route('admin.stories.index');
	}

	/**
	 * Show the form for editing the specified stories.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id,Request $request)
	{
		$stories = Stories::find($id);
	    
	    $request->session()->flash('pageName', 'Stories Management');
		return view('admin.stories.edit', compact('stories'));
	}

	/**
	 * Update the specified stories in storage.
     * @param UpdateStoriesRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateStoriesRequest $request)
	{
		$stories = Stories::findOrFail($id);

        

		$stories->update($request->all());
		$request->session()->flash('pageName', 'Stories Management');
	    
		$request->session()->flash('status', 'Stories Updated Successfully');
		return redirect()->route('admin.stories.index');
	}

	/**
	 * Remove the specified stories from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id,Request $request)
	{
		Stories::destroy($id);
		$request->session()->flash('pageName', 'Stories Management');
		$request->session()->flash('status', 'Stories Deleted Successfully');
		return redirect()->route('admin.stories.index');
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
            Stories::destroy($toDelete);
        } else {
            Stories::whereNotNull('id')->delete();
        }
        $request->session()->flash('pageName', 'Stories Management');
        $request->session()->flash('status', 'Stories Deleted Successfully');
        return redirect()->route('admin.stories.index');
    }

}

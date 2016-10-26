<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\SliderImages;
use App\Http\Requests\CreateSliderImagesRequest;
use App\Http\Requests\UpdateSliderImagesRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;


class SliderImagesController extends Controller {

	/**
	 * Display a listing of sliderimages
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $sliderimages = SliderImages::all();
        $request->session()->flash('pageName', 'Slider Management');
		return view('admin.sliderimages.index', compact('sliderimages'));
	}

	/**
	 * Show the form for creating a new sliderimages
	 *
     * @return \Illuminate\View\View
	 */
	public function create(Request $request)
	{
	    
	    $request->session()->flash('pageName', 'Slider Management');
	    return view('admin.sliderimages.create');
	}

	/**
	 * Store a newly created sliderimages in storage.
	 *
     * @param CreateSliderImagesRequest|Request $request
	 */
	public function store(CreateSliderImagesRequest $request)
	{
	    $request->session()->flash('pageName', 'Slider Management');
		 $request->session()->flash('status', 'Slider Image Created Successfully');
	    $request = $this->saveFiles($request);
		SliderImages::create($request->all());
		
		return redirect()->route('admin.sliderimages.index');
	}

	/**
	 * Show the form for editing the specified sliderimages.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id,Request $request)
	{
		$sliderimages = SliderImages::find($id);
	    
	    $request->session()->flash('pageName', 'Slider Management');
		return view('admin.sliderimages.edit', compact('sliderimages'));
	}

	/**
	 * Update the specified sliderimages in storage.
     * @param UpdateSliderImagesRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateSliderImagesRequest $request)
	{
		$request->session()->flash('pageName', 'Slider Management');
		$request->session()->flash('status', 'Slider Image Updated Successfully');
		$sliderimages = SliderImages::findOrFail($id);

        $request = $this->saveFiles($request);

		$sliderimages->update($request->all());
		
		return redirect()->route('admin.sliderimages.index');
	}

	/**
	 * Remove the specified sliderimages from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id,Request $request)
	{
		SliderImages::destroy($id);
		$request->session()->flash('pageName', 'Slider Management');
		$request->session()->flash('status', 'Slider Image Deleted Successfully');
		return redirect()->route('admin.sliderimages.index');
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
            SliderImages::destroy($toDelete);
        } else {
            SliderImages::whereNotNull('id')->delete();
        }
        $request->session()->flash('pageName', 'Slider Management');
        $request->session()->flash('status', 'Slider Image Deleted Successfully');
        return redirect()->route('admin.sliderimages.index');
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Testimonials;
use App\Http\Requests\CreateTestimonialsRequest;
use App\Http\Requests\UpdateTestimonialsRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;


class TestimonialsController extends Controller {

	/**
	 * Display a listing of testimonials
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $testimonials = Testimonials::all();
        $request->session()->flash('pageName', 'Testimonial Management');

		return view('admin.testimonials.index', compact('testimonials'));
	}

	/**
	 * Show the form for creating a new testimonials
	 *
     * @return \Illuminate\View\View
	 */
	public function create(Request $request)
	{
	    
	    $request->session()->flash('pageName', 'Testimonial Management');
	    return view('admin.testimonials.create');
	}

	/**
	 * Store a newly created testimonials in storage.
	 *
     * @param CreateTestimonialsRequest|Request $request
	 */
	public function store(CreateTestimonialsRequest $request)
	{
	    $request->session()->flash('pageName', 'Testimonial Management');
		$request->session()->flash('status', 'Testimonial Created Successfully');
	    $request = $this->saveFiles($request);
		Testimonials::create($request->all());
		
		return redirect()->route('admin.testimonials.index');
	}

	/**
	 * Show the form for editing the specified testimonials.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id,Request $request)
	{
		$testimonials = Testimonials::find($id);
	    
	     $request->session()->flash('pageName', 'Testimonial Management');
		return view('admin.testimonials.edit', compact('testimonials'));
	}

	/**
	 * Update the specified testimonials in storage.
     * @param UpdateTestimonialsRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateTestimonialsRequest $request)
	{
		$testimonials = Testimonials::findOrFail($id);
		$request->session()->flash('pageName', 'Testimonial Management');
		$request->session()->flash('status', 'Testimonial Updated Successfully');
        $request = $this->saveFiles($request);

		$testimonials->update($request->all());
		
		return redirect()->route('admin.testimonials.index');
	}

	/**
	 * Remove the specified testimonials from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id,Request $request)
	{
		Testimonials::destroy($id);
		$request->session()->flash('pageName', 'Testimonial Management');
		$request->session()->flash('status', 'Testimonial Deleted Successfully');
		return redirect()->route('admin.testimonials.index');
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
            Testimonials::destroy($toDelete);
        } else {
            Testimonials::whereNotNull('id')->delete();
        }
        $request->session()->flash('pageName', 'Testimonial Management');
        $request->session()->flash('status', 'Testimonial Deleted Successfully');
        return redirect()->route('admin.testimonials.index');
    }

}

<?php
namespace App\Http\Controllers;
class HomeController extends Controller
{
    /**
     * Show QuickAdmin dashboard page
     *
     * @return Response
     */
    public function index()
    {
        return redirect('admin');
    }
}
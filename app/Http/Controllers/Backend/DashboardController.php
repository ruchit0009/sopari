<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
   /**
    * 
    * @param MainRepository $main
    */
     public function __construct( ) {
 
    }
    
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.dashboard');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashboardController extends Controller
{
      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['web', 'CheckSessionExpiration']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		$title = 'Dashboard page';
        return view('dashboard')->with('title', $title);
    }
    
    public function help()
    {
		$title = 'Help page';
        return view('help')->with('title', $title);
    }
	
}

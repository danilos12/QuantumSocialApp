<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommandmoduleController extends Controller
{
       /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		$title = 'Command Module';
        return view('commandmodule')->with('title', $title);
    }
}

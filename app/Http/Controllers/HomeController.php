<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('unauthorized');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		$title = 'Home page';
		return view('home')->with('title', $title);
    }
    public function upgrademodal()
    {
        $html = view('modals.upgrade')->render();
        return response()->json(['stat' => 'upgrade?', 'html' => $html]);
    }
}

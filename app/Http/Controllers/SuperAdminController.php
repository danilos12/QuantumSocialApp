<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;
use Illuminate\View\Factory as ViewFactory;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;




class SuperAdminController extends Controller
{
    private $view;

    public function __construct(ViewFactory $view)
    {
        $this->view = $view;
    }
   /**
     * Create a new controller instance.
     *
     * @return void
     */   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
		$title = 'Super Admin';        
        return view('super-admin')->with('title', $title);

    }
	
	public function getAllUsers()
    {
		try {
            $getAll = User::find(Auth::id())->get();
            dd($getAll);
        } catch(Exception $e) {
            return response()->json(200, ['error' => $e]);
        }
    }	

}

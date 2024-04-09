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
        
        
        $title = 'Super Admin Data';    
        return view('super-admin')->with(['title' => $title]);
    }
	
    public function getAllOwners()
    {
		
        $title = 'Account Owners';      
        
        
        $getAll = DB::table('users')
        ->join('users_meta', 'users.id', '=', 'users_meta.user_id')
        ->join('plans', 'users_meta.subscription_id', '=', 'plans.subscription_id')
        ->get();        

        
        return view('su-admin.owners')->with(['title' => $title, 'getAll' => $getAll]);
    }
	
	public function getAllAdmins()
    {
        $title = 'Admins';      
        
        $getAll = DB::table('users')
        ->join('users_meta', 'users.id', '=', 'users_meta.user_id')
        ->join('plans', 'users_meta.subscription_id', '=', 'plans.subscription_id')
        ->get();        

        
        return view('su-admin.admin')->with(['title' => $title, 'getAll' => $getAll]);
    }	

	public function getAllMembers()
    {
        $title = 'Members';      
        
        $getAll = DB::table('members')
        // ->join('users_meta', 'users.id', '=', 'users_meta.user_id')
        // ->join('plans', 'users_meta.subscription_id', '=', 'plans.subscription_id')
        ->get();        

        return view('su-admin.members', ['title' => $title, 'getAll' => $getAll]);
        
        // return view('super-admin')->with(['title' => $title, 'getAll' => $getAll]);
    }	
	
    public function getAllPlans()
    {
        $title = 'Plans';      
        
        $getAll = DB::table('plans')
        // ->join('users_meta', 'users.id', '=', 'users_meta.user_id')
        // ->join('plans', 'users_meta.subscription_id', '=', 'plans.subscription_id')
        ->get();        

        
        return view('su-admin.plans')->with(['title' => $title, 'getAll' => $getAll]);
    }	

}

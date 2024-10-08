<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;
use Illuminate\View\Factory as ViewFactory;


class ProfileController extends Controller
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
		$title = 'Profile page';        
        return view('profile')->with('title', $title);

    }
	
	public function edit_password()
    {
		$title = 'Edit Password';
        return view('change-password')->with('title', $title);
    }
	
	public function updatePassword(Request $request)
{
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
	}

}

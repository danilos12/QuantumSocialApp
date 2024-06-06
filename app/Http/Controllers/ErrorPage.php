<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ErrorPage extends Controller
{
    public function errorPages(){
        $title = 'Error';
        return view('error.error')->with('title',$title);
    }
}

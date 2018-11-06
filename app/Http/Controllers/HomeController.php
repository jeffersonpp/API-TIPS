<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

	/**
	|--------------------------------------------------
	|  Logout from session
	|--------------------------------------------------	
	| METHOD: GET
	*/
	public function logout()
    {
		Auth::logout();
		$answer=array('message'=>"Tip stored sucessfully!");
        return json_encode($answer);
    }
	
	/**
	|--------------------------------------------------
	|  Get the Token from session
	|--------------------------------------------------	
	| METHOD: GET
	*/
	public function token()
    {
		$answer =array('_token'=> csrf_token());
        return json_encode($answer);
    }
	 

}

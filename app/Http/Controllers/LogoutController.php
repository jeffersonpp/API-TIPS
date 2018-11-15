<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Logout extends Controller
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

}

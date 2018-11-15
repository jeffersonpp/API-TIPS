<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Token extends Controller
{

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

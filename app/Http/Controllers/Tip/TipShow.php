<?php

namespace App\Http\Controllers\Tip;

use App\Http\Controllers\TipController;
use Illuminate\Http\Request;
use Sujip\Guid\Guid;
use App\Tip;

class TipShow extends TipController
{

	
	/*
	|--------------------------------------------------
	| Show - JSON format
	|--------------------------------------------------	
	|
	| It can be accessed without login
	|
	|METHOD: GET
	*/
    public function show($id)
    {
        $tip = Tip::find($id);
        return json_encode($tip);
    }
}

?>
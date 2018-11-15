<?php

namespace App\Http\Controllers\Tip;

use App\Http\Controllers\TipController;
use Illuminate\Http\Request;
use Sujip\Guid\Guid;
use App\Tip;

class TipStore extends TipController
{
	/**
	|--------------------------------------------------
	| Store the new Tip 
	|--------------------------------------------------	
	| METHOD: POST
	*/
    public function store(Request $request)
    {
        $tip = new Tip;
		$guid = new GUID;
		$tip->guid = $guid->create();
        $tip->title = $request->get('title');
        $tip->description = $request->get('description');
        $tip->save();
		$answer=array('message'=>"Tip stored sucessfully!");
        return json_encode($answer);
    }
}

?>
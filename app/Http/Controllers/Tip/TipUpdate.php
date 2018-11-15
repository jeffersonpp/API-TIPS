<?php

namespace App\Http\Controllers\Tip;

use App\Http\Controllers\TipController;
use Illuminate\Http\Request;
use Sujip\Guid\Guid;
use App\Tip;

class TipUpdate extends TipController
{
	/*
	|--------------------------------------------------
	| Store the edited Tip 
	|--------------------------------------------------	
	| METHOD: POST
	*/	
    public function update(Request $request, $id)
    {
        $tip= Tip::find($id);
        $tip->title = $request->get('tiptitle');
        $tip->description = $request->get('tipdescription');
        $tip->save();
		$answer=array('message'=>"Tip Updated sucessfully!");
        return json_encode($answer);
	}
}

?>
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
		if($tip ==null){
			 return json_encode(array('message'=>'Value not found!'));
		}
        $tip->title = $request->get('title');
        $tip->description = $request->get('description');
        $tip->save();
		$answer=array('message'=>"Tip Updated sucessfully!");
        return json_encode($answer);
	}
}

?>
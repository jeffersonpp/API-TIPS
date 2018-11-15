<?php

namespace App\Http\Controllers\Tip;

use App\Http\Controllers\TipController;
use Illuminate\Http\Request;
use Sujip\Guid\Guid;
use App\Tip;

class TipDelete extends TipController
{

	/*
	|--------------------------------------------------
	| SoftDelete a Tip
	|--------------------------------------------------	
	| METHOD: DELETE
	*/
    public function destroy($id)
    {
		try{
        $tip = Tip::find($id);
		if($tip ==null){
			 return json_encode(array('message'=>'Value not found!'));
		}
        $tip->delete();	
		$answer=array('message'=>"Tip deletet sucessfully!");
        return json_encode($answer);
		}
		catch(Exception $e) {
		$answer = array('status' => 'error','message' => $e->getMessage());
		return json_encode($answer); 
		}
	}
}

?>
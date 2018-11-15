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
        $tip = Tip::find($id);
        $tip->delete();	
		$answer=array('message'=>"Tip deletet sucessfully!");
        return json_encode($answer);
    }
}

?>
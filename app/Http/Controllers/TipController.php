<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sujip\Guid\Guid;
use App\Tip;

class TipController extends Controller
{
	
    public function __construct()
    {
        $this->middleware('auth');// Require authentication for all functions
    }
	
	/**
	|--------------------------------------------------
	| List all Tips - JSON format 
	|--------------------------------------------------	
	|
	| It can be accessed without login
	|
	| METHOD: GET
	*/
    public function index()
    {
        $tips=Tip::all();
		return json_encode($tips);
    }
}
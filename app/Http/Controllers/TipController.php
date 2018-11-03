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
	
	/**
	|--------------------------------------------------
	| Create a Tip - It has a view 
	|--------------------------------------------------	
	| METHOD: GET
	*/
    public function create()
	{
        return view('tipcreate');
    }
	
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

        return redirect('api/tip');
    }
	
	/**
	|--------------------------------------------------
	| Edit a Tip - It has a view 
	|--------------------------------------------------	
	| METHOD: GET
	*/

    public function edit($id)
    {
        $tip = Tip::find($id);
 
		return view('tipedit',compact('tip','id'));
    }
	
	/**
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

        return redirect('api/tip');
	}
	
	/**
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

	/**
	|--------------------------------------------------
	| SoftDelete a Tip
	|--------------------------------------------------	
	| METHOD: DELETE
	*/
    public function destroy($id)
    {
        $tip = Tip::find($id);
        $tip->delete();
		
        return redirect('api/tip');
    }

}
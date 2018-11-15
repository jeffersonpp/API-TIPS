<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
Route::group(array('prefix' => 'api', 'middleware' => ['auth']), function()
{
 
Route::get('/', function () {
    return response()->json(['message' => 'Tips API', 'status' => 'Connected']);;
});

//Route::resource('tip','TipController');
Route::get('tip','TipController@index');
Route::post('tip/store','Tip\TipStore@store');
Route::post('tip/update','Tip\TipUpdate@update');
Route::get('tip/show/{id}','Tip\TipShow@show');
Route::get('tip/delete/{id}','Tip\TipDelete@destroy');

    /*
    |--------------------------------------------------------------------------
    | Routes Configuration
    |--------------------------------------------------------------------------
    |
    | The routes are now defined by the Tip Controller
    | as described below:
	|
    | GET 		api/tip = 		INDEX
    | GET 		api/tip/create= CREATE
	| POST		api/tip/ = 		STORE
	| GET 		api/tip/{ID} = 	SHOW
	| POST		api/tip/{ID} = 	UPDATE
	| DELETE 	api/tip/{ID} = 	DELETE
	| GET		api/tip/logout= LOGOUT
	|
    */

});

Route::get('/', function () {
    return redirect('api');
});
//Auth::routes(['except'=>'token']);
Auth::routes(['except'=>['login','logout','register']]);

Route::get('api/token', 'HomeController@token');
Route::get('logout', 'HomeController@logout');
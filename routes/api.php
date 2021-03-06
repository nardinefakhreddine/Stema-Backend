<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::post('/login','AdminController@login');
Route::post('/user/login','UserController@login');
Route::group(['prefix' => 'admin','middleware' => ['assign.guard:admins','jwt.auth']],function ()
{
	Route::get('/getAll','AdminController@getAll');	
});



Route::group(['prefix' => 'user','middleware' => ['assign.guard:api','jwt.auth']],function ()
{
	Route::get('/getAll','UserController@getAll');	
});
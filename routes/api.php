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
Route::prefix('admin')->group(function () {
    Route::post('login','AdminController@login');
    Route::post('logout', 'AdminController@logout');
   
});
Route::prefix('user')->group(function () {
    Route::post('login','UserController@login');
    Route::post('logout', 'UserController@logout');
   
});


Route::group(['prefix' => 'admin','middleware' => ['assign.guard:admins','jwt.auth']],function ()
{       Route::get('getAll','AdminController@getAll');	
        Route::get('getById/{id}','AdminController@getById');
        Route::post('create','AdminController@create');
        Route::get('edit/{id}','AdminController@edit');
        Route::put('update/{id}','AdminController@update');
        Route::delete('delete/{id}','AdminController@delete');
});



Route::group(['prefix' => 'user','middleware' => ['assign.guard:api','jwt.auth']],function ()
{
	Route::get('/getAll','UserController@getAll');	
});
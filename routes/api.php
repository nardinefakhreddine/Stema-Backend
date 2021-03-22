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
   
});
Route::prefix('user')->group(function () {
    Route::post('login','UserController@login');
   
});


Route::group(['prefix' => 'admin','middleware' => ['assign.guard:admins']],function ()
{       Route::get('getAll','AdminController@getAll');	
        Route::get('getById/{id}','AdminController@getById');
        Route::post('create','AdminController@create');
        Route::get('edit/{id}','AdminController@edit');
        Route::put('update/{id}','AdminController@update');
        Route::delete('delete/{id}','AdminController@delete');
        Route::get('logout', 'AdminController@logout');
});



Route::group(['prefix' => 'user','middleware' => ['assign.guard:jwtusers']],function ()
{
        
       
        Route::post('create','UserController@create');
        Route::get('edit/{id}','UserController@edit');
        Route::put('update/{id}','UserController@update');
        Route::delete('delete/{id}','UserController@delete');	
        Route::post('logout', 'UserController@logout');
        Route::get('logout', 'AdminController@logout');
});



/*Products Routes */
Route::group(['prefix' => 'product','middleware' => ['assign.guard:admins']],function ()
{      	
        Route::get('getById/{id}','ProductController@getById');
      
        /* start search */
        // Route::get('getByBarecode/{barecode}','ProductController@getByBarecode');
        Route::get('searchByName/{name}','ProductController@searchByName');

        /*end search */

        /**start crud */
        // Route::post('create','ProductController@create');
       
        // Route::put('update/{id}','ProductController@update');
         Route::delete('delete/{id}','ProductController@delete');
      /**end crud */
});


Route::get('display/{id}','ProductController@display');
Route::get('/getAll','UserController@getAll');
Route::get('getById/{id}','UserController@getById');
Route::get('/getByBarecode/{barecode}','ProductController@getByBarecode');

Route::get('/displayByBareCode/{barecode}','ProductController@displayByBareCode'); 
Route::get('product/getAll','ProductController@getAll');
Route::get('product/getScores','ProductController@getScores');  
Route::post('product/create','ProductController@Insert');
Route::post('create','NutriController@create'); 
Route::get('/product/edit/{id}','ProductController@edit');
Route::put('/product/update/{id}','ProductController@update');
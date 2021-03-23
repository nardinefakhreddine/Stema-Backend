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
        // Route::get('logout', 'AdminController@logout');
});



/*Products Routes */
Route::group(['prefix' => 'product','middleware' => ['assign.guard:admins']],function ()
{      	
        Route::get('getById/{id}','ProductController@getById');
        Route::get('getAll','ProductController@getAll');
        Route::get('getScores','ProductController@getScores'); 

        /* start search */
        Route::get('searchByName/{name}','ProductController@searchByName');
        /*end search */

        /**start crud */
        Route::post('create','ProductController@Insert');
        Route::get('edit/{id}','ProductController@edit');
        Route::put('update/{id}','ProductController@update');
         Route::delete('delete/{id}','ProductController@delete');
      /**end crud */
});

//Nutri Routes
Route::get('nutri/getAll','NutriController@getAll');
Route::get('nutri/searchByName/{name}','NutriController@searchByName');


Route::post('nutri/create','NutriController@create');
Route::delete('nutri/delete/{id}','NutriController@delete');
Route::get('nutri/edit/{id}','NutriController@edit');
Route::put('nutri/update/{id}','NutriController@update');

//end Nutri Routes

//Allergy Routes
Route::get('allergy/getAll','AllergyController@getAll');
Route::get('allergy/searchByName/{name}','AllergyController@searchByName');
Route::delete('allergy/delete/{id}','AllergyController@delete');

Route::post('allergy/create','AllergyController@create');
Route::delete('allergy/delete/{id}','AllergyController@delete');
Route::get('allergy/edit/{id}','AllergyController@edit');
Route::put('allergy/update/{id}','AllergyController@update');


//Additive Routes
Route::get('additive/getAll','AdditiveController@getAll');
Route::get('additive/searchByName/{name}','AdditiveController@searchByName');


Route::post('additive/create','AdditiveController@create');
Route::delete('additive/delete/{id}','AdditiveController@delete');
Route::get('additive/edit/{id}','AdditiveController@edit');
Route::put('additive/update/{id}','AdditiveController@update');




/**Product user  */
Route::get('display/{id}','ProductController@display');
Route::get('getAll','ProductController@getAll');
Route::get('/getByBarecode/{barecode}','ProductController@getByBarecode');

Route::get('/displayByBareCode/{barecode}','ProductController@displayByBareCode'); 

 

Route::post('create','NutriController@create'); 

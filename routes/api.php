<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});

Route::group(['prefix'=>'v1' , 'namespace'=>'Api'],function (){
    Route::get('/governorates','MainController@governorates');
    Route::get('/cities','MainController@cities');
    Route::post('/register','AuthController@register');
    Route::post('/login','AuthController@login');

    Route::post('/forgetpass','AuthController@forgetpass');
    Route::post('/newpass','AuthController@newpass');


  Route::group(['middleware'=>'auth:api'],function (){
      Route::get('/posts','MainController@posts');
      Route::get('/setting','MainController@setting');
      Route::post('/profile','AuthController@profile');
      Route::post('/register-token','AuthController@registerToken');
      Route::post('/remove-token','AuthController@removeToken');
      Route::post('/donation-request','MainController@donationRequest');
      Route::post('/favourite','MainController@postFavourite');
      Route::post('/myfavourite','MainController@myFavourite');
      Route::post('/contacts','MainController@contacts');
  });
});


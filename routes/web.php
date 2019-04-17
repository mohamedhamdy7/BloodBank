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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['middleware'=>'auth'], function(){
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('governorate','governorate');

    Route::Post('governorate/{gid}/update','governorate@update');

    Route::get('governorate/{gid}/delete','governorate@destroy');

    Route::get('/trashed','governorate@trashed');

    Route::get('governorate/{gid}/restore','governorate@restore');

    Route::get('governorate/{gid}/deleteforce','governorate@deleteforce');

    Route::resource('city','citycontroller');

    Route::resource('category','CategoryController');

    Route::resource('post','PostController');

    Route::resource('setting','SettingController');

    Route::resource('client','ClientController');

    Route::resource('donation','DonationController');

    Route::resource('contact','ContactController');

    Route::get('user/change','user@ChangeIndex');

    Route::post('user/change','user@changePasswordSave');





});






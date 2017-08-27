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








Route::get('/setup', 'HomeController@setup')->name('setup');
Route::post('/setup', 'HomeController@install')->name('process_setup');
Route::post('install/license', 'HomeController@LicenseInstallation');

Route::group(['middleware' => ['installed']], function(){
	Auth::routes();
});

Route::group(['middleware' => ['company', 'auth']], function () {
    Route::get('/license', 'HomeController@license')->name('license');
    Route::post('officer', "OfficerController@store")->name('store_officer');
	Route::post('/renew_license', 'HomeController@renewLicense')->name('renewLicense');
    Route::get('', 'HomeController@index')->name('home')->middleware('company');
	Route::get('/officers', 'HomeController@officer')->name('officer')->middleware('company');

});


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


Auth::routes();

Route::get('', 'HomeController@index')->name('home');
Route::get('/license', 'HomeController@license')->name('license');
Route::post('/renew_license', 'HomeController@renewLicense')->name('renewLicense');
Route::get('/indipay/response', 'HomeController@paymentResponse')->name('payment_response');
Route::get('/officers', 'HomeController@officer')->name('officer');

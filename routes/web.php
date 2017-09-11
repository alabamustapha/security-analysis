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



Route::group(["middleware" => ["setup"]], function(){
	Route::get('/setup', 'HomeController@setup')->name('setup');
	Route::post('/setup', 'HomeController@install')->name('process_setup');
	Route::post('install/license', 'HomeController@LicenseInstallation');
});

Route::group(['middleware' => ['installed']], function(){
	Auth::routes();
});

Route::group(['middleware' => ['company', 'auth']], function () {

	Route::post('questions', 'QuestionController@store')->name('add_question');

	Route::get('categories', 'CategoryController@index')->name('categories');
	Route::post('categories', 'CategoryController@store')->name('add_categories');
	Route::put('/categories/{category}', "CategoryController@update")->name('update_category');
	Route::get('/categories/{category}/edit', "CategoryController@edit")->name('edit_category');
	Route::delete('/categories/{category}/delete', "CategoryController@delete")->name('delete_category');
	Route::get('categories/create', 'CategoryController@create')->name('create_categories');
	Route::get('buildings', 'BuildingController@index')->name('buildings');
	Route::get('buildings/create', 'BuildingController@create')->name('create_buildings');
	Route::post('buildings', 'BuildingController@store')->name('store_buildings');
	Route::get('buildings/{building}/edit', "BuildingController@edit")->name('edit_building');
	Route::delete('buildings/{building}', "BuildingController@delete")->name('delete_building');
	Route::put('buildings/{building}', "BuildingController@update")->name('update_building');

	Route::get('buildings/{building}', 'BuildingController@manage')->name('manage_building');
	Route::get('buildings/{building}/{category}/questions', 'BuildingController@manageCategoryQuestions')->name('manage_building_category_questions');
	Route::get('buildings/{building}/{category}/preview', 'BuildingController@previewCategoryQuestions')->name('preview_building_category_questions');


    Route::get('/license', 'HomeController@license')->name('license');
    
    Route::get('/officers/create', "OfficerController@create")->name('create_officer');
    Route::delete('/officers/{id}/delete', "OfficerController@delete")->name('delete_officer');
    Route::get('/officers/{id}/edit', "OfficerController@edit")->name('edit_officer');
    Route::put('/officers/{id}', "OfficerController@update")->name('update_officer');
    Route::post('/officer', "OfficerController@store")->name('store_officer');
	
	Route::post('/renew_license', 'HomeController@renewLicense')->name('renewLicense');
    Route::get('', 'HomeController@index')->name('home')->middleware('company');
	Route::get('/officers', 'HomeController@officer')->name('officer')->middleware('company');

	Route::get('reports', 'ReportController@index')->name('reports');
	Route::get('buildings/{building}/report', 'BuildingController@report')->name('manage_building_report');
	Route::get('buildings/{building}/report_preview', 'BuildingController@previewReport')->name('preview_building_report');
	Route::post('buildings/{building}/report', 'ReportController@store')->name('create_building_report');
});


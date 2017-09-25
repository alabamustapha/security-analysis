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
	Route::put('/categories/{id}', "CategoryController@update")->name('update_category');
	Route::get('/categories/{id}/edit', "CategoryController@edit")->name('edit_category');
	Route::delete('/categories/{id}/delete', "CategoryController@delete")->name('delete_category');
	Route::get('categories/create', 'CategoryController@create')->name('create_categories');
	Route::get('buildings', 'BuildingController@index')->name('buildings');
	Route::get('buildings/create', 'BuildingController@create')->name('create_buildings');
	Route::post('buildings', 'BuildingController@store')->name('store_buildings');
	Route::get('buildings/{building}/edit', "BuildingController@edit")->name('edit_building');
	Route::delete('buildings/{building}', "BuildingController@delete")->name('delete_building');
	Route::put('buildings/{building}', "BuildingController@update")->name('update_building');

	Route::get('buildings/{building}', 'BuildingController@manage')->name('manage_building');
	Route::get('buildings/{building}/categories/{category}/questions', 'BuildingController@manageCategoryQuestions')->name('manage_building_category_questions');
	Route::get('buildings/{building}/categories/{category}/preview', 'BuildingController@previewCategoryQuestions')->name('preview_building_category_questions');


    Route::get('/license', 'HomeController@license')->name('license');
    
    Route::get('/officers/create', "OfficerController@create")->name('create_officer');
    Route::delete('/officers/{user}/delete', "OfficerController@delete")->name('delete_officer');

    Route::get('/officers/{user}/buildings', "OfficerController@inspectedBuildings")->name('officer_inspected_buildings');

    Route::get('/officers/{user}/buildings/{building}/respondents', "OfficerController@inspectedBuildingRespondents")->name('officer_building_respondents');

    Route::get('/officers/{user}/buildings/{building}/respondents/{respondent}/responses', "OfficerController@inspectedBuildingRespondentResponses")->name('respondent_building_responses');

    Route::get('/officers/{user}/buildings/{building}/respondents/{respondent}/report', "OfficerController@inspectedBuildingRespondentReport")->name('respondent_building_report');

    Route::get('/buildings/{building}/respondents/{respondent}/download_report', "RespondentController@downloadBuildingReport")->name('download_respondent_building_report');

    

    Route::get('/officers/{user}/edit', "OfficerController@edit")->name('edit_officer');
    Route::put('/officers/{user}', "OfficerController@update")->name('update_officer');
    Route::post('/officer', "OfficerController@store")->name('store_officer');
	
	Route::post('/renew_license', 'HomeController@renewLicense')->name('renewLicense');
    Route::get('', 'HomeController@index')->name('home')->middleware('company');
	Route::get('/officers', 'HomeController@officer')->name('officer')->middleware('company');

	Route::get('reports', 'ReportController@index')->name('reports');
	Route::get('buildings/{building}/report', 'BuildingController@report')->name('manage_building_report');
	Route::get('buildings/{building}/report_preview', 'BuildingController@previewReport')->name('preview_building_report');
	Route::get('buildings/{building}/report_download', 'BuildingController@downloadReport')->name('download_building_report');
	Route::post('buildings/{building}/reports/{report}', 'ReportController@store')->name('create_building_report');
});


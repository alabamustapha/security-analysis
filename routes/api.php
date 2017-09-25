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

Route::middleware('auth:api')->get('/buildings', "BuildingController@apiAll");

Route::middleware('auth:api')->get('/buildings/{building}/questions', "BuildingController@apiAllQuestions");

Route::middleware('auth:api')->post('/respondents', 'RespondentController@apiCreate');
Route::middleware('auth:api')->get('/respondents/{$id}', 'RespondentController@apiShow');

Route::middleware('auth:api')->post('/responses', 'ResponseController@apiSaveReponses');

Route::middleware('auth:api')->put('/responses/{id}/images', 'ResponseController@apiUpdateResponseImages');

Route::middleware('auth:api')->post('/responses/{id}/videos', 'ResponseController@apiUpdateResponseVideos');

Route::middleware('auth:api')->post('/responses/{id}/sugestions', 'ResponseController@apiUpdateResponseSuggestion');

Route::middleware('auth:api')->get('/buildings/{id}/questions/{question_id}', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/buildings/{building}/respondents/{respondent}/download_report', "RespondentController@apiDownloadBuildingReport")->name('download_respondent_building_report');

Route::middleware('auth:api')->get('buildings/{building}/report_download', 'BuildingController@downloadReport')->name('download_building_report');

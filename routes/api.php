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

Route::middleware('auth:api')->post('/responses/{id}/images', 'ResponseController@apiUpdateResponseImages');

Route::middleware('auth:api')->post('/responses/{id}/videos', 'ResponseController@apiUpdateResponseVideos');

Route::middleware('auth:api')->post('/responses/{id}/sugestions', 'ResponseController@apiUpdateResponseSuggestion');

Route::middleware('auth:api')->get('/buildings/{building}/questions/{id}', function (Request $request) {
    return $request->user();
});

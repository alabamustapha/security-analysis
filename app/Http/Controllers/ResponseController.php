<?php

namespace App\Http\Controllers;

use App\Building;
use App\Response;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    public function apiSaveReponses(Request $request){
    		$data = [];
    		$building = Building::with('questions')->whereId($request->building_id)->firstOrFail();

    		$questions_ids = $building->questions->pluck('id');
    		foreach ($questions_ids as $id) {
    			$images = [];
    			$audios = [];
    			$videos = [];
    			$body = $request->input("body_" . $id);
    			$suggestion = $request->input("suggestion_" . $id);
    			$value = $request->input("value_" . $id);
	    		
	    		if($request->hasFile("images_" . $id)){
	    			foreach($request->file("images_" . $id) as $image) {
	    				$images = array_prepend($images, $image->storeAs('images', $image->getClientOriginalName()));
	    			}
	    		}

    			if($request->hasFile("audios_" . $id)){
    				foreach($request->file("audios_" . $id) as $audio) {
	    				$audios = array_prepend($audios, $audio->storeAs('audios', $audio->getClientOriginalName()));
	    			}
	
    			}
    			
    			if($request->hasFile("videos_" . $id)){
    				foreach($request->file("videos_" . $id) as $video) {
    				$videos = array_prepend($videos, $video->storeAs('videos', $video->getClientOriginalName()));
    				}
    			}

    			$question_id =  $id;
    			$respondent_id = $request->respondent_id;

    			if((isset($body) && !is_null($body)) || (isset($value) && !is_null($value))){

    				$response = Response::where('question_id',  $question_id)
    							->where('respondent_id', $respondent_id)->first();

    				if($response){
    					$response->update([
    					"body" 		 	=> $body,
    					"suggestions" 	=> $suggestion,
    					"value"		 	=> $value,
    					"images"     	=> array_unique(array_merge($images, $response->images ? $response->images : [])),
    					"videos"     	=> array_unique(array_merge($videos, $response->videos ? $response->videos : [])),
    					"audios"     	=> array_unique(array_merge($audios, $response->audios ? $response->audios : [])),
    					"question_id"	=> $question_id,
    					"respondent_id"	=> $respondent_id,
    					"building_id"	=> $request->building_id,
    				]);
    				}else{
    					$response = Response::create([
    					"body" 		 	=> $body,
    					"suggestions" 	=> $suggestion,
    					"value"		 	=> $value,
    					"images"     	=> $images,
    					"videos"     	=> $videos,
    					"audios"     	=> $audios,
    					"question_id"	=> $question_id,
    					"respondent_id"	=> $respondent_id,
    					"building_id"	=> $request->building_id,
    					]);
    				}

    				
    				$data[] = $response;	
    			}
    			
    		}

    		return $data;
    }

    public function apiUpdateResponseImages(Request $request){
    	return $request->all();
    	$response = Response::find($id)->first();
    	$images = [];

    	if($response){

    		if($request->hasFile("images")){
    			return "has";
				foreach($request->file("images") as $image) {
					$images = array_prepend($images, $image->storeAs('public/images', $image->getClientOriginalName()));
				}

				$response->images = 
					array_unique(array_merge($images, $response->images));

				$response->save();
			}

    	}

    	return $response;
    }
}

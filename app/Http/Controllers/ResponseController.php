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
    					"images"     	=> json_encode($images),
    					"videos"     	=> json_encode($videos),
    					"audios"     	=> json_encode($audios),
    					"question_id"	=> $question_id,
    					"respondent_id"	=> $respondent_id,
    					"building_id"	=> $request->building_id,
    				]);
    				}else{
    					$response = Response::create([
    					"body" 		 	=> $body,
    					"suggestions" 	=> $suggestion,
    					"value"		 	=> $value,
    					"images"     	=> json_encode($images),
    					"videos"     	=> json_encode($videos),
    					"audios"     	=> json_encode($audios),
    					"question_id"	=> $question_id,
    					"respondent_id"	=> $respondent_id,
    					"building_id"	=> $request->building_id,
    					]);
    				}

    				
    				$data[] = [$body, $suggestion, $value, json_encode($images), json_encode($audios), json_encode($videos), $question_id, $respondent_id];	
    			}
    			
    		}



    		return $data;

    		// foreach ($request->all() as $key => $value) {
    		// 	$images[] = $key;
    		// }
    		// return $images;
    }
}

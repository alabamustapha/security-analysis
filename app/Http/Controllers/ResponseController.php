<?php

namespace App\Http\Controllers;

use App\Building;
use App\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Zipper;

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

    public function apiUpdateResponse(Request $request, Response $response){
    	

    	if($response){

    		if($request->hasFile("images")){

                $images = [];

				foreach($request->file("images") as $image) {
					$images = array_prepend($images, $image->storeAs('public/images', $image->getClientOriginalName()));
				}

                if(is_array($response->images)){
                    $response->images = array_unique(array_merge($images, $response->images));    
                }else{
                    $response->images = array_unique($images);
                }

				$response->save();
                
			}

            if($request->hasFile("audios")){

                $audios = [];

                foreach($request->file("audios") as $audio) {
                    $audios = array_prepend($audios, $audio->storeAs('public/audios', $audio->getClientOriginalName()));
                }

                if(is_array($response->audios)){
                    $response->audios = array_unique(array_merge($audios, $response->audios));
                }else{
                    $response->audios = array_unique($audios);
                }

                $response->save();
            }

            if($request->hasFile("videos")){

                $videos = [];

                //Storage::putFileAs('photos', new File('/path/to/photo'), 'photo.jpg');

                foreach($request->file("videos") as $video) {
                    $videos = array_prepend($videos, \Storage::putFileAs('public/videos', $video, $video->getClientOriginalName()));
                }

                if(is_array($response->videos)){
                    $response->videos = array_unique(array_merge($videos, $response->videos));    
                }else{
                    $response->videos = array_unique($videos);    
                }


                

                $response->save();
            }

    	}

    	return $response;
    }

    public function downloadAudios(Response $response){

    $file_urls = [];
    
    $zip_name = public_path() . '/downloads/audios' . '.zip';
    
    
    if(file_exists($zip_name)){
        unlink($zip_name);    
    }
    

    foreach ($response->audios as  $audio) {

       $file_urls[] = storage_path('app/'.$audio);

    }

    return response()->download($file_urls[0]); //minor fix

    $zipper = Zipper::make($zip_name)->add($file_urls);

    $zipper->close();

    

    return response()->download($zip_name);

    }

    public function downloadVideos(Response $response){
        
        $file_urls = [];
        
        $zip_name = public_path() . '/downloads/videos' . '.zip';
        
        if(file_exists($zip_name)){
            unlink($zip_name);    
        }
        
        foreach ($response->videos as  $video) {
           $file_urls[] = storage_path('app/'.$video);
        }

        return response()->download($file_urls[0]); //minor fix

        $zipper = Zipper::make($zip_name)->add($file_urls);

        $zipper->close();

        return response()->download($zip_name);
    }
}

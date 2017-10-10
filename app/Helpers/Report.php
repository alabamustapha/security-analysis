<?php

use App\Question;
use App\Respondent;


function getShortCodes($report_body){
		$patern = "/\[QUEST_(.+)\]/U";
		$results = [];
        $count = preg_match_all($patern, $report_body, $results);
        return $results;
}

function getCatShortCodes($report_body, $respondent_id){
	$cat_patern = "/\[CAT_(.+)\]/U";
	$short_codes = [];
	$cat_count = preg_match_all($cat_patern, $report_body, $short_codes);

	$data = [];

	$respondent =  Respondent::with('building')->find($respondent_id);
	if($respondent){
		foreach ($short_codes[1] as  $id) {
			$code = [];
			$code['short_code'] = "[CAT_" . $id . "]";
			$code['score'] = $respondent->categoryScore(explode("_", $id)[0]);

			$data[] = $code;
		}	
	}
	return $data;
}



function shortCodesAndReplacement($report_body, $respondent_id){
	
	$short_codes = getShortCodes($report_body);
        $data = [];
        foreach ($short_codes[1] as  $id) {
        	$code = [];
            $question = Question::with('responses')->find($id);
            if($question){
            	$code['short_code'] = "[QUEST_" . $id . ']';
	            $code['question']   =  "<strong>" . $question->body . "</strong><br>";
	            $code['responses']  =  combineResponses($question->responses->where("respondent_id", $respondent_id), $question->type);
	            $data[] = $code;
            }
        }

      

     return $data;   
}

function combineResponses($responses, $question_type){
	$combined_responses = "";
	foreach ($responses as $response) {	
			
			if($question_type == "location"){
				$combined_responses .= "<img src='".get_location_image($response->body)."'>";
			}elseif($question_type == "date"){
				$combined_responses .= $response->body;
			}else{

			if($question_type == "rating"){
				$combined_responses .= "<strong>Rating: <span class='rating " . ratingClass($response->value) . "'>" . $response->value . '</span></strong><br><br>';
			}



			$combined_responses .= "<strong>Findings: </strong><br>" . $response->body . '<br><br>';
			
			$combined_responses .= "<strong>Recommendations: </strong><br>" . $response->suggestions . '<br><br>';

			foreach ($response->images as $image) {
				$combined_responses .= "<img src=" . asset('storage/'. $image) . ' width="100%"><br>';
			}
		}
		
	}

	return $combined_responses;
}

function ratingClass($value){

	$rating_class = ""; 

	if($value >= 1 && $value <= 10){

		if($value >= 8){
			$rating_class = "rating-danger";
		}elseif($value == 7){
			$rating_class = "rating-brown";
		}elseif ($value >= 5) {
			$rating_class = "rating-yellow";
		}elseif ($value == 4){
			$rating_class = "rating-blue";
		}else{
			$rating_class = "rating-green";
		}

	}

	return $rating_class;


}

function makeReport($report, $respondent_id){

	$cat_short_codes = getCatShortCodes($report, $respondent_id);

	$respondent_name = "";
	$respondent = Respondent::with('building', 'officer')->find($respondent_id);

	$short_codes_replacement = shortCodesAndReplacement($report, $respondent_id);
	foreach ($short_codes_replacement as $codes) {
		
		if($codes['responses']){
			$report = str_replace($codes['short_code'], $codes['question'] . '<br>' . $codes['responses'], $report);	
		}else{
			$report = str_replace($codes['short_code'], "", $report);	
		}
		
	}

	$report = str_replace("[BUILDING_NAME]", $respondent->name, $report);

	$report = str_replace("[SCORE]", $respondent->score(), $report);
	
		if($respondent->officer){
			$respondent_name = $respondent->officer->name;
		}

	$report = str_replace("[OFFICER_NAME]", $respondent_name, $report);

	foreach ($cat_short_codes as $code) {
		$report = str_replace($code["short_code"], $code["score"], $report);
	}
	
	
	return $report;
}

function get_location_image($lat_long){
	$url = "https://maps.googleapis.com/maps/api/staticmap?center=";
	$url .= $lat_long;
	$url .= "&zoom=16&size=640x400&path=weight:3%7Ccolor:blue%7Cenc:{coaHnetiVjM??_SkM??~R&key=";
	$url .= env("GOOGLE_MAP_API");

	return $url;
}


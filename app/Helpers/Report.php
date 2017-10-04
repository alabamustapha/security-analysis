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
			$code['score'] = $respondent->categoryValue(explode("_", $id)[0]);

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
	            $code['question']   =  $question->body;
	            $code['responses']  =  combineResponses($question->responses->where("respondent_id", $respondent_id), $question->type);
	            $data[] = $code;
            }
        }

      

     return $data;   
}

function combineResponses($responses, $question_type){
	$combined_responses = "";
	foreach ($responses as $response) {

			$combined_responses .= "Answer: " . $response->body . '<br>';	
		
			if($question_type == "rating"){
				$combined_responses .= "Value: " . $response->value . '<br>';
			}
			
			$combined_responses .= "Suggestions: " . $response->suggestions . '<br>';

			$combined_responses .= "Images: <br>";

			foreach ($response->images as $image) {
				$combined_responses .= "<img src=" . asset('storage/'.$image) . ' width="100%"><br>';
			}


		
		
	}

	return $combined_responses;
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
	
		if($respondent->officer){
			$respondent_name = $respondent->officer->name;
		}

	$report = str_replace("[OFFICER_NAME]", $respondent_name, $report);

	foreach ($cat_short_codes as $code) {
		$report = str_replace($code["short_code"], $code["score"], $report);
	}
	
	
	return $report;
}


<?php

use App\Question;
use App\Respondent;


function getShortCodes($report_body){
		$patern = "/\[QUEST_(.+)\]/U";
		$results = [];
        $count = preg_match_all($patern, $report_body, $results);
        return $results;
}

function shortCodesAndReplacement($report_body, $respondent_id){
	
	$short_codes = getShortCodes($report_body);
        $data = [];
        foreach ($short_codes[1] as  $id) {
        	$code = [];
            $question = Question::with('responses')->find($id);
            $code['short_code'] = "[QUEST_" . $id . ']';
            $code['question']   =  $question->body;
            $code['responses']  =  combineResponses($question->responses->where("respondent_id", $respondent_id));
            $data[] = $code;
        }

     return $data;   
}

function combineResponses($responses){
	$combined_responses = "";
	foreach ($responses as $response) {
		if(!is_null($response->body)){
			$combined_responses .= $response->body . '<br>';	
		}else{
			$combined_responses .= $response->value . '<br>';	
		}
		
	}

	return $combined_responses;
}

function makeReport($report, $respondent_id){

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

	$report = str_replace("[BUILDING_NAME]", $respondent->building->name, $report);
	
		if($respondent->officer){
			$respondent_name = $respondent->officer->name;
		}

		$report = str_replace("[OFFICER_NAME]", $respondent_name, $report);
	
	
	return $report;
}


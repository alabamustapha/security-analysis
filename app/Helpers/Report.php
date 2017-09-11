<?php

use App\Question;

function getShortCodes($report_body){
		$patern = "/\[QUEST_(.+)\]/U";
		$results = [];
        $count = preg_match_all($patern, $report_body, $results);
        return $results;
}

function shortCodesAndReplacement($report_body){
	
	$short_codes = getShortCodes($report_body);
        $data = [];
        foreach ($short_codes[1] as  $id) {
        	$code = [];
            $question = Question::with('responses')->find($id);
            $code['short_code'] = "[QUEST_" . $id . ']';
            $code['question']   =  $question->body;
            $code['responses']  =  combineResponses($question->responses);
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

function makeReport($report){
	$short_codes_replacement = shortCodesAndReplacement($report);
	foreach ($short_codes_replacement as $codes) {
		$report = str_replace($codes['short_code'], $codes['question'] . '<br>' . $codes['responses'], $report);
	}

	return $report;
}


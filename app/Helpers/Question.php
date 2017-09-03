<?php

function prepareQuestionOptions($options){
	return explode(PHP_EOL, $options);
}

function getQuestionOptionValue($option){
	
	if(str_contains($option, '|')){ 
		return trim(explode("|", $option)[0]);
	}

	return "";
}

function getQuestionOptionLabel($option){
	
	if(str_contains($option, '|')){ 
		return trim(explode("|", $option)[1]);
	}

	return "";
	
}
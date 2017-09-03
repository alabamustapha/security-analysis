<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Question;

class QuestionController extends Controller
{
    public function store(Requests\StoreQuestionRequest $request){
    	
    	if($request->type == "location" || $request->type == "text" || $request->type == "rating"){
    		$question = Question::create($request->all());
    	}elseif($request->type == "date") {
    		$question = Question::create([
    			'body' => $request->body,
    			'type' => $request->type,
    			'options' => $request->from_date . '|' . $request->to_date,
    			'building_id' => $request->building_id,
    			'category_id' => $request->category_id,
    		]);
    	}elseif($request->type == "checkbox" || $request->type == "radio" || $request->type == "dropdown"){
    		$options = "";
    		foreach ($request->all() as $key => $value) {
    		 	if(starts_with($key, 'value')){
    		 		$options .= $value . "|";
    		 	}elseif(starts_with($key, 'label')){
    		 		$options .= $value . "\n";
    		 	}
    		 }

    		$question = Question::create([
    			'body' => $request->body,
    			'type' => $request->type,
    			'options' => $options,
    			'building_id' => $request->building_id,
    			'category_id' => $request->category_id,
    		]);

    		
    	}
    	

    	return back()->with('message', " Question added successfully");
    }
}

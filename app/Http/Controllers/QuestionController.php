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
    			'options' => [$request->from_date, $request->to_date],
    			'building_id' => $request->building_id,
    			'category_id' => $request->category_id,
    		]);
    	}elseif($request->type == "checkbox" || $request->type == "radio" || $request->type == "dropdown"){
    		$options = "";
    		//for custom label and option
            // foreach ($request->all() as $key => $value) {
    		//  	if(starts_with($key, 'value')){
    		//  		$options .= $value . "|";
    		//  	}elseif(starts_with($key, 'label')){
    		//  		$options .= $value . "\n";
    		//  	}
    		//  }
            
            foreach ($request->all() as $key => $value) {

                if(trim($value) !== "" && starts_with($key, 'option')){
                     $options .= $value . "\n";
                }
            
             }

             $options = explode(PHP_EOL, $options);
             array_pop($options);

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

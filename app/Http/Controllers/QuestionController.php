<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Question;

class QuestionController extends Controller
{
    public function store(Requests\StoreQuestionRequest $request){
    	
    	if($request->type == "location" || $request->type == "text"){
    		$question = Question::create($request->all());
    	}
    	

    	return back()->with('message', "Question added successfully");
    }
}

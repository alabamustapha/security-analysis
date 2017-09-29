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

    public function delete(Question $question){

        $question->delete();
        return back()->withMessage("Deleted");
    }

    public function edit(Question $question){
        return view('questions.edit', compact('question'));
    }

    public function update(Request $request, Question $question){
        
        if($request->type == "location" || $request->type == "text" || $request->type == "rating"){
            $question->update($request->except(["category_id", "building_id"]));
        }elseif($request->type == "date") {
            $question->body = $request->body;
            $question->type = $request->type;
            $question->options = [$request->from_date, $request->to_date];
            $question->save();
        }elseif($request->type == "checkbox" || $request->type == "radio" || $request->type == "dropdown"){
            $options = "";
            
            foreach ($request->all() as $key => $value) {

                if(trim($value) !== "" && starts_with($key, 'option')){
                     $options .= $value . "\n";
                }
            
             }

             $options = explode(PHP_EOL, $options);
             array_pop($options);

                $question->body = $request->body;
                $question->type = $request->type;
                $question->options = $options;
                $question->save();
            
        }

        return back()->withMessage("Updated")->withQuestion($question);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respondent extends Model
{
	protected $table = "respondents";
	
    protected $fillable = ['name', 'building_id', 'user_id'];

    public function building(){
        return $this->belongsTo('App\Building');
    }

    public function officer(){
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }

    protected $hidden = ['created_at', 'updated_at', "building_id"];

    public function responses(){
    	return $this->hasMany('App\Response');
    }

    public function buildingResponses($building_id){
     return $this->responses->makeVisible("question_id")->where('building_id', $building_id);   
    }

    public function categoryScore($category_id){

        $category = Category::with('sub_categories')->find($category_id);
        
        if($category->sub_categories->count() > 0){
            
            $scores = [];
            $category_ids = $category->sub_categories()->pluck('id')->toArray();
            
            foreach ($category_ids as $category_id) {
                
                if($this->hasResponsesForCategroy($category_id)){
                    $scores[] = $this->subcategoryScore($category_id);    
                }
                
            }

            return count(($scores)) > 0 ? round(array_sum($scores) / count($scores)) : null;
                        
        }
        


        $category_questions_id = $this->building->categoryQuestions($category_id)->where('type', 'rating')->pluck('id')->toArray();

        return round($this->responses->whereIn('question_id', $category_questions_id)->avg("value"));
    }

    public function score(){

        $scores = [];

        $categories = Category::all();

        foreach ($categories as $category) {
            $scores[] = $this->categoryScore($category->id);    
        }

        return !empty($scores) ? round(array_sum($scores) / count($scores)) : null;   
    }

    public function subcategoryScore($category_id){

        $category_questions_id = $this->building->categoryQuestions($category_id)->where('type', 'rating')->pluck('id')->toArray();

        return round($this->responses->whereIn('question_id', $category_questions_id)->avg("value"));
    }

    public function hasQuestionsInCategory($category_id){
            return $this->building->categoryQuestions($category_id)->count() > 0;
    }

    public function categoryResponses($category_id){
        $category_questions_id = $this->building->questions->makeVisible("category_id")->where('category_id', $category_id)->pluck("id")->toArray();
        return $this->buildingResponses($this->building_id)->whereIn("question_id", $category_questions_id);   
    }

    public function hasResponsesForCategroy($category_id){
        
        return $this->categoryResponses($category_id)->count() > 0;
    }


}

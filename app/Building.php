<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $table = 'buildings';
    protected $fillable = ['name'];

    public $timestamps = false;

    public function questions(){

    	return $this->hasMany('App\Question');

    }

    public function categoryQuestions($category_ids){
        if(is_array($category_ids)){
                return $this->questions()->whereIn('category_id', $category_ids);    
        }
    	return $this->questions()->where('category_id', $category_ids);
    }

    public function reports(){
        return $this->hasMany('App\Report')->orderBy("page");
    }

    public function shortCodes($category_id = null){
        $question_codes = array_unique($this->questions()->pluck('id')->toArray());

        $category_codes = array_unique($this->questions()->pluck('category_id')->toArray());
        $default_codes = ["BUILDING_NAME", "OFFICER_NAME"];
        foreach ($question_codes as  $key => $code) {
            $question_codes[$key] = "QUEST_" . $code;
        }

        foreach ($category_codes as  $key => $code) {
            $category_codes[$key] = "CAT_" . $code;
        }

        foreach ($category_codes as  $key => $code) {
            $category_codes = array_prepend($category_codes, $code . "_SCORE");
            // $category_codes = array_prepend($category_codes, $code . "_AVG");
        }

        $codes = array_merge($category_codes, $question_codes, $default_codes);

        return array_sort_recursive($codes);
    }
}

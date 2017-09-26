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

    public function categoryQuestions($category_id){
    	return $this->questions()->where('category_id', $category_id);
    }

    public function reports(){
        return $this->hasMany('App\Report')->orderBy("page");
    }

    public function shortCodes($category_id = null){
        $codes = $this->questions()->pluck('id')->toArray();
        $default_codes = ["BUILDING_NAME", "OFFICER_NAME"];
        foreach ($codes as  $key => $code) {
            $codes[$key] = "QUEST_" . $code;
        }

        $codes = array_merge($codes, $default_codes);

        return $codes;
    }
}

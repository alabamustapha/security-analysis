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

    public function questionsCodes($category_id = null){
        $codes = $this->questions()->pluck('id')->toArray();
        foreach ($codes as  $key => $code) {
            $codes[$key] = "QUEST_" . $code;
        }

        return $codes;
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = ["body", "type", "min", "max", "options", "building_id", "category_id", "question_id"];

    public function responses(){
    	return $this->hasMany('App\Response');
    }
}

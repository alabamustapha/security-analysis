<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = ["body", "type", "min", "max", "options", "building_id", "category_id", "question_id"];

    protected $hidden = ['created_at', 'updated_at', "building_id", "category_id",
        "question_id"];

     protected $casts = [
        'options' => 'array',
    ];    

    public function responses(){
    	return $this->hasMany('App\Response');
    }

    public function building(){
    	return $this->belongsTo('App\Building');
    }

    public function category(){
    	return $this->belongsTo('App\Category');
    }

    public function setOptionsAttribute($value)
    {
        $this->attributes['options'] = json_encode($value);
    }
}

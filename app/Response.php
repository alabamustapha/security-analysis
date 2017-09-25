<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $table = 'responses';

    public $timestamps = false;

    protected $fillable = ["body", "suggestions", "images", "audios", "videos", "value", "building_id", "respondent_id", "question_id"];

    protected $hidden = ['created_at', 'updated_at', "building_id", 'respondent_id', 'question_id'];

    protected $casts = [
        'images' => 'array',
        'audios' => 'array',
        'videos' => 'array'
    ];

    public function question(){
    	return $this->belongsTo('App\Question');
    }    
}

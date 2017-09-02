<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $table = 'buildings';
    protected $fillable = ['name'];

    public $timestamps = false;

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function questions(){

    	return $this->hasMany('App\Question');

    }

    public function categoryQuestions($category_id){
    	return $this->questions()->where('category_id', $category_id);
    }
}

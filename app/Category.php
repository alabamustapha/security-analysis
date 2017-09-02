<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['name', 'category_id'];

    public $timestamps = false;


    public function sub_categories(){
    	return $this->hasMany('App\Category');
    }

    public function main_category(){
    	return $this->belongsTo('App\Category', 'category_id', 'id');
    }


    public function getRouteKeyName()
    {
        return 'name';
    }
}

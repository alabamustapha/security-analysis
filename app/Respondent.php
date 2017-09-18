<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respondent extends Model
{
    protected $fillable = ['name', 'building_id'];

    public function building(){
    	return $this->belongsTo('App\Building');
    }

    protected $hidden = ['created_at', 'updated_at', "building_id"];

    public function responses(){
    	return $this->hasMany('App\Response');
    }
}

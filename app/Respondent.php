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
     return $this->responses->where('building_id', $building_id);   
    }
}

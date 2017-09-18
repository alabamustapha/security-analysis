<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Respondent;
use App\Http\Requests;

class RespondentController extends Controller
{
    public function apiCreate(Requests\CreateRespondent $request){

    	$respondent = Respondent::create([
    		'name' 			=> $request->name,
    		'building_id' 	=> $request->building_id,
    	]);
    	return $respondent;
    }
}

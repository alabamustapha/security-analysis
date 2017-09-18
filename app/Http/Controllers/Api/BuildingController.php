<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Building;
use App\Category;
use App\Question;
use App\Report;
class BuildingController extends Controller
{

    public function all(){
    	$buildings = Building::all()->toArray();
    	return $buildings;
    }

}

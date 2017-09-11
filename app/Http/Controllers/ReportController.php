<?php

namespace App\Http\Controllers;

use App\Building;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(){
    	$buildings = Building::all();
    	return view('reports.index', compact('buildings'));
    }

    public function store(Building $building, Request $request){

    			$message = "";
    			
    			if($building->report){
    				$building->report->body = $request->body;
    				$building->report->save();
    				$message = "report updated";
    			}else{
	    			$report = $building->report()->create([
	    				'body' => $request->body,
	    			]);

	    			$message = "report saved";
    			}

    			return back()->with('message', $message);
    }
}

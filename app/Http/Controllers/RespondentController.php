<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Respondent;
use App\Http\Requests;
use App\Building;
use PDF;


class RespondentController extends Controller
{

    public function downloadBuildingReport(Building $building, Respondent $respondent){
        

        $content = "";
        foreach($building->reports as $report){ 
            $content .= makeReport($report->body, $respondent->id); 
        }

        $pdf = PDF::loadHTML($content);
        return $pdf->download($building->name . "_" . $respondent->name  . ".pdf");



        
    }

    public function apiCreate(Requests\CreateRespondent $request){

    	$respondent = Respondent::create([
    		'name' 			=> $request->name,
            'building_id'   => $request->building_id,
    		'user_id' 	    => auth()->user()->id,
    	]);
    	return $respondent;
    }

    public function apiShow(Respondent $respondent){
    	return $respondent;
    }

    public function apiDownloadBuildingReport(Building $building, Respondent $respondent){
        

        $content = "";
        foreach($building->reports as $report){ 
            $content .= makeReport($report->body, $respondent->id); 
        }

        $pdf = PDF::loadHTML($content);

        return $pdf->download($building->name . "_" . $respondent->name . ".pdf");
       

    }

    public function completedStatus(Building $building, Respondent $respondent){
        return response()->json(["is_complete" => (int)$respondent->is_complete]);
    }

    public function completed(Request $request, Building $building, Respondent $respondent){
        $respondent->is_complete = (boolean)$request->is_complete;
        $respondent->save();

        return $respondent;
    }

    public function delete(Respondent $respondent){
        $respondent->delete();
        return back()->withMessage("Deleted");
    }
}

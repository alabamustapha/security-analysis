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

        dd();
    }

    public function apiCreate(Requests\CreateRespondent $request){

    	$respondent = Respondent::create([
    		'name' 			=> $request->name,
    		'building_id' 	=> $request->building_id,
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
        return $pdf->download($building->name . "_" . $respondent->name  . ".pdf");

    }
}

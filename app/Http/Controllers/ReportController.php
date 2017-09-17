<?php

namespace App\Http\Controllers;

use App\Building;
use App\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(){
    	$buildings = Building::with('reports')->get();
    	return view('reports.index', compact('buildings'));
    }

    public function store(Request $request, Building $building, $id){

                $report = $building->reports()->whereId($id)->first();

    			$message = "";
    			
    			if($report){
                    $report->body = $request->body;
                    $report->title = $request->title;
    				$report->page = $request->page;
    				$report->save();
    				$message = "report updated";
    			}


                if($request->has('save_and_new')){

                    $last_page = max($building->reports->pluck('page')->toArray());
                    
                    $report = Report::create([
                        'building_id' => $building->id,
                        'title' => "",
                        'page' =>  $last_page + 1,
                        'body' => "Page " . ($last_page + 1)
                    ]);

                    $message = "Page saved, continue editing new page";   
                }elseif ($request->has('save_and_goto')) {

                    $page = $request->goto_page;
                    if(isset($page) && !is_null($page)) {
                       $report = $building->reports()->wherePage($page)->first();
                    }else {
                        $message = "Invalid page";
                    }
                }


                 return redirect()->route('manage_building_report', [$building])
                                ->with('report', $report)
                                ->with('message', $message);
    			
    }
}

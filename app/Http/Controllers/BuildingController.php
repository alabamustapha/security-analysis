<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Building;
use App\Category;
use App\Question;
use App\Report;
use PDF;
class BuildingController extends Controller
{

    public function index(){
    	$buildings = Building::all();
    	return view('buildings.index', compact('buildings'));
    }

    public function create(){
    	return view('buildings.create');
    }

    public function store(Request $request){

    	$building = Building::create($request->all());

    	return redirect('buildings')->with('message', $building->name . ' has been added');
    }

    public function edit(Building $building){
        return view("buildings.edit", compact('building'));
    }

    public function update(Request $request, Building $building){

        $message = "No changes made";

        if($building->name !== $request->name){
            $building->update($request->all());
            $message = "Record updated";    
        }
        
        return redirect()->route('edit_building', ['building' => $building->name])->withMessage($message);
    }

    public function delete(Building $building){
        $building->delete();

        return back()->withMessage("Building records removed");
    }

    public function manage(Building $building){
           
            $categories = Category::with('sub_categories')->get();

            return view('buildings.manage', compact('building', 'categories'));
    }

    public function manageCategoryQuestions(Building $building, Category $category){

            $category_questions = $building->categoryQuestions($category->id);
            
            return view('buildings.categories.questions', compact('building', 'category', 'category_questions'));

    } 

    public function previewCategoryQuestions(Building $building, Category $category){


            $category_questions = $building->categoryQuestions($category->id)->get();
            
            return view('buildings.categories.preview', compact('building', 'category', 'category_questions'));

    }

    public function report(Building $building, Request $request){
        
        if(session('report')){
            $report = session('report');
        }elseif($building->reports->count() > 0){
            if($request->has('page')){
                $report = $building->reports()->where('page', $request->page)->first();
            }else {
                $report = $building->reports()->first();
            }
        }else{

            $report = Report::create([
                   'building_id' => $building->id, 
                   'page' => 1,
                   'title' => "",
                   'body' => ""
            ]);
        }
        

        return view('buildings.report', compact('building', 'report'));
    }

    public function previewReport(Building $building){

        return view('buildings.preview_report', compact('building'));
    }

    public function downloadReport(Building $building){

        $content = "";
        foreach($building->reports as $report){ 
            $content .= makeReport($report->body); 
        }

        $pdf = PDF::loadHTML($content)->save(storage_path("app/public/reports/" . $building->name . ".pdf"));

        return response()->file(storage_path("app/public/reports/" . $building->name . ".pdf"));
    }

    public function apiAll(Request $request){
        $results = [];
        if($request->has('id')){
            $results = Building::whereId($request->id)->firstOrFail()->toArray();
        }else{
            $results = Building::all()->toArray();       
        }
        
        return $results;
    }

    public function apiAllQuestions(Request $request, Building $building){
            return $building->questions()->with('building', 'category')->get();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Building;
use App\Category;
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

    public function manage(Building $building){
           
            $categories = Category::with('sub_categories')->get();

            return view('buildings.manage', compact('building', 'categories'));
    }

    public function manageCategoryQuestions(Building $building, Category $category){

            $category_questions = $building->categoryQuestions($category->id);
            
            return view('buildings.categories.questions', compact('building', 'category', 'category_questions'));

    }
}
<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests;

class CategoryController extends Controller
{
    public function index(){
    	$categories = Category::with('sub_categories', 'main_category')->get();
    	
    	return view('categories.index', compact('categories'));
    }

    public function create(){
    	$categories = Category::all();
    	return view('categories.create', compact('categories'));
    }

    public function store(Requests\StoreCategoryRequest $request){
    	$category = Category::create($request->all());
    	return back()->with('message', $category->name . " Created successfully");
    }
}

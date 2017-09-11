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

    public function delete(Request $request, Category $category){
        $category->delete();

        return back()->withMessage("Category deleted");
    }

    public function edit(Category $category){
        $categories = Category::all();
        return view('categories.edit', compact('categories', 'category'));
    }

    public function update(Request $request, Category $category){
        $category->update($request->all());

        return back()->withMessage("Record updated");
    }
}

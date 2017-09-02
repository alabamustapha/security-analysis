<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;

class OfficerController extends Controller
{
    
    public function store(Requests\CreateNewOfficer $request){
    	
    	//dd($request->all());

    	$user = User::create($request->all());

    	return back()->with("message", "Officer added successfully");

    }

    public function create(){
    	return view('officers.create');
    }
}

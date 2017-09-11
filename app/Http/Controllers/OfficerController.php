<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;

class OfficerController extends Controller
{
    
    public function store(Requests\CreateNewOfficer $request){
    	

    	$user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

    	return back()->with("message", "Officer added successfully");

    }

    public function create(){
    	return view('officers.create');
    }

    public function delete(Request $request, $id){
    	User::find($id)->delete();

    	return back()->with("message", "Record deleted");
    }

    public function edit($id){
        $officer = User::find($id);
    	return view('officers.edit', compact('officer'));
    }

    public function update(Requests\UpdateOfficer $request, $id){
            $user = User::findOrFail($id);
            $user->password = bcrypt($request->password);
            $user->save();
            return back()->with("message", "Record updated");
    }


}

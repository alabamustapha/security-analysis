<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Building;
use App\Respondent;

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

    public function delete(Request $request, User $officer){
    	
        $officer->delete();

    	return back()->with("message", "Record deleted");
    }

    public function edit(User $officer){
    	return view('officers.edit', compact('officer'));
    }

    public function inspectedBuildings(User $officer){
        
        return view('officers.buildings', compact("officer"));
    }

    public function inspectedBuildingRespondents(User $officer, Building $building){
        $building_respondents = $officer->buildingRespondents($building->id);
        
        return view('officers.building_respondents', compact(["officer", "building_respondents", "building"]));
    }

    public function inspectedBuildingRespondentReport(User $officer, Building $building, Respondent $respondent){
        
        return view('officers.building_respondent_report', compact(["officer", "building_respondents", "building", "respondent"]));
    }

    public function inspectedBuildingRespondentResponses(User $officer, Building $building, Respondent $respondent){

            $responses = $respondent->buildingResponses($building->id);
            
            return view('officers.building_respondent_responses', compact(["officer", "respondent", "building", "responses"]));

    }


    public function update(Requests\UpdateOfficer $request, $id){
            $user = User::findOrFail($id);
            $user->password = bcrypt($request->password);
            $user->save();
            return back()->with("message", "Record updated");
    }


}

<?php

namespace App;

use App\Building;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function respondents(){
        return $this->hasMany("App\Respondent");
    }

    public function buildingRespondents($building_id){
        return $this->hasMany("App\Respondent")->where('building_id', $building_id)->get();
    }

    public function inspectedBuildings(){
        $building_ids = $this->respondents->pluck('building_id')->toArray();

        $buildings = [];
        
        if($building_ids){
            $buildings = Building::where('id', 'in', $building_ids)->get();
        }

        return $buildings;
        
    }

}

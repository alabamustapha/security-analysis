<?php

namespace App\Http\Controllers;
use App\License;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Softon\Indipay\Facades\Indipay;
use App\User;
use App\Question;
use App\Building;
use App\Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('installed');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $officers_count     = User::whereRole('officer')->count();
        $buildings_count    = Building::all()->count();
        $questions_count    = Question::all()->count();
        $responses_count    = Response::all()->count();
        return view('home', compact('officers_count', 'questions_count', 'buildings_count', 'responses_count'));
    }

    public function install(Request $request){


        //Some basic variables
        $error_detected=0;
        $installation_completed=0;
        $error_details="";


        
        $apl_core_notifications=aplCheckSettings();

        
        if (!empty($apl_core_notifications)){
           abort(503);
        }

        $apl_connection_notifications=aplCheckConnection();

        if (!empty($apl_connection_notifications)){
            return back()->with('message', 'Unable to connect to server');    
        }


        $mysqli = mysqli_connect(env("DB_HOST"), env("DB_USERNAME"), env("DB_PASSWORD"), env("DB_DATABASE"));
        

        $license_notifications_array = aplInstallLicense($mysqli, $request->root_url, $request->email, "");

        if(isset($license_notifications_array['notification_case']) && $license_notifications_array['notification_case']=="notification_license_ok"){
            return redirect('login')->with('Message', "Installation successfull, login to continue");        
        }else{
            return back()->with('message', $license_notifications_array["notification_text"]);        
        }
        

        dd($request->all());
}

    public function LicenseInstallation(Request $request){
 
        $mysql_query="
        CREATE TABLE `_APL_DATABASE_TABLE_` (
            `SETTING_ID` TINYINT(1) NOT NULL AUTO_INCREMENT,
            `ROOT_URL` VARCHAR(250) NOT NULL,
            `CLIENT_EMAIL` VARCHAR(250) NOT NULL,
            `LICENSE_CODE` VARCHAR(250) NOT NULL,
            `LCD` VARCHAR(250) NOT NULL,
            `LRD` VARCHAR(250) NOT NULL,
            `INSTALLATION_KEY` VARCHAR(250) NOT NULL,
            `INSTALLATION_HASH` VARCHAR(250) NOT NULL,
            PRIMARY KEY (`SETTING_ID`)
        ) DEFAULT CHARSET=utf8;

        INSERT INTO `_APL_DATABASE_TABLE_` (`SETTING_ID`, `ROOT_URL`, `CLIENT_EMAIL`, `LICENSE_CODE`, `LCD`, `LRD`, `INSTALLATION_KEY`, `INSTALLATION_HASH`) VALUES ('1', '_ROOT_URL_', '_CLIENT_EMAIL_', '_LICENSE_CODE_', '_LCD_', '_LRD_', '_INSTALLATION_KEY_', '_INSTALLATION_HASH_');";

        dd($mysql_query);
        //most of variables in $mysql_good_array should come as POST parameters
        $mysql_bad_array=array("_APL_DATABASE_TABLE_", "_ROOT_URL_", "_CLIENT_EMAIL_", "_LICENSE_CODE_", "_LCD_", "_LRD_", "_INSTALLATION_KEY_", "_INSTALLATION_HASH_");
        $mysql_good_array=array($apl_database_table, $root_url, $client_email, $license_code, $lcd, $lrd, $installation_key, $installation_hash);
        $mysql_query=str_replace($mysql_bad_array, $mysql_good_array, $mysql_query);

        return $mysql_query;
    }



    public function license(){
     
        $license_notifications_array = aplVerifyLicense("", 1);
        
        $license = License::first();
        return view("license", compact("license_notifications_array", "license"));
    }

    public function renewLicense(Request $request){


      $parameters = $request->except('_token');

      $order = Indipay::prepare($parameters);
      
      return Indipay::process($order);
    }

    public function paymentResponse(Request $request)
    {
        
        $response = Indipay::response($request);
        
        return redirect('license')->with('message', $response);
    
    }

    public function officer(){
        $officers = User::where("role", "officer")->paginate(15);
        return view("officers.index", compact("officers"));
    } 

    public function setup(){
        $root_url = url('/');
        return view('install', compact('root_url'));
    } 
}

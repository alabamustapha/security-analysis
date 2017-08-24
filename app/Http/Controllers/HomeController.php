<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 use Softon\Indipay\Facades\Indipay;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

public function license(){

    // Merchant key here as provided by Payu
    //$MERCHANT_KEY = "i4YbRJcH";
    $MERCHANT_KEY = "rjQUPktU";

    // Merchant Salt as provided by Payu
    $SALT = "e5iIg1jwi8";

    // End point - change to https://secure.payu.in for LIVE mode
    $PAYU_BASE_URL = "https://test.payu.in";

    $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
    $hash = '';

$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";

    $hashVarsSeq = explode('|', $hashSequence);
    
    $hash_string = '';  
    
    
    $hash_string .= $MERCHANT_KEY . '|' . $txnid . '|100' . '|license renewal|' . Auth::user()->name . '|' . Auth::user()->mail . '||||||||||';
    

    $hash_string .= $SALT;

    

    $hash = strtolower(hash('sha512', $hash_string));

    
    $action = $PAYU_BASE_URL . '/_payment';
  
    return view("license", compact(['hash', 'txnid', 'hash_string']));
    }

    public function renewLicense(Request $request){

            $parameters = $request->except('_token');



      
      $order = Indipay::prepare($parameters);
      return Indipay::process($order);
    }

    public function paymentResponse(Request $request)
    {
        // For default Gateway
        $response = Indipay::response($request);
        
        // For Otherthan Default Gateway
        $response = Indipay::gateway('NameOfGatewayUsedDuringRequest')->response($request);

        dd($response);
    
    }

    public function officer(){

        return view("officers.index");
    }  
}

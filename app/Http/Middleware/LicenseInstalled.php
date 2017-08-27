<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use Closure;

class LicenseInstalled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        if(Schema::hasTable("user_data")){
            
            if(DB::table('user_data')->count() > 0){
                 return $next($request);
            }else{
                Schema::drop("user_data");
            }
        } 

        return redirect('setup')->with('message', "License required");
        
        
    }
}

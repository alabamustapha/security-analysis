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
        
        if( Schema::hasTable("user_data") || 
            file_exists(base_path("content/signature/license.txt"))
            ){
             if(DB::table('users')->count() > 0 || DB::table('user_data')->count() > 0){
                 return $next($request);
            }
        } 

        return redirect('setup')->with('message', "License required");
        
        
    }
}

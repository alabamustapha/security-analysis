<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Schema;
use Closure;

class CheckLicense
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

           
        $license_notifications_array = aplVerifyLicense("", 1);
        
        dd($license_notifications_array);
        
        var_dump($link);

        return $next($request);
    }
}

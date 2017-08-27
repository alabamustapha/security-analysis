<?php

namespace App\Http\Middleware;

use Closure;

class VerifyLicense
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
        
        if($license_notifications_array["notification_case"] = "notification_license_ok"){
            return $next($request);
        }

        return redirect("license")->with("message", $license_notifications_array["notification_text"]);
        
        
    }
}

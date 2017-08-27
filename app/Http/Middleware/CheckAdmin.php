<?php

namespace App\Http\Middleware;
use App\User;
use Closure;

class CheckAdmin
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
        if(User::where('role', 'admin')->first()){
            return $next($request);    
        }
        
        return redirect('register')->with('message', "setup admin account");
    }
}

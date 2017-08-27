<?php

namespace App\Http\Middleware;
use App\User;
use Closure;

class VerifyAdminCreated
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
            return redirect('login');
        }
        return $next($request);
    }
}

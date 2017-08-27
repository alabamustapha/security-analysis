<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Schema;

use Closure;

class VerifySetup
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
        $has_table = Schema::hasTable('user_data');

        if($has_table){
            return redirect('login');        
        }

        return $next($request);

        
    }
}

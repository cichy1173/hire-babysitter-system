<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
   
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check() && auth()->user()->id_account_type != '3') {
            
            return redirect()->route('dashboard');

        }


        return $next($request);
    }
}


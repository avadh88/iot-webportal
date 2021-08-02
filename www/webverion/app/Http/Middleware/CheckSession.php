<?php

namespace App\Http\Middleware;

use Closure;

class CheckSession
{

    public function handle($request, Closure $next){

        // dd($request->session()->get('token'));
        if(!$request->session()->exists('token')){
            return redirect('/login');
        }
        
        return $next($request);
    }

}
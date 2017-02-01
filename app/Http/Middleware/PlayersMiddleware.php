<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class PlayersMiddleware
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
        // Authenticate User
        // Check User Role == Player
        if(Sentinel::check() && Sentinel::getUser()->roles()->first()->slug == 'player'){
            return $next($request);
        }else{
            return redirect('/');
        }
    }
}

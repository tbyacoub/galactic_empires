<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class AdminMiddleware
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
        // Check User Role == Admin
        if(Sentinel::check() && Sentinel::getUser()->roles()->first()->slug == 'admin'){

            return $next($request);
            //\Log::info('role', ['role' => Sentinel::getUser()->roles()->first()->slug]);
        }else{
            return redirect('/');
        }
    }
}

<?php

namespace App\Http\Middleware;

use Closure;

class AdminMedia
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
        $user = $request->user();

        if ($user->users_role == 'admin' or $user->users_role == 'media') {
            return $next($request);
        }
        
        return redirect('/');
    }
}

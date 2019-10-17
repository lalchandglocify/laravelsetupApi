<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class UserLogin
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
        $userDetails = Auth::User();

        if(is_null($userDetails)){
            return redirect('login');
        }
        elseif($userDetails->user_type!='user'){
            abort(403, 'Unauthorized action.');
        }
        return $next($request); 
    }
}

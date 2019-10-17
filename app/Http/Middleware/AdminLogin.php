<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class AdminLogin
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
        $adminDetails = Auth::User();
        if(is_null($adminDetails)){
            return redirect('admin');
        }
        elseif($adminDetails->user_type!='admin'){
            abort(403, 'Unauthorized action.');
        }
        return $next($request);        
    }
}

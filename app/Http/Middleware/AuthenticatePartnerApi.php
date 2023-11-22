<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticatePartnerApi
{
    /**
     * Handle an incoming request by checking if the user is authenticated 
     * and active based on the 'partner_api' guard. 
     *
     * If the user is not authenticated, it returns an 'Unauthorized' error. 
     * If the user is authenticated but not active, it returns a 'Partner is not active' error. 
     * If both checks pass, the request is passed to the next middleware/handler in the stack.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next)
    {
        $guard = Auth::guard('partner_api');

        if (!$guard->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        } 

        if (!$guard->user()->is_active) {
            return response()->json(['error' => 'Partner is not active'], 401);
        }
        
        return $next($request);
    }    
}

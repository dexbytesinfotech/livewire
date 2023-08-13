<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {      
        if(auth()->check() && (auth()->user()->status == 0)) {
            $request->session()->invalidate();
            Auth::logout();
            return redirect()->route('login')->with('status', __('user.Your Account is disabled, please contact to system administrator.'));
        }
        
        return $next($request);
    }
}

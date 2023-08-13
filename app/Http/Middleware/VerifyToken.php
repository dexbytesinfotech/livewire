<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Users\PasswordReset;

class VerifyToken
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
        $tokenExist = PasswordReset::where('token', $request->token)->first();
        $now = Carbon::now();
        if($tokenExist && $now->isBefore($tokenExist->created_at)) {
            return $next($request); 
        }
        PasswordReset::where('token', $request->token)->delete();
        return redirect()->route('login');
    }
}

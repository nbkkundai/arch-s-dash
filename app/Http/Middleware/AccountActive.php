<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class AccountActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if ($user->is_active == true) {
            return $next($request);
        }elseif($user->is_active == false){
            return redirect('/users/deactivated')->with('danger', 'Your Account has been deactivated.');
        }
    }
}


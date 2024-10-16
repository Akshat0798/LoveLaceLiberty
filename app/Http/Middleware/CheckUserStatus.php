<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Session;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $redirectToRoute = null)
{
    if ($request->user() && $request->user()->status != 1) {
        Auth::guard('business')->logout();
        Session::flash('errMsg', 'Your account is deactivated by admin');
        return redirect('/signin');
    }

    return $next($request);
}
}

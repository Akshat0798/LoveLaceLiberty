<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsAdmin {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
       
        if(\Session::has('lang-type')){
            app()->setLocale(\Session::get('lang-type'));
        }else{
            \Session::put('lang-type', 'en');
        }
        

        if (Auth::user() && Auth::user()->role_id == '1') {
            return $next($request);
        }
        if (Auth::user() && Auth::user()->role_id == '2') {
            return $next($request);
        }
        if (Auth::user() && (Auth::user()->role_id == '2' || Auth::user()->role_id == '3') && Auth::user()->is_sub_admin == 1) {     
            return redirectUser('dashboard');
        }
        if (Auth::user() && Auth::user()->role_id == '2' && Auth::user()->is_sub_admin != 1) {
                 Auth::logout();
                 $request->session()->flash('alert-danger', 'Invalid Credentials ');
                  return redirect('/admin');
            }
        if (Auth::user()) {
            
            if (Auth::user()->role_id == '4') {
                  Auth::logout();
                  return redirect('/');
            }
        }
        return redirect('/');
    }

}

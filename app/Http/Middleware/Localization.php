<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Session;
use Auth;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function __construct(Application $app, Redirector $redirector, Request $request) {
        $this->app = $app;
        $this->redirector = $redirector;
        $this->request = $request;
    }
    
    protected $languages = ['en','ar'];

    /*
    public function handle($request, Closure $next)
    {
        /*
        if ( \Session::has('locale')) {
            \App::setLocale(\Session::get('locale'));

            // You also can set the Carbon locale
            Carbon::setLocale(\Session::get('locale'));
        }*/
        /*
        if(!Session::has('locale'))
        {
            Session::put('locale', $request->getPreferredLanguage($this->languages));
        }

        app()->setLocale(Session::get('locale'));

        if(!Session::has('statut')) 
        {
            Session::put('statut', Auth::check() ?  Auth::user()->role->slug : 'visitor');
        }

        return $next($request);
    }*/

    public function handle($request, Closure $next)
    {
        // Make sure current locale exists.
        //$locale = $request->segment(1);
/*
        if ( ! array_key_exists($locale, $this->app->config->get('app.locales'))) {
            $segments = $request->segments();
            $segments[0] = $this->app->config->get('app.fallback_locale');

            return $this->redirector->to(implode('/', $segments));
        }*/
        $locale = Session::get('lang-type');
        $this->app->setLocale($locale);

        return $next($request);
    }

}
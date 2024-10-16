<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CustomAuth
{
    public function handle($request, Closure $next)
    {
        $key = 'BeHere-[{(*-*)}]';
        $headers = $request->header();
        
        if($request->header('apiKey') && $request->header('accessToken') && md5($key.$request->header('apiKey'))==$request->header('accessToken')){
            return $next($request);
        }else{
            $user_res = [];
            $user_res['status'] = false;
            $user_res['code'] = 404;
            $user_res['message'] = "Invalid api access!";
            $user_res['user_status'] = 'false';
            $user_res['data'] = (object) [];
            return response()->json($user_res);
        }
        return $next($request);
    }
}
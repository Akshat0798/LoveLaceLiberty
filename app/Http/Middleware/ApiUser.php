<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Exception;
use Auth;

class ApiUser
{
    /**
     
Handle an incoming request.*
@param  \Illuminate\Http\Request  $request
@param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
@return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
*/
public function handle(Request $request, Closure $next){
    try{$student = Auth::user();// dd($student);
        if(empty($student)) {
            return response()->json(['status' => 404, 'code'=>404, 'message' => "User doesn't exist.",'data' => [] ]);} elseif($student->deleted_at!=null || $student->deleted_at!=''){
            return response()->json(['status' => 404, 'code'=>404, 'message' => 'Your account was deleted.','data' => [] ]);}  elseif($student->status==0){
            return response()->json(['status' => 404, 'code'=>404, 'message' => 'Your account is deactivated from administrator.','data' => [] ]);}} 
    catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['status' => 404, 'code'=>404, 'message' => 'Token is Invalid.','data' => [] ]);}
            elseif ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['status' => 404, 'code'=>404, 'message' => 'Your account was deleted.','data' => [] ]);}
            else{
                return response()->json(['status' => 404, 'code'=>404, 'message' => 'Authorization Token not found.','data' => [] ]);}}
    return $next($request);}
}

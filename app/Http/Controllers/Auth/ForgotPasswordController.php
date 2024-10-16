<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */
    public function setPasswordAdmin(Request $request, $email) {
        $email = decrypt($email);
        $forget = ForgotPassword::where('email',$email)->first();
        if (!empty($forget)) { 
            return view('emails.change-pass', compact('email'));
        }else{
           $msg = "Your link has expired";
           return view('emails.email-verification-web-page', compact('msg')); 
        }  
    }
    use SendsPasswordResetEmails;
}

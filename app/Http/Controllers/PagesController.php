<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use EmailProvider;
use \Cache;
use Mail;
use Session;
use Redirect;

class PagesController extends Controller {

    public function index(Request $request, $lang='en') {
         return view('frontend/commingSoon');
    }
    public function support(Request $request, $lang='en')
    {
        return view('supportpage');
    }

}

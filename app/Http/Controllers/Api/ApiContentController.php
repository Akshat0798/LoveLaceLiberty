<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Lib\PushNotification;
use App\Models\AppVersion;
use App\Models\Category;
use App\Models\City;
use App\Models\Cms;
use App\Models\Content;
use App\Models\Country;
use App\Models\Interest;
use App\Models\Restriction;
use App\Models\State;
use App\Models\User;
use App\Models\UserBlock;
use App\Models\UserDevice;
use App\Models\Business;
use App\Models\BusinessHour;
use App\Models\Plan;
use App\Models\FavouriteBusiness;
use App\Models\Transaction;
use App\Models\BusinessReview;
use App\Models\PlanSubscription;
use Auth;use File;use Illuminate\Http\Request;use Illuminate\Support\Facades\DB;use Illuminate\Support\Facades\Hash;use Illuminate\Support\Facades\Validator;
use Mail;
use Str;

class ApiContentController extends ApiController
{
   
}
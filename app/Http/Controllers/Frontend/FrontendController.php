<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\ForgotPassword;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mail;
use Session;
use Str;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;


class FrontendController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __construct()
    {

    }

    public function index()
    {
		$merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(env('AUTHORIZENET_API_LOGIN_ID'));
        $merchantAuthentication->setTransactionKey(env('AUTHORIZENET_TRANSACTION_KEY'));
		
		// Set the transaction's refId
		$refId = 'ref' . time();

		$sorting = new AnetAPI\ARBGetSubscriptionListSortingType();
		$sorting->setOrderBy("id");
		$sorting->setOrderDescending(false);

		$paging = new AnetAPI\PagingType();
		$paging->setLimit("10");
		$paging->setOffset("1");

		$request = new AnetAPI\ARBGetSubscriptionListRequest();
		$request->setMerchantAuthentication($merchantAuthentication);
		$request->setRefId($refId);
		$request->setSearchType("subscriptionInactive");
		$request->setSorting($sorting);
		$request->setPaging($paging);


		$controller = new AnetController\ARBGetSubscriptionListController($request);
		// For SANDBOX use
		$response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
		
		// For PRODUCTION use
		//$response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);


		if (($response != null) && ($response->getMessages()->getResultCode() == "Ok")) {
			echo "SUCCESS: Subscription Details:" . "\n";
			echo "Total Number In Results:" . $response->getTotalNumInResultSet() . "\n";
			if ($response->getTotalNumInResultSet() > 0) {
				foreach ($response->getSubscriptionDetails() as $subscriptionDetails) {
					echo "Subscription ID: " . $subscriptionDetails->getId() . "\n";
				}
			}
		} else {
			echo "ERROR :  Invalid response\n";
			$errorMessages = $response->getMessages()->getMessage();
			echo "Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";
		}
	
		echo '<pre>';
		print_r($merchantAuthentication);
		echo '</pre>';
		die;
        return view('frontend/index');
    }

    public function registerPage()
    {
        return view('frontend.page.register');
    }

    public function register(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile_number' => 'required',
            'user_name' => 'required|unique:users,user_name',
            'dob' => 'required',
            'subscription_type' => 'required',
            'email' => 'required|unique:users,email,NULL,id,deleted_at,NULL,role_id,2|regex:/^[A-Za-z0-9_.]+@[A-Za-z0-9.\-]+\.[A-Za-z]{2,}$/',
            'password' => 'required|min:8|max:25|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
        ], [
            'password.regex' => 'Password field will allow characters 8 with standard password policy (one Capital letter, one Number, one special character)',
            'user_name.required' => 'Please fill username!',
            'password.required' => 'Please fill password!',
            'email.required' => 'Please fill email!',
            'email.unique' => 'This email is already been taken!',
            'user_name.unique' => 'This user name is already been taken!',
            'first_name.required' => 'Please fill first name!',
            'last_name.required' => 'Please fill last name!',
        ]);

        if($request->subscription_type == 2){
            if($request->provisionOthers == 'on'){
                $request->session()->flash('error', 'you can not select it');
                return redirect()->back()
                ->withInput();  
            }

        }
        if ($validator->fails()) {
            return redirect("/signup")
            ->withErrors($validator)
            ->withInput();
        }

            try {

                $user = new User;
                $user->first_name = $input['first_name'];
                $user->last_name = $input['last_name'];
                $user->user_name = $input['user_name'];
                $user->mobile_number = $input['mobile_number'];
                $user->email = $input['email'];
                $user->dob = $input['dob'];
                $user->subscription_type = $input['subscription_type'];
                $user->role_id = 2;
                $user->password = Hash::make($input['password']);
                $user->email_verification_code = "123456";
                if($request->provisionOthers == "on"){
                    $user->provision_others = 1;
                } else {
                    $user->provision_others = 0;
                }
                $user->save();
                // Mail::send('frontend.emails.verifyUser', array(
                //     'full_name' => $input['full_name'],
                //     'email' => $input['email'],
                //     'email_verified_at' => $user->email_verified_at,
    
                // ), function ($message) use ($request) {
                //     $message->from('luvsh6669@gmail.com', 'love');
                //     $message->to($request->email)->subject('Welcome to the love');
                // });
                $request->session()->flash('success', 'Email verification link send to your email');
                return redirect()->route('verificationPage', [encrypt($request->email)]);
            } catch (ModelNotFoundException $e) {
                $message = trans("registration unsuccessful");
                $request->session()->flash('error', $message);
                return redirect()->back();
            }
    }
    public function verificationPage($email)
    {
        $userEmail = decrypt($email);
        if($userEmail == null){
            $request->session()->flash('error', 'email does not found');
                return redirect()->route('/');
        }
        return view('frontend.page.mfa',compact('userEmail'));
    }
    public function verification(Request $request)
    {
        $verifyUser = User::where('email', $request->email)->first();
        if ($verifyUser) {
            $verifycheck = ($verifyUser->is_email_verified);
            if ($verifycheck == null) {
                $verifyUser->is_email_verified = 1;
                $verifyUser->status = '1';
                $verifyUser->email_verification_code = null;

                $verifyUser->save();
                if (Auth::guard('client')->loginUsingId($verifyUser->id)) {
                    return redirect()->route('client.subscription.index');
                } else {
                    return redirect('/signin');
                }
            } else {
                return redirect('/signin')->with('success', "Your e-mail is already verified. You can now login.");
            }
        } else {
            return redirect('/')->with('errMsg', "Sorry your email cannot be identified.");
        }
    }
    public function signin(request $request)
    {
        $validator = Validator::make($request->all(), ['user_name' => 'required|exists:users,user_name']);
        
        if ($validator->fails()) {
            Session::flash('errMsg', 'User name does not exist.');
            return redirect()->back()->withInput($request->all());
        } else {
            $user = User::where('user_name', $request->user_name)->first();
            if ($user != null) {
                if ($user->status != 0) {
                    if ($user->role_id == 2) {
                        if (Auth::guard('client')->attempt(['user_name' => $request->get('user_name'), 'password' => $request->get('password')])) {
                            Session::flash('success', 'login');
                            if($user->is_subscribed == 0){
                                return redirect()->route('client.subscription.index');
                            } else {
                                return redirect()->route('client.dashboard.index');
                            }
                        } else {
                            Session::flash('errMsg', 'Password is incorrect.');
                            return redirect()->back()->withInput($request->all());
                        }
                    } else {
                        Session::flash('errMsg', 'User does not exist.');
                        return redirect()->back()->withInput($request->all());
                    }
                } else {
                    Session::flash('errMsg', 'Please verify your user_name address first.');
                    return redirect()->back()->withInput($request->all());
                }
            } else {
                Session::flash('errMsg', 'User does not exist.');
                return redirect()->back()->withInput($request->all());
            }
        }

    }

    public function forgetPassword()
    {
        return view('frontend.emails.forgotPassword');
    }

    public function resetPassLinkSent(Request $request)
    {
        $request->validate([
            'email' => 'required|regex:/^[A-Za-z0-9_.]+@[A-Za-z0-9.\-]+\.[A-Za-z]{2,}$/',
        ]);

        try {
            $user = User::where('email', $request->email)->where('role_id', '2')->first();
            if (!empty($user)) {
                // dd($user);
                ForgotPassword::where('email', $request->email)->delete();
                $forgetPass = new ForgotPassword;
                $forgetPass->email = $request->email;
                $forgetPass->save();
                $en_email = encrypt($request->email);
                $link = route('businessPasswordSet', ['email' => $en_email]);
                $data = ['email' => $request->email, 'preferred_name' => $user->full_name, 'link' => $link];
                $email_subject = 'Reset Your Password';
                $mail = Mail::send('frontend/emails/email_forgetlink', $data, function ($message) use ($email_subject, $data) {
                    $message->to($data['email'], env('APP_NAME'))->subject($email_subject);
                });
                return redirect()->route('businessSignin')->with('success', 'Reset password link is sent to your email address. Please check your email');
            } else {
                session()->flash('errMsg', 'This email address is not registered');
                return redirect()->back()->with('errMsg', 'This email address is not registered')->withInput($request->all());
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('errMsg', $e->getMessage());
        }
    }

    public function PasswordSet(Request $request, $email)
    {
        $email = decrypt($email);
        $forget = ForgotPassword::where('email', $email)->first();
        if (!empty($forget)) {
            return view('frontend.emails.forgotPassword-change', compact('email'));
        } else {
            $msg = "Your link has expired";
            return view('emails.email-verification-web-page', compact('msg'));
        }
    }

    public function SetPassWord(Request $request)
    {
        $request->validate([
            'new_password' => 'required|min:8|max:25|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'confirm_password' => 'required|required_with:new_password|same:new_password',
        ],
            [
                'confirm_password.same' => 'New password and confirmation password do not match.',
                'new_password.regex' => 'Password field will allow characters 8 with standard password policy (one Capital letter, one Number, one special character)',
            ]);
        try {
            $user = User::where('email', $request->email)->first();
            $email = $request->email;
            if (!empty($user)) {
                $user->password = Hash::make($request->confirm_password);
                $user->save();
                $data = ['email' => $request->email, 'preferred_name' => $user->user_name];
                $email_subject = 'Password generated Successfully';
                $mail = Mail::send('frontend/emails/password-generated-success', $data, function ($message) use ($email_subject, $data) {
                    $message->to($data['email'], env('APP_NAME'))->subject($email_subject);
                });
                $forget = ForgotPassword::where('email', $email)->delete();
                return redirect()->route('businessSignin')->with('success', 'Password generated Successfully');
            } else {
                return redirect()->back()->with('errMsg', 'User Not Found');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('errMsg', $e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('client')->logout();
        return redirect('/');
    }

    public function get_in_touch(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|regex:/^[A-Za-z0-9_.]+@[A-Za-z0-9.\-]+\.[A-Za-z]{2,}$/',
            'number' => 'required',
            'business_name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect("rewardPage#contact_info")
                ->withErrors($validator)
                ->withInput();
        } else {
            $data = new ContactUs;
            $data->name = $request['name'];
            $data->business_name = $request['business_name'];
            $data->email = $request['email'];
            $data->number = $request['number'];
            $data->save();

            $input = $request->all();

            Mail::send('frontend.emails.contact_user', array(
                'name' => $input['name'],
            ), function ($message) use ($request) {
                $message->from('luvsh6669@gmail.com', 'BeHere Admin');
                $message->to($request->email)->subject('Get in Touch');
            });

            Mail::send('frontend.emails.contact_us', array(
                'name' => $input['name'],
                'email' => $input['email'],
                'business_name' => $input['business_name'],
                'number' => $input['number'],
            ), function ($message) use ($request) {
                $message->from('luvsh6669@gmail.com', 'Contact');
                $message->to('beHere_admin@yopmail.com')->subject('New User detail');
            });
            $request->session()->flash('success', 'Thank you for choosing BeHere');
            return redirect()->route('rewardPage');

        }
    }

    public function termCondition()
    {
        return view('frontend.page.term&condition');
    }


    public function verifyUser($email_verified_at)
    {
        $verifyUser = User::where('email_verified_at', $email_verified_at)->first();
        if (isset($verifyUser)) {
            $verifycheck = ($verifyUser->is_email_verified);
            if ($verifycheck == null) {
                // dd($verifyUser->password);
                
                $verifyUser->is_email_verified = 1;
                $verifyUser->status = '1';
                $verifyUser->save();
                if (Auth::guard('business')->loginUsingId($verifyUser->id)) {
                    return redirect()->route('business.dashboard.index');
                } else {
                    return redirect('/signin');
                }
            } else {
                return redirect('/signin')->with('success', "Your e-mail is already verified. You can now login.");
            }
        } else {
            return redirect('/signup')->with('errMsg', "Sorry your email cannot be identified.");
        }
    }

    public function getShareBusiness(Request $request)
    {
       $data = $request->all();
    //    dd($data);
       return view('frontend.deep-linking-business',compact('data'));
    }

    public function getShareGroup(Request $request)
    {
       $data = $request->all();
    //    dd($data);
       return view('frontend.deep-linking-group',compact('data'));
    }
}

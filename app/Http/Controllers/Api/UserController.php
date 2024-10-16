<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Models\AppVersion;
use App\Models\BusinedssSlider;
use App\Models\Business;
use App\Models\BusinessCategory;
use App\Models\BusinessHour;
use App\Models\BusinessReview;
use App\Models\Category;
use App\Models\Cms;
use App\Models\Content;
use App\Models\FavouriteBusiness;
use App\Models\Itinerary;
use App\Models\ItineraryGroup;
use App\Models\OfferDeal;
use App\Models\RedeemDeal;
use App\Models\RelevantCategory;
use App\Models\Review;
use App\Models\User;
use App\Models\UserDevice;
use App\Models\UserOtp;
use Auth;use Carbon\Carbon;use File;use Illuminate\Http\Request;use Illuminate\Support\Facades\DB;use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Mail;
use Str;

class UserController extends ApiController
{

    public function __construct(Request $request)
    {
    }

    public function checkUser(Request $request)
    {
        $messages = [
            'agree.required' => 'Please select the terms & privacy policy.',
            'full_name.required' => 'Please enter full name.',
            'email.required' => 'Please enter valid email address',
            'email.email' => 'Please enter a valid email address.',
            'email.regex' => 'Please enter a valid email address.',
            'password.required' => 'Please enter password.',
            'password.regex' => 'Password should have one capital and small letter, one number and a special character.',
            'confirm_password.same' => 'password and confirm password fields value must be matched',
            'confirm_password.required' => 'Please enter confirm password.',

        ];
        $validator = Validator::make(
            $request->all(),
            [
                'agree' => 'required',
                'full_name' => 'required|min:3|max:30',
                'email' => 'required|email:rfc,dns|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/|max:255|unique:users,email,NULL,id,deleted_at,NULL,role_id,3',
                'confirm_password' => 'required|same:password',
                'password' => 'required|min:8|max:25|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            ],
            $messages
        );
        if (!$this->validate($validator)) {
            return $this->response();
        }
        try {
            $this->status = "true";
            $this->message = __('User check successfully.');
        } catch (\Exception $ex) {
            $this->status = "false";
            $this->message = trans('api_user.somewrong');
            $this->data = [];
            errorApiLog($ex->getMessage() . ' at ' . $ex->getLine(), $request);
        }
        $this->response();
    }

    public function sendOtpEmail(Request $request)
    {
        if ($request->request_type == 'signup') {
            $messages = [
                'email.email' => 'Please enter a valid email address.',
            ];
            $validator = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email:rfc,dns|max:255|unique:users,email,NULL,id,deleted_at,NULL,role_id,3',
                ],
                $messages
            );
        } else {
            $messages = [
                'email.email' => 'Please enter a valid email address.',
            ];
            $validator = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email|max:255',
                ],
                $messages
            );
            $user = User::where('email', $request->email)->first();
            if (empty($user)) {
                $this->status = "false";
                $this->message = __('User not found');
                return $this->response();
            }
        }

        if (!$this->validate($validator)) {
            return $this->response();
        }
        try {
            UserOtp::where('email', $request->email)->delete();
            // $otp = rand(100000, 999999);
            $otp = "123456";
            //$res = SendMail::otpVerification($data);
            UserOtp::create([
                'email' => $request->email,
                'otp' => $otp,
            ]);

            if ($request->email) {
                $data = ['otp' => $otp];
                if ($request->request_type == 'signup') {
                    $email_subject = 'Verification code for new account registration request';
                    Mail::send('emails.new-account-register', $data, function ($message) use ($email_subject, $request) {
                        $message->to($request->email, env('APP_NAME'))->subject($email_subject);
                    });
                } else {
                    $email_subject = 'Verification code for new forgot password request';
                    Mail::send('emails.forgot-password', $data, function ($message) use ($email_subject, $request) {
                        $message->to($request->email, env('APP_NAME'))->subject($email_subject);
                    });
                }
            }

            $this->status = "true";
            $this->message = __('Verification code sent successfully.');
            $this->data = (object) [];
        } catch (\Exception $ex) {
            $this->status = "false";
            $this->message = trans('api_user.somewrong');
            $this->data = [];
            errorApiLog($ex->getMessage() . ' at ' . $ex->getLine(), $request);
        }
        $this->response();
    }

    public function resendOtp(Request $request)
    {
        if ($request->request_type == 'signup') {
            $messages = [
                'email.email' => 'Please enter a valid email address.',
                'email.regex' => 'Please enter a valid email address.',
            ];
            $validator = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email:rfc,dns|max:255|unique:users,email,NULL,id,deleted_at,NULL,role_id,3',
                ],
                $messages
            );
        } else {
            $validator = Validator::make(
                $request->all(),
                [
                    'email' => 'required|max:255',
                ]
            );
            $user = User::where('email', $request->email)->first();
            if (empty($user)) {
                $this->status = "false";
                $this->message = __('User not found');
                return $this->response();
            }

        }

        if (!$this->validate($validator)) {
            return $this->response();
        }
        try {
            UserOtp::where('email', $request->email)->delete();
            // $otp = rand(100000, 999999);
            $otp = "123456";
            //$res = SendMail::otpVerification($data);
            UserOtp::create([
                'email' => $request->email ?? "",
                'otp' => $otp,
            ]);

            if ($request->email) {
                $data = ['otp' => $otp];
                if ($request->request_type == 'signup') {
                    $email_subject = 'Verification code for new account registration request';
                    Mail::send('emails.new-account-register', $data, function ($message) use ($email_subject, $request) {
                        $message->to($request->email, env('APP_NAME'))->subject($email_subject);
                    });
                } else {
                    $email_subject = 'Verification code for new forgot password request';
                    Mail::send('emails.forgot-password', $data, function ($message) use ($email_subject, $request) {
                        $message->to($request->email, env('APP_NAME'))->subject($email_subject);
                    });
                }
            }

            $this->status = "true";
            $this->message = __('Verification code sent successfully.');
            $this->data = (object) [];
        } catch (\Exception $ex) {
            $this->status = "false";
            $this->message = trans('api_user.somewrong');
            $this->data = [];
            errorApiLog($ex->getMessage() . ' at ' . $ex->getLine(), $request);
        }
        $this->response();
    }

    public function register(Request $request)
    {
        $messages = [
            'full_name.required' => 'Please enter full name.',
            'email.email' => 'Please enter a valid email address.',
            'email.regex' => 'Please enter a valid email address.',
            'password.required' => 'Please enter password.',
            'password.regex' => 'Password should have one capital and small letter, one number and a special character.',
        ];

        $rules = [
            'otp' => 'required|min:6',
            'password' => 'required|min:8|max:25|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'full_name' => 'required',
            'email' => 'required|email:rfc,dns|max:255|unique:users,email,NULL,id,deleted_at,NULL,role_id,3',
            'device_type' => 'required|in:ANDROID,IOS',
            'device_token' => 'required',
            'device_unique_id' => 'required',
            // 'gender' => 'in:Male,Female,Non binary,Prefer not to say',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $this->message = $validator->errors()->first();
        } else {
            DB::beginTransaction();
            try {
                $where_condition = ['email' => $request->email];

                $otp = UserOtp::where($where_condition)->first();

                if ($otp) {
                    if ($otp->otp == $request->otp) {
                        $otp->delete();
                        $user = new User;
                        $user->uuid = Str::uuid();
                        $user->full_name = $request->full_name;
                        $user->email = $request->email;
                        if ($request->dob) {
                            $user->dob = $request->dob;
                        }
                        if ($request->gender) {
                            $user->gender = $request->gender;
                        }
                        if ($request->has('category_id')) {
                            $user->category_id = $request->category_id;
                        }
                        // if (json_encode($request['category_id'])) {
                        //     $user->category_id = json_encode($request['category_id']);
                        // }
                        // if ($request->category_id) {
                        //     $user->category_id = json_encode($request->category_id);
                        // }
                        $user->is_email_verified = 1;
                        $user->password = bcrypt($request->password);
                        $user->save();

                        // REGISTER DEVICE TOKEN
                        UserDevice::createOrUpdateDevice($user->id, $request);

                        $userData = User::find($user->id);
                        $token = $user->createToken(env('APP_NAME', 'BeHere'))->accessToken;
                        DB::commit();

                        $this->status = true;
                        $this->message = "You have registered successfully.";
                        $this->data = $userData;
                        $this->token = $token;
                    } else {
                        $this->message = "Verification Code is invalid.";
                    }
                } else {
                    $this->message = "Verification code not exist.";
                }

            } catch (\Exception $e) {
                DB::rollback();

                $this->message = trans('api_user.somewrong');
                errorApiLog($e->getMessage() . ' at ' . $e->getLine(), $request);
            }
        }
        $this->response();
    }

    public function socialLogin(Request $request)
    {
        $messages = [
            'email.email' => 'Please enter a valid email address.',
        ];
        $rules = [
            'social_id' => 'required',
            'social_type' => 'required',
            'email' => 'nullable|email:rfc,dns|max:255',
            'device_type' => 'required|in:ANDROID,IOS',
            'device_token' => 'required',
            'device_unique_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $this->message = $validator->errors()->first();
        } else {
            DB::beginTransaction();
            try {

                $user = User::where(['social_id' => $request->social_id, 'social_type' => $request->social_type])->first();

                if (empty($user)) {
                    $user = User::where('email', $request->email)->first();
                    if (empty($user)) {
                        $user = new User;
                        $user->uuid = Str::uuid();
                    }
                } else {
                    $user->is_social = 1;
                }

                if ($request->full_name) {
                    $user->full_name = $request->full_name;
                }

                if ($request->mobile_number) {
                    $user->mobile_number = $request->mobile_number;
                }

                if ($request->country_code) {
                    $user->country_code = $request->country_code;
                }

                if ($request->email) {
                    $user->email = $request->email;
                }

                if ($request->profile_picture) {
                    // $profile = UserProfileImage::where('order_id', 1)->where('user_id', $user->id)->count();

                    // if ($profile == 0) {
                    $image = file_get_contents($request->profile_picture);
                    $fileNameExt = time();
                    $imagePath = $fileNameExt . '.jpg';
                    $imageName = 'admin_assets/uploads/user/' . $imagePath;
                    $imagePath = '/admin_assets/uploads/user/' . $imagePath;
                    $s = file_put_contents(public_path() . $imagePath, $image);
                    $user->profile_image = $imagePath;
                    // UserProfileImage::firstOrcreate(['user_id' => $user->id, 'profile_image' => $imageName, 'order_id' => 1]);
                    // }

                }

                $user->social_id = $request->social_id;
                $user->social_type = $request->social_type;
                // $user->is_login = 1;
                $user->save();

                if (Auth::loginUsingId($user->id)) {
                    // REGISTER DEVICE TOKEN
                    UserDevice::createOrUpdateDevice($user->id, $request);
                    DB::table('oauth_access_tokens')->where('user_id', $user->id)->delete();
                    $token = $user->createToken(env('APP_NAME', 'BeHere'))->accessToken;
                    $userData = User::find($user->id);
                    $it = ItineraryGroup::where('user_id', $user->id)->get();
                    if (count($it) > 0) {
                        $userData->itinerary = true;
                        $this->status = true;
                        $this->message = "Logged in successfully.";
                        $this->data = $userData;
                        $this->token = $token;
                    } else {
                        $userData->itinerary = false;
                        $this->status = true;
                        $this->message = "Logged in successfully.";
                        $this->data = $userData;
                        $this->token = $token;
                    }
                } else {
                    $this->message = trans('api_user.login.error');
                }

                // REGISTER DEVICE TOKEN
                UserDevice::createOrUpdateDevice($user->id, $request);

                DB::commit();

            } catch (\Exception $e) {

                DB::rollback();
                $this->message = trans('api_user.somewrong');
                errorApiLog($e->getMessage() . ' at ' . $e->getLine(), $request);
            }
        }
        $this->response();
    }

    public function login(Request $request)
    {
        $input = $request->all();
        $messages = [
            'email.email' => 'Please enter a valid email address.',
        ];
        $rules = [

            'email' => 'required|email:rfc,dns|max:255',
            'password' => 'required',
            'device_type' => 'required|in:ANDROID,IOS',
            'device_token' => 'required',
            'device_unique_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($this->validate($validator)) {
            $user = User::where('email', $request->email)->first();
            if ($user && $user->status == "0") {
                $this->message = __('Your account is deactivated from administrator.');
                $this->response();
            }

            if (empty($user)) {
                $this->message = __('You are not registered with us.');
                $this->response();
            } else if (Hash::check($request->password, $user->password)) {
                // REGISTER DEVICE TOKEN
                User::where('id', $user->id);
                UserDevice::createOrUpdateDevice($user->id, $request);
                DB::table('oauth_access_tokens')->where('user_id', $user->id)->delete();
                $token = $user->createToken(env('APP_NAME', 'BeHere'))->accessToken;
                $this->status = true;
                $this->message = trans('api_user.login.success');
                $this->data = $user;
                $this->token = $token;

            } else {
                $this->message = trans('api_user.login.error');
            }
        }
        $this->response();
    }

    public function getUserData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);
        if (!$this->validate($validator)) {
            return $this->response();
        }
        try {
            $user = User::where('id', $request->user_id)->where('role_id', 3)->first();
            if (!empty($user)) {
                $this->status = "true";
                $this->message = trans('api_user.get_data');
                $this->data = $user;
            } else {
                $this->status = "false";
                $this->message = trans('api_user.NoUserFound');
                $this->data = [];
            }
        } catch (\Exception $ex) {
            $this->status = "false";
            $this->message = trans('api_user.somewrong');
            $this->data = [];
            errorApiLog($ex->getMessage() . ' at ' . $ex->getLine(), $request);
        }
        $this->response();
    }

    public function getProfile(Request $request)
    {
        try {
            if ($request->user_id) {
                $uId = $request->user_id;
            } else {
                $uId = Auth::user()->id;
                if ($request->user_lat && $request->user_long) {
                    User::where('id', $uId)->update(['user_lat' => $request->user_lat, 'user_long' => $request->user_long]);
                }
            }
            $userData = User::find($uId);

            if (!empty($userData) && $userData->status == '0') {
                $this->status = 404;
                $this->user_status = false;
                $this->message = trans('api_user.user_status_pending');
            } elseif (!empty($userData) && $userData->status == '2') {
                $this->status = 404;
                $this->user_status = false;
                $this->message = trans('api_user.user_status_inactive');
            } else {
                $it = ItineraryGroup::where('user_id', $uId)->get();
                if (count($it) > 0) {
                    $userData->itinerary = true;
                    $this->status = "true";
                    $this->message = trans('api_user.get_data');
                    $this->data = $userData;
                } else {
                    $userData->itinerary = false;
                    $this->status = "true";
                    $this->message = trans('api_user.get_data');
                    $this->data = $userData;
                }
            }
        } catch (\Exception $ex) {
            $this->status = "false";
            $this->message = trans('api_user.somewrong');
            $this->data = [];
            errorApiLog($ex->getMessage() . ' at ' . $ex->getLine(), $request);
        }
        $this->response();
    }

    public function forgotPassword(Request $request)
    {
        $messages = [
            'email.email' => 'Please enter a valid email address.',
        ];
        $rules = [
            'email' => 'required|email:rfc,dns',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($this->validate($validator)) {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                UserOtp::where('email', $request->email)->delete();

                // $otp = rand(100000, 999999);
                $otp = "123456";
                UserOtp::create([
                    'email' => $request->email,
                    'otp' => $otp,
                ]);

                $data = ['otp' => $otp, 'preferred_name' => $user->user_name];
                $email_subject = 'Reset Your Password';
                $mail = Mail::send('emails.forgetPass', $data, function ($message) use ($email_subject, $user) {
                    $message->to($user->email, env('APP_NAME'))->subject($email_subject);
                });

                $this->status = 'true';
                $this->message = 'Forgot password verification code has been sent.';
                $this->data = [];
            } else {
                $this->message = trans('api_user.NoUserFound');
            }
        }
        $this->response();
    }

    public function otpVerify(Request $request)
    {
        try {
            $rules = [
                'email' => 'required|email:rfc,dns|max:255',
            ];
            $messages = [
                'email.email' => 'Please enter a valid email address.',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($this->validate($validator)) {
                $user = User::where('email', $request->email)->first();
                $otpCheck = UserOtp::where('otp', $request->otp)->where('email', $request->email)->first();
                if ($otpCheck) {
                    $otpCheck->delete();

                    if ($user) {
                        User::where('id', $user->id)->update(['is_email_verified' => 1]);
                    }
                    $this->status = 'true';
                    $this->message = __('Verification code verified successfully.');
                    $this->data = $user;
                } else {
                    $this->message = __('Invalid Verification Code.');
                }
            }

        } catch (\Exception $e) {
            $this->message = trans('api_user.somewrong');
            errorApiLog($e->getMessage() . ' at ' . $e->getLine(), $request);
        }

        $this->response();
    }

    public function resetPassword(Request $request)
    {

        try {
            $rules = [
                'password' => 'required|min:8|max:15|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                'confirm_password' => 'required|required_with:password|same:password|min:8|max:15',
                'email' => 'required|email:rfc,dns',
            ];
            $messages = [
                'email.email' => 'Please enter a valid email address.',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($this->validate($validator)) {
                $user = User::where('email', $request->email)->first();
                if (!empty($user)) {
                    $user->password = Hash::make($request->confirm_password);
                    $user->save();
                    $data = ['email' => $request->email, 'preferred_name' => $user->user_name];
                    $email_subject = 'Password updated successfully';
                    $mail = Mail::send('emails.password-generated-success', $data, function ($message) use ($email_subject, $data) {
                        $message->to($data['email'], env('APP_NAME'))->subject($email_subject);
                    });
                    $this->status = 'true';
                    $this->message = __('Password updated successfully.');
                    $this->data = [];

                } else {
                    $this->message = __('User not found.');
                }

            }

        } catch (\Exception $e) {
            $this->message = trans('api_user.somewrong');
            errorApiLog($e->getMessage() . ' at ' . $e->getLine(), $request);
        }

        $this->response();
    }

    public function settings(Request $request)
    {
        try {

            $this->status = 'true';
            $this->message = __('Settings list.');
            // $this->data = $data;

        } catch (\Exception $e) {
            $this->message = trans('api_user.somewrong');
            errorApiLog($e->getMessage() . ' at ' . $e->getLine(), $request);
        }

        $this->response();
    }

    public function editProfile(Request $request)
    {
        try {
            $rules = [
                'full_name' => 'max:50',
                'email' => 'email:rfc,dns|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
                'gender' => 'in:Male,Female,Non binary,Prefer not to say',

            ];
            $validator = Validator::make($request->all(), $rules);
            if ($this->validate($validator)) {
                $userData = User::find(Auth::user()->id);
                if ($userData) {
                    $input = $request->all();
                    if ($request->has('full_name')) {
                        $userData->full_name = $request->full_name;
                    }
                    if ($request->has('email')) {
                        $userData->email = $request->email;
                    }
                    if ($request->has('category_id')) {
                        $userData->category_id = $request->category_id;
                    }
                    if ($request->has('country_code')) {
                        $userData->country_code = $request->country_code;
                    }
                    if ($request->has('mobile_number')) {
                        $userData->mobile_number = $request->mobile_number;
                    }
                    if ($request->has('gender')) {
                        $userData->gender = $request->gender;
                    }
                    if ($request->has('dob')) {
                        $userData->dob = date('Y-m-d', strtotime($request->dob));
                    }
                    if ($request->has('profile_image')) {
                        $destination = 'public/' . $userData->profile_image;
                        if (File::Exists($destination)) {
                            File::delete($destination);
                        }
                        $image = $request->profile_image;
                        $png_url = "behere-" . rand() . '.' . $image->extension();
                        $image->move(public_path('profile_image/users/'), $png_url);
                        $mediaName = 'profile_image/users/' . $png_url;
                        $userData->profile_image = $mediaName;
                    }
                    if ($request->has('user_lat')) {
                        $userData->user_lat = $request->user_lat;
                    }
                    if ($request->has('user_long')) {
                        $userData->user_long = $request->user_long;
                    }
                    if ($request->has('user_add')) {
                        $userData->address = $request->user_add;
                    }

                    $userData->save();
                    $userData = User::find(Auth::user()->id);
                    $this->status = 'true';
                    $this->message = __('Your profile has been updated successfully.');
                    $this->data = $userData;
                }

            }

        } catch (\Exception $e) {
            $this->message = trans('api_user.somewrong');
            errorApiLog($e->getMessage() . ' at ' . $e->getLine(), $request);
        }

        $this->response();
    }

    public function logout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'device_type' => 'required|in:ANDROID,IOS',
            //'device_token' => 'required',
            'device_unique_id' => 'required',
        ]);
        if ($validator->fails()) {
            $this->status = false;
            $this->message = $validator->errors()->first();
        } else {
            try {
                $student_id = Auth::user()->id;
                $student = UserDevice::where(['user_id' => $student_id, 'device_type' => $request->device_type, 'device_token' => $request->device_token, 'device_unique_id' => $request->device_unique_id])->first();

                if (!empty($student)) {
                    $student->delete();
                    $this->status = true;
                    $this->message = 'Logout successfully.';
                } else {
                    $this->status = true;
                    $this->message = 'Logout successfully.';
                }
                $user = Auth::user()->token();
                $user->revoke();
            } catch (\Exception $e) {
                $this->status = false;
                $this->message = trans('api_user.somewrong');
                errorApiLog($e->getMessage() . ' at ' . $e->getLine(), $request);
            }
        }

        $this->response();
    }

    public function changePassword(Request $request)
    {
        $messages = [
            'confirm_password.same' => ' New password and confirm password fields value must be matched',
            'new_password.regex' => 'Password should have one capital and small letter, 1 number and a special character.',
        ];
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'min:8|max:15|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'confirm_password' => 'required|same:new_password|min:8|max:15',
        ], $messages);
        if ($validator->fails()) {
            $this->status = false;
            $this->message = $validator->errors()->first();
        } else {
            try {
                $user_id = Auth::user()->id;
                $user = User::where('id', $user_id)->first();
                if (!empty($user)) {
                    if ($request->old_password == $request->new_password) {
                        $this->status = false;
                        $this->message = 'Old password and new password cannot be same!';

                    } else if (Hash::check($request->old_password, $user->password)) {
                        if (Hash::check($request->new_password, $user->password)) {
                            $this->status = false;
                            $this->message = 'Old password and new password cannot be same.';
                        } else {
                            $user->password = bcrypt($request->new_password);
                            $user->save();
                            $this->status = true;
                            $this->message = 'Password updated successfully.';
                            $this->data = $user;
                        }
                    } else {
                        $this->status = false;
                        $this->message = 'Old password not correct.';
                    }

                } else {
                    $this->status = false;
                    $this->message = 'Data not found.';
                }
            } catch (\Exception $e) {
                $this->status = false;
                $this->message = trans('api_user.somewrong');
                errorApiLog($e->getMessage() . ' at ' . $e->getLine(), $request);
            }
        }
        $this->response();
    }

    public function deleteAccount(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                // 'reason' => 'required',
                'device_type' => 'required|in:ANDROID,IOS',
                //'device_token' => 'required',
                'device_unique_id' => 'required',
            ]);
            if ($validator->fails()) {
                $this->status = false;
                $this->message = $validator->errors()->first();
            } else {
                $uId = Auth::user()->id;
                $user = User::find($uId);
                UserDevice::where('user_id', $uId)->delete();

                if (!empty($user)) {
                    // $user->reason = $request->reason;
                    $user->status = "0";
                    $user->save();
                    $user->delete();

                    $this->status = true;
                    $this->message = 'Account deleted! We hope to see you again.';
                } else {
                    $this->status = false;
                    $this->message = 'User not found.';
                }
            }

        } catch (\Exception $e) {
            $this->status = false;
            $this->message = trans('api_user.somewrong');
            errorApiLog($e->getMessage() . ' at ' . $e->getLine(), $request);
        }
        $this->response();
    }

    public function appSetting(Request $request)
    {
        try {
            $appSetting = AppVersion::find(1);

            $this->status = true;
            $this->code = 200;
            $this->message = "App Settings.";
            $this->data = $appSetting;
        } catch (\Exception $e) {

            DB::rollback();
            $this->code = $e->getCode();
            $this->message = trans('api_user.somewrong');
            errorApiLog($e->getMessage() . ' at ' . $e->getLine(), $request);
        }
        $this->response();
    }

  

    public function updateDeviceToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'device_token' => 'required',
        ]);
        if ($validator->fails()) {
            $this->status = false;
            $this->message = $validator->errors()->first();
        } else {
            try {
                $student_id = Auth::user()->id;
                $student_device = UserDevice::where(['user_id' => $student_id])->first();

                $student_device->device_token = $request->device_token;
                $student_device->save();

                $this->status = true;
                //$this->code = 200;
                $this->message = "User device token updated successfully.";
                $this->data = $student_device;
            } catch (\Exception $e) {

                $this->status = false;
                $this->message = trans('api_user.somewrong');
                errorApiLog($e->getMessage() . ' at ' . $e->getLine(), $request);
            }
        }
        $this->response();
    }

   
   

   
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ForgotPassword;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mail;
use Session;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role_id == '1' || Auth::user()->role_id == '2') {
            $monday = strtotime('next Monday -1 week');
            $monday = date('w', $monday) == date('w') ? $monday + 7 * 86400 : $monday;
            $sunday = strtotime(date("Y-m-d", $monday) . " +6 days");
            $monthFirst = date('Y-m-d', strtotime('first day of this month'));
            $monthSec = date('Y-m-d', strtotime('last day of this month'));
            $yearFirst = date("Y-m-d", strtotime("January 1st"));
            $yearSec = date("Y-m-d", strtotime("December 31st"));
            $today_users = User::where('role_id', 3)->whereStatus('1')->whereDate('created_at', date("Y-m-d"))->count();
            $weekly_users = User::where('role_id', 3)->whereStatus('1')->whereBetween('created_at', [date("Y-m-d", $monday), date("Y-m-d", $sunday)])->count();
            $monthly_users = User::where('role_id', 3)->whereStatus('1')->whereBetween('created_at', [$monthFirst, $monthSec])->count();
            $yearly_users = User::where('role_id', 3)->whereStatus('1')->whereBetween('created_at', [$yearFirst, $yearSec])->count();            
            $total_users = User::where('role_id', 2)->whereStatus('1')->count();
         

            $data = [
                'weekly_users' => $weekly_users,
                'monthly_users' => $monthly_users,
                'yearly_users' => $yearly_users,
                'total_users' => $total_users,
            ];

            return view('admin/dashboard', compact('data'));
        } else {
            return view('admin/commingSoon');
        }
    }
    public function myProfile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $data = ['title' => 'My Profile', 'user' => $user];
        return view('admin.dashboard.my-profile', compact('data', 'user'));
    }
    public function editProfile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $data = ['title' => 'Edit Profile', 'user' => $user];
        return view('admin.dashboard.edit-profile', compact('data', 'user'));
    }
    public function editProfilePost(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $credentials = request()->validate([
            'name' => 'required|regex:/^[a-zA-Z_ ]+$/u|max:20|min:3',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'profile_pic' => 'nullable|mimes:jpeg,png,jpg,gif',
        ]);
        $image = $request->profile_pic;
        if ($request->hasFile('profile_pic') && $request->profile_pic->isValid()) {
            $png_url = "love" . rand() . '.' . $image->extension();
            $image->move(public_path('img/admin/'), $png_url);
            $mediaName = 'img/admin/' . $png_url;
            $user->profile_image = $mediaName;
            // $image_array  =  image_upload($request->profile_pic,"uploads/images",'public');
            // $user->profile_image = str_replace("app/public/","app/public/",$image_array[1]);

        }
        $user->first_name = ucwords($request->name);
        $user->email = $request->email;
        $user->save();
        return redirect()->route('admin.dashboard')->with('message', 'Profile updated successfully.');
    }
    public function changePassword()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $data = ['title' => 'Change Password', 'user' => $user];
        return view('admin.dashboard.change-password', compact('data'));
    }
    public function changePasswordPost(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $request->validate([
            'current_password' => 'required',

            'new_password' => 'required|min:8|max:25|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',

            'Confirm_Password' => 'same:new_password',

        ],
            [
                'new_password.regex' => 'At least 8 Characters, One uppercase, One Lower Case, One special Character, and One Number.',
            ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error_message', 'Current password does not match.');
        } else {
            if (!Hash::check($request->new_password, $user->password) != $user->password) {
                return back()->with('error_messages', 'New password is already taken.');
            } else {

                User::find($user->id)->update(['password' => Hash::make($request->new_password)]);
                // Auth::logoutOtherDevices();
                return redirect()->route('admin.dashboard')->with('message', 'Password successfully changed.');}
        }
    }
    public function forgetPassword()
    {
        return view('admin.dashboard.forget-email');
    }
    public function resetPassLinkSentAdmin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        try {
            $user = User::where('email', $request->email)->where('role_id', 1)->first();
            if (!empty($user)) {
                ForgotPassword::where('email', $request->email)->delete();
                $forgetPass = new ForgotPassword;
                $forgetPass->email = $request->email;
                $forgetPass->save();
                $en_email = encrypt($request->email);
                $link = route('adminPasswordSet', ['email' => $en_email]);
                $data = ['email' => $request->email, 'preferred_name' => $user->user_name, 'link' => $link];
                $email_subject = 'Reset Your Password';
                $mail = Mail::send('emails.email_forgetPass', $data, function ($message) use ($email_subject, $data) {
                    $message->to($data['email'], env('APP_NAME'))->subject($email_subject);
                });
                return redirect()->route('admin.login')->with('success', 'Reset password link is sent to your email address. Please check your email');
            } else {
                session()->flash('errMsg', 'This email address is not registered');
                return redirect()->back()->with('errMsg', 'This email address is not registered');
            }
        } catch (\Exception $e) {

            return redirect()->back()->with('errMsg', $e->getMessage());
        }
    }
    public function adminPasswordSet(Request $request, $email)
    {
        $email = decrypt($email);
        $forget = ForgotPassword::where('email', $email)->first();
        if (!empty($forget)) {
            return view('admin.dashboard.change-pass', compact('email'));
        } else {
            $msg = "Your link has expired";
            return view('emails.email-verification-web-page', compact('msg'));
        }
    }

    public function adminSetPassWord(Request $request)
    {
        $request->validate([
            'new_password' => 'required|required_with:confirm_password|same:confirm_password|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'confirm_password' => 'required',
        ],
            [
                'new_password.regex' => 'At least 8 Characters, One uppercase, One Lower Case, One special Character, and One Number.',
            ]);
        try {
            $user = User::where('email', $request->email)->first();
            $email = $request->email;
            if (!empty($user)) {
                $user->password = Hash::make($request->confirm_password);
                $user->save();
                $data = ['email' => $request->email, 'preferred_name' => $user->user_name];
                $email_subject = 'Password generated Successfully';
                $mail = Mail::send('emails.password-generated-success', $data, function ($message) use ($email_subject, $data) {
                    $message->to($data['email'], env('APP_NAME'))->subject($email_subject);
                });
                $forget = ForgotPassword::where('email', $email)->delete();
                return redirect()->route('admin.login')->with('success', 'Password generated Successfully');
            } else {
                return redirect()->back()->with('errMsg', 'User Not Found');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('errMsg', $e->getMessage());
        }
    }
    public function adminLogin(Request $request)
    {
        if (Auth::user() != '') {
            return redirect()->route('admin.dashboard');
        } else {
            return view('auth/login');
        }

    }

    public function login(request $request)
    {

        $validator = Validator::make($request->all(), ['email' => 'required|email|exists:users,email']);

        if ($validator->fails()) {
            return redirect()->back()->with('email', 'Email is incorrect. ')->withInput($request->all());
        } else {
            $user = User::where('email', $request->email)->first();
            $verifyCheck = $user->is_email_verified;
            if ($verifyCheck != null) {
                if ($user->role_id == 1 || $user->role_id == 2) {
                    if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {

                        return redirect()->route('admin.dashboard');
                    } else {
                        return redirect()->back()->with('password', 'Password is incorrect. ')->withInput($request->all());
                    }
                } else {
                    return redirect()->back()->with('email', 'Client cannot access to admin panel. ')->withInput($request->all());
                }
            } else {
                return redirect()->back()->with('errMsg', 'Your email is not verify. ')->withInput($request->all());
            }
        }

    }

}

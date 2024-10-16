<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET,HEAD,OPTIONS,POST,PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers, Authorization, X-CSRF-Token');
header('Access-Control-Allow-Credentials: true');

use App\Http\Controllers\Api\ApiContentController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::post('app-setting', [UserController::class, 'appSetting']);
Route::post('check-user', [UserController::class, 'checkUser']);
Route::post('send-otp-email', [UserController::class, 'sendOtpEmail']);
Route::post('resend-otp', [UserController::class, 'resendOtp']);
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::post('social-login', [UserController::class, 'socialLogin']);
Route::post('forgot-password', [UserController::class, 'forgotPassword']);
Route::post('otp-verify', [UserController::class, 'otpVerify']);
Route::Post('reset-password', [UserController::class, 'resetPassword']);
Route::post('settings', [UserController::class, 'settings']);






<?php

use App\Http\Controllers\Admin\CandidateController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RelevantCategoryController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\DashboarddController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\SubscriptionController;
use App\Http\Controllers\Admin\PageContentController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
Route::get('/lang-change', function () {
    \Session::put('lang-type', request('lang'));
    return back();
})->name('lange-change');
Route::get('verify/{email_verified_at}', [UserController::class, 'verifyUser'])->name('verifyUser');
Route::get('/admin/login', [DashboardController::class, 'adminLogin'])->name('admin.login');
Route::get('/admin-login', [DashboardController::class, 'adminLogin'])->name('admin.login');
Route::post('/admin-login', [DashboardController::class, 'Login'])->name('admin.loginn');
Route::get('home', [FrontendController::class, 'index'])->name('home');
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/forget-password', [DashboardController::class, 'forgetPassword'])->name('forget-password');
Route::post('/resetPassLinkSentAdmin', [DashboardController::class, 'resetPassLinkSentAdmin'])->name('resetPassLinkSentAdmin');
Route::get('adminPasswordSet/{email?}', [DashboardController::class, 'adminPasswordSet'])->name('adminPasswordSet');
Route::Post('adminSetPassWord', [DashboardController::class, 'adminSetPassWord'])->name('adminSetPassWord');
Auth::routes();
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin', 'Apis']], function ($request) {
    /* Start App Version */


    /* End App Version */
    /* admin */
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); 
    Route::get('my-profile', [DashboardController::class, 'myProfile'])->name('my.profile');
    Route::get('edit-profile', [DashboardController::class, 'editProfile'])->name('edit.profile');
    Route::post('edit-profile', [DashboardController::class, 'editProfilePost'])->name('edit.profile.post');
    Route::get('change-password', [DashboardController::class, 'changePassword'])->name('change.password');
    Route::post('change-password', [DashboardController::class, 'changePasswordPost'])->name('change.password.post');
    Route::post('dashboard/date-filter', [DashboardController::class, 'dateFilter'])->name('dashboard.date-filter');

    /* end  admin */
    /* user management */
    Route::post('user/update-mobile', [UserController::class, 'update'])->name('user.update-mobile');
    Route::get('user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
    Route::get('user/delete-mobile/{id}', [UserController::class, 'destroy'])->name('user.delete-mobile');
    Route::get('user/update_status', [UserController::class, 'updateStatus'])->name('user.status');
    Route::get('user/export', [UserController::class, 'newexport'])->name('user.export');
    Route::resource('user', UserController::class);
     /* Candidate management */
     Route::post('candidate/update-mobile', [CandidateController::class, 'update'])->name('candidate.update-mobile');
     Route::get('candidate/delete/{id}', [CandidateController::class, 'destroy'])->name('candidate.delete');
     Route::get('candidate/delete-mobile/{id}', [CandidateController::class, 'destroy'])->name('candidate.delete-mobile');
     Route::get('candidate/update_status', [CandidateController::class, 'updateStatus'])->name('candidate.status');
     Route::get('candidate/export', [CandidateController::class, 'newexport'])->name('candidate.export');
     Route::resource('candidate', CandidateController::class);
    /*cms*/
    //Route::get('cms/update_status', [CmsController::class, 'updateStatus'])->name('cms.status');
    Route::resource('cms', CmsController::class);
    /*Category*/
    Route::get('category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
    Route::get('category/update_status', [CategoryController::class, 'updateStatus'])->name('category.status');
    Route::resource('category', CategoryController::class);
   
    /*sub category*/
    Route::get('subCategory/delete/{id}', [SubCategoryController::class, 'destroy'])->name('subCategory.delete');
    Route::get('subCategory/update_status', [SubCategoryController::class, 'updateStatus'])->name('subCategory.status');
    Route::resource('subCategory', SubCategoryController::class);
    /*Country*/
    Route::get('country/delete/{id}', [CountryController::class, 'destroy'])->name('country.delete');
    Route::get('country/update_status', [CountryController::class, 'updateStatus'])->name('country.status');
    Route::resource('country', CountryController::class);
    /*State*/
    Route::get('state/delete/{id}', [StateController::class, 'destroy'])->name('state.delete');
    Route::get('state/update_status', [StateController::class, 'updateStatus'])->name('state.status');
    Route::resource('state', StateController::class);
    /*City*/
    Route::get('city/delete/{id}', [CityController::class, 'destroy'])->name('city.delete');
    Route::get('city/update_status', [CityController::class, 'updateStatus'])->name('city.status');
    Route::resource('city', CityController::class);
    // plan
    Route::get('transaction/delete/{id}', [TransactionController::class, 'destroy'])->name('transaction.delete');
    Route::resource('transaction', TransactionController::class);
    Route::any('/subscription-cancel', [TransactionController::class, 'subcriptionCancel'])->name('subcriptionCancel');
    Route::any('/subscription-success', [TransactionController::class, 'subcriptionSuccess'])->name('subcriptionSuccess');

});
Route::post('city/fetch-cities', [CityController::class, 'fetchCity']);
Route::post('state/fetch-states', [CityController::class, 'fetchState']);

// user
Route::get('/signup', [FrontendController::class, 'registerPage'])->name('registerView');
Route::post('/register-user', [FrontendController::class, 'register'])->name('registerUser');
Route::get('/verification/{email}', [FrontendController::class, 'verificationPage'])->name('verificationPage');
Route::post('/verification-check', [FrontendController::class, 'verification'])->name('verification');
// Route::get('/signin', [FrontendController::class, 'signinPage'])->name('signinView');
Route::post('/signinn', [FrontendController::class, 'signin'])->name('signin');

Route::get('/ForgotPassword', [FrontendController::class, 'forgetPassword'])->name('forgetPassword');
Route::post('/resetPassLinkSent', [FrontendController::class, 'resetPassLinkSent'])->name('ResetPassLinkSent');
Route::get('/passwordSet/{email?}', [FrontendController::class, 'PasswordSet'])->name('PasswordSet');
Route::Post('/setPassWord', [FrontendController::class, 'SetPassWord'])->name('SetPassWord');
Route::get('logout', [FrontendController::class, 'logout'])->name('logout');
Route::Post('/get-in-touch', [FrontendController::class, 'get_in_touch'])->name('getintouch');
Route::get('/term&condition', [FrontendController::class, 'termCondition'])->name('term&condition');

Route::group(['prefix' => 'client', 'as' => 'client.', 'middleware' => ['auth:client', 'web', 'status']], function ($request) {
    Route::resource('/dashboard', DashboarddController::class);
    Route::get('edit-profile', [DashboarddController::class, 'editProfile'])->name('edit.profile');
    Route::post('edit-profile', [DashboarddController::class, 'editProfilePost'])->name('edit.profile.post');
    Route::post('/update-profile-image', [DashboarddController::class, 'updateProfileImage'])->name('update.profileImage');
    Route::get('IdentityVerification', [DashboarddController::class, 'IdentityVerificationView'])->name('IdentityVerificationView');
    Route::Post('IdentityVerification-post', [DashboarddController::class, 'IdentityVerification'])->name('IdentityVerification');
    Route::get('election', [DashboarddController::class, 'electionView'])->name('electionView');
    Route::Post('election-post', [DashboarddController::class, 'election'])->name('election');
    Route::get('projection', [DashboarddController::class, 'projectionView'])->name('projectionView');
    Route::Post('projection-post', [DashboarddController::class, 'projection'])->name('projection');
    Route::get('election-Auditing', [DashboarddController::class, 'electionAuditingView'])->name('electionAuditingView');
    Route::Post('election-Auditing-post', [DashboarddController::class, 'electionAuditing'])->name('electionAuditing');

    Route::get('local/{value}', [DashboarddController::class, 'localView'])->name('localView');
    Route::Post('local-post', [DashboarddController::class, 'local'])->name('local');
    Route::get('federal', [DashboarddController::class, 'federalView'])->name('federalView');
    Route::Post('federal-post', [DashboarddController::class, 'federal'])->name('federal');
    Route::get('state{value}', [DashboarddController::class, 'stateView'])->name('stateView');
    Route::Post('state-post', [DashboarddController::class, 'state'])->name('state');
    Route::post('/submit-state', [DashboarddController::class, 'submitState'])->name('submitState');
    Route::post('/submit-local', [DashboarddController::class, 'submitLocal'])->name('submitlocal');


    

    Route::post('change-password', [DashboarddController::class, 'changePasswordPost'])->name('change.password.post');
    Route::get('/dashboard/create', [DashboarddController::class, 'detailPage'])->name('details');
    Route::get('/submit/{id}', [DashboarddController::class, 'submitAdmin'])->name('submit');
    Route::resource('/subscription', SubscriptionController::class);
    Route::any('/subscription', [SubscriptionController::class, 'showSubscribe'])->name('showSubscribe');
    Route::any('/subscription-buy', [SubscriptionController::class, 'subscribe'])->name('subscribe');
    Route::put('/subscription/update/{id}', [SubscriptionController::class, 'update'])->name('updateSub');
    Route::any('/subscription-cancel', [SubscriptionController::class, 'subcriptionCancel'])->name('subcriptionCancel'); 
    Route::any('/subscription-success', [SubscriptionController::class, 'subcriptionSuccess'])->name('subcriptionSuccess');
    Route::get('/download/invoice/{id}', [SubscriptionController::class, 'downloadInvoice'])->name('downloadInvoice');

});

Route::any('/idme/callback', [DashboarddController::class, 'documentVerfy'])->name('documentVerfy');

Route::get('/all-cache-clear', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode2 = Artisan::call('route:clear');
    $exitCode3 = Artisan::call('view:clear');
    $exitCode4 = Artisan::call('config:cache');
    $exitCode5 = Artisan::call('config:clear');
    return '<h1>All Cache clear</h1>';
});

<?php

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
// use App\Mail\SupportMailManager;
//demo
use App\Http\Controllers\Front\ConcessionController;
use App\Http\Controllers\Front\StaffController;
use App\Http\Controllers\Front\AizUploadController;

use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\CustomerManagement\SubscriberController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Front\LanguageController;
use App\Http\Controllers\Front\ConversationController;
use App\Http\Controllers\Front\NotificationController;

use App\Http\Controllers\Front\BlogController;

use App\Http\Controllers\Front\PageController;
use App\Http\Controllers\Admin\SettingManagement\OTPVerificationController;
use App\Http\Controllers\Front\ContactUsController;


Route::get('/refresh-csrf', function() {
    return csrf_token();
});
Route::get('/password_request_back', [ForgotPasswordController::class,'showBackLinkRequestForm'])->name('password_request_back');
Route::resource('subscribers', SubscriberController::class,['except' => ['destroy']]);

Route::get('/sitemap.xml', function() {
    return base_path('sitemap.xml');
});
/*===================اعادة التوجيه===================*/

/*===================الصور===================*/
Route::controller(AizUploadController::class)
    ->group(function ($router) {
        Route::post('/aiz-uploader', 'show_uploader');
        Route::post('/aiz-uploader/upload', 'upload');
        Route::get('/aiz-uploader/get_uploaded_files', 'get_uploaded_files');
        Route::post('/aiz-uploader/get_file_by_ids', 'get_preview_files');
        Route::get('/aiz-uploader/download/{id}', 'attachment_download')->name('download_attachment');
    });
/*============================================*/
Route::group(['prefix' =>\Mcamara\LaravelLocalization\Facades\LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function()
{
    Auth::routes(['verify' => true]);
/*===================Auth===================*/
    Route::get('/logout', [LoginController::class,'logout']);
    Route::controller(VerificationController::class)
        ->group(function ($router) {
            Route::get('/email/resend', 'resend')->name('verification.resend');
            Route::get('/verification-confirmation/{code}', 'verification_confirmation')->name('email.verification.confirmation');
        });
/*============================================*/
    /*===================Home===================*/

    Route::controller(HomeController::class)
        ->group(function ($router) {
            Route::get('/email_change/callback', 'email_change_callback')->name('email_change.callback');
            Route::post('/password/reset/email/submit', 'reset_password_with_code')->name('password.update');
            Route::get(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::transRoute('routes.users/login'), 'login')->name('user.login');
            Route::get(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::transRoute('routes.users/registration'), 'registration')->name('user.registration');
            Route::group(['middleware' => ['HtmlMinifier']], function() {
                Route::get('/', 'index')->name('home');

            });
            Route::get('/success/verification', 'successVerification')->name('success_verification');
            Route::get(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::transRoute('routes.policies'),'policiesRecruitment')->name('recruitment.policies');
            Route::get(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::transRoute('routes.musaned'),'musaned')->name('musaned.details');
            Route::get('/selectStaffWhatsapp', 'select_staff_whatsapp')->name('select_staff_whatsapp');
            Route::group(['middleware' => ['user', 'verified', 'unbanned']], function() {
                Route::get('/dashboard', 'dashboard')->name('dashboard');
                Route::get(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::transRoute('routes.profile'), 'profile')->name('profile');
                Route::post('/new-user-verification', 'new_verify')->name('user.new.verify');
                Route::post('/new-user-email', 'update_email')->name('user.change.email');
                Route::post('/customer/update-profile', 'customer_update_profile')->name('customer.profile.update');
            });
        });
    /*============================================*/

    /*===================Language===================*/
    Route::controller(LanguageController::class)
        ->group(function ($router) {
            Route::post('/language', 'changeLanguage')->name('language.change');
            Route::get('/language/to/{local}', 'changeToLanguage')->name('language.to.change');
            Route::get('/language/{local}', 'changeGetLanguage')->name('language.get.change');
        });
    /*============================================*/





    Route::group(['middleware' => ['auth']], function() {
        /*===================Conversation===================*/
        Route::controller(ConversationController::class)
            ->group(function ($router) {
                Route::get('/conversations/destroy/{id}', 'destroy')->name('conversations.destroy');
                Route::post('conversations/refresh', 'refresh')->name('conversations.refresh');
            });
        Route::resource('conversations', ConversationController::class,['except' => ['destroy']]);
        /*======================================*/

        Route::resource('messages', 'MessageController',['except' => ['destroy']]);
        Route::post('res/front/support_ticket', [SupportTicketController::class,'dataFrontSupportTicket'])->name('support_ticket.front_date_res');
        Route::get(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::transRoute('routes.client_index'), [HomeController::class,'clientIndex'])->name('clientIndex');
    });
    /*==================Blog===================*/

//    Route::controller(PageController::class)
//        ->group(function ($router) {
//            Route::get('/{slug}', 'show_custom_page');
//        });

    /*======================================*/
    /*==================Reservation===================*/

    Route::post('/contact_us_send', [ContactUsController::class,'store'])->name('contact_us_send');

    /*======================================*/

});
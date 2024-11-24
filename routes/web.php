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
use App\Http\Controllers\Front\NationalityController;
use App\Http\Controllers\Front\ConcessionController;
use App\Http\Controllers\Front\StaffController;
use App\Http\Controllers\Front\AizUploadController;
use App\Http\Controllers\Front\MaaroufaController;
use App\Http\Controllers\Admin\CvManagement\CVController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\CustomerManagement\SubscriberController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Front\LanguageController;
use App\Http\Controllers\Front\ReservationController;
use App\Http\Controllers\Front\ConversationController;
use App\Http\Controllers\Front\NotificationController;
use App\Http\Controllers\Front\RecruitmentFormController;
use App\Http\Controllers\Front\SupportTicketController;
use App\Http\Controllers\Front\BlogController;
use App\Http\Controllers\Front\TrainingController;
use App\Http\Controllers\Front\JobController;
use App\Http\Controllers\Front\PageController;
use App\Http\Controllers\Admin\SettingManagement\OTPVerificationController;
use App\Http\Controllers\Front\ContactUsController;

Route::get('/maaroufa_service', [MaaroufaController::class,'showServiceDetails'])->name('maaroufa_service');
Route::get('/available_nationalities', [NationalityController::class,'getCountries'])->name('available_nationalities');
Route::get('/ourStaff', [StaffController::class,'ourStaff'])->name('ourStaff');
Route::get('concession', [ConcessionController::class,'indexUserSite'])->name('concession');
Route::get('/load_contract', function(){
    return PDF::loadFile('https://www.v4.rawafdnajd.sa/load_contract_view')->inline('github.pdf');
});
Route::get('/load_contract_view', function(){
    return view('contract_form.form');
});
Route::get('/refresh-csrf', function() {
    return csrf_token();
});
Route::get('/cvs_view/{id}', [CVController::class,'cvs_view'])->name('cvs_view');
Route::get('/password_request_back', [ForgotPasswordController::class,'showBackLinkRequestForm'])->name('password_request_back');
Route::resource('subscribers', SubscriberController::class,['except' => ['destroy']]);

Route::get('/sitemap.xml', function() {
    return base_path('sitemap.xml');
});
/*===================اعادة التوجيه===================*/

Route::get('/support', function(){
    return redirect('/مركز-المساعدة');
});
Route::get('users/login', function(){
    return redirect('/تسجيل-الدخول');
});
Route::get('users/registration', function(){
    return redirect('/حساب-جديد');
});
Route::get('/musaned', function(){
    return redirect('/مساند');
});
Route::get('/policies', function(){
    return redirect('/السياسات-القوانين');
});
Route::get('/blog', function(){
    return redirect('/مقالات');
});
Route::get('/faq', function(){
    return redirect('/الاسئلة-الشائعة');
});
Route::get('/allWorkersCv', function(){
    return redirect('/أستقدام-عاملتك');
});
Route::get('/allSponsorCvs', function(){
    return redirect('/نقل-كفالة');
});
Route::get('/recruitment-contract', function(){
    return redirect('/تعاقد-الاستقدام');
});
Route::get('/arrive-worker', function(){
    return redirect('/وصول-العمالة');
});
Route::get('/all-workers_cv', function(){   return redirect('/أستقدام-عاملتك'); });
Route::get('/all_sponsor_cvs', function(){  return redirect('/نقل-كفالة');});
/*============================================*/
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



    Route::group(['middleware' => ['user', 'verified', 'unbanned']], function() {
        /*===================Reservation===================*/
        Route::controller(ReservationController::class)
            ->group(function ($router) {
                Route::post('/save/reservation','reservation_cv')->name('reservation_cv');
                Route::get('/start/new/reservation/{id}','reservation_new_cv')->name('reservation_new_cv');
                Route::get('/view/reservation/{id}','reservation_details')->name('reservation_details');
                Route::get('/customer-service/{id}', 'select_service')->name('choose_customer_service');
                Route::post('/customer-service/save', 'select_service_save')->name('select_service_save');
                Route::post('/request_transfer_sponsorship/save', 'request_transfer_sponsorship')->name('request_transfer_sponsorship');
                Route::get('/timer/{id}', 'count_timer')->name('count_timer');
                Route::post('/booking.expired', 'booking_expired')->name('booking.expired');
                Route::get('/upload-files', 'uploadFile')->name('reservation.upload_files');
                Route::get('/navigation/Res/{id}', 'navigationResRequest')->name('reservation.navigationRes');
                Route::post('/upload-files', 'uploadStoreFile')->name('reservation.store_upload_files');
                Route::get('/complete/cv/contract',  'completeContract')->name('reservation.complete_contract');
                Route::get('/success-reservation/{id}','successReservation')->name('reservation.successReservation');;
            });

        /*============================================*/
        /*========================Notification==============*/
        Route::controller(NotificationController::class)
            ->group(function ($router) {
                Route::get(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::transRoute('routes.notifications'),'frontend_listing')->name('frontend.notifications');
                Route::post('/update/notifications','update_seen_notfication')->name('update_seen_notfication');
            });
        /*============================================*/
        /*========================Recruitment==============*/
        Route::controller(RecruitmentFormController::class)
            ->group(function ($router) {
                Route::get('/recruitment-request', 'viewRecruitmentForm')->name('recruitment.request');
                Route::post('/recruitment-request', 'saveRecruitmentForm')->name('recruitment.request.save');
            });
        /*============================================*/
        /*===================SupportTicket===================*/

        Route::controller(SupportTicketController::class)
            ->group(function ($router) {
                Route::post('support_ticket/reply', 'seller_store')->name('support_ticket.seller_store');
                Route::post('support_ticket/refresh', 'ticket_refresh')->name('support_ticket.refresh');
            });
        /*============================================*/

        Route::resource('support_ticket', SupportTicketController::class,['except' => ['destroy']]);
        Route::get(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::transRoute('routes.all-requests'), function () {
            return view('frontend.user.booking_log');
        })->name('user.booking_log');
        Route::get(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::transRoute('routes.all-sponsor-requests'), function () {
            return view('frontend.user.sponsor_booking_log');
        })->name('user.sponsor_booking_log');

    });


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
    Route::controller(BlogController::class)
        ->group(function ($router) {
            Route::get(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::transRoute('routes.blog'), 'all_blog')->name('blog');
            Route::get('/blog/{slug}', 'blog_details')->name('blog.details');
            Route::get('/article-details/{id}','article_details')->name('article.details');
            Route::get('/tag','seach')->name('search.tag');
            Route::post('blog/comment/send', 'blog_comment_send')->name('blog_comment_send');
            Route::post('blog/comment/reply', 'blog_comment_reply')->name('blog_comment_reply');
            Route::get('/count_view_blog/{id}', 'CountViewBlog')->name('count_view_blog');
        });

//    Route::controller(PageController::class)
//        ->group(function ($router) {
//            Route::get('/{slug}', 'show_custom_page');
//        });

    /*======================================*/
    /*==================Reservation===================*/

    Route::group(['middleware' => ['HtmlMinifier']], function() {
        Route::controller(ReservationController::class)
            ->group(function ($router) {
        Route::get('/chooseSponsorService', 'chooseSponsorService')->name('chooseSponsorService');
        Route::get(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::transRoute('routes.allWorkersCv'), 'showAllWorkers')->name('all_cvs');
//          Route::get('all-workers/{id?}','showAllWorkers')->name('all-workers');

                Route::get(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::transRoute('routes.allSponsorCvs'), 'showSponsorCvs')->name('allSponsorCvs');
            });
    });
    /*======================================*/

    /*===================view===================*/

    Route::get(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::transRoute('routes.support'), function(){
        return view('frontend.support.get-started');
    })->name('frontend.get-started');
    Route::get(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::transRoute('routes.arrive-worker'), function () {
        return view('frontend.arrive-worker');
    })->name('frontend.arrive-worker');
    Route::get('/select-worker', function () {
        return view('frontend.select-worker');
    })->name('frontend.select-worker');
    Route::get(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::transRoute('routes.recruitment-contract'), function () {
        $minutes = \Carbon\Carbon::now()->addMinutes(60);
        $all_recruitment_steps= \Illuminate\Support\Facades\Cache::remember('recruitment_steps', $minutes, function() {
            return \App\Models\RecruitmentStep::get();
        });
        return view('frontend.recruitment-contract',compact('all_recruitment_steps'));
    })->name('frontend.recruitment-contract');
    Route::get('/client_index-new', function(){
        return view('frontend.client_index-new-edit');
    });
    Route::get('/reviews', function(){
        return view('frontend.reviews');
    });
    Route::get(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::transRoute('routes.jobs'), function(){
        return view('frontend.job.get-started');
    })->name('frontend.job.get-started');
    Route::get(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::transRoute('routes.training'), function(){
        return view('frontend.trainee.get-started');
    })->name('frontend.trainee.get-started');

    Route::get(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::transRoute('routes.faq'), function(){
        return view('frontend.faq');
    })->name('frontend.faq');
    Route::get(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::transRoute('routes.contact-us'), function(){
        return view('frontend.contact-us');
    })->name('frontend.contact-us');
    Route::get('/loadingPage',  function(){
        return view('frontend.loading');
    })->name('loading');
    /*======================================*/

    Route::post('/set_reservation_session', [ReservationController::class,'set_reservation_session'])->name('set_reservation_session');
    Route::get(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::transRoute('routes./common/topics/{id}'),[HomeController::class,'common_topics'])->name('common_topics');
    Route::get('/count_useful_article/{id}', [HomeController::class,'common_useful_topics'])->name('common_useful_topics');
    Route::get('/count_unuseful_article{id}', [HomeController::class,'count_unuseful_article'])->name('count_unuseful_article');
    Route::post('/saveTrainee', [TrainingController::class,'saveTrainee'])->name('saveTrainee');

    Route::post('/saveApplcant', [JobController::class,'saveApplicant'])->name('saveApplicant');

    Route::post('/change/phone', [OTPVerificationController::class,'change_phone'])->name('change.phone');
    Route::post('/contact_us_send', [ContactUsController::class,'store'])->name('contact_us_send');
    Route::get('selectServiceCv', [ReservationController::class,'select_service_cv'])->name('select_service_cv');


});
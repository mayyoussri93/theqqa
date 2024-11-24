<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\Contract;
use App\Models\Customer;
use App\Http\Controllers\SearchController;
use App\Models\CommonTopic;
use App\Models\Cv;
use App\Models\CvPreviousSponsor;
use App\Models\FrequentlyQuestioned;
use App\Models\Note;
use App\Models\Office;
use App\Models\RecruitmentForm;
use App\Models\Reservation;
use App\Models\ReservationSponsor;
use App\Models\Staff;
use App\Utility\NotificationUtility;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Session;
use Auth;
use Hash;
use App\Category;

use App\Models\Brand;
use App\Product;
use App\PickupPoint;
use App\Models\CustomerPackage;

use App\Models\User;
use App\Seller;
use App\Shop;
use App\Color;
use App\Order;
use App\Models\BusinessSetting;
use ImageOptimizer;
use Cookie;
use Illuminate\Support\Str;
use App\Mail\SecondEmailVerifyMailManager;
use Mail;
use App\Utility\TranslationUtility;
use App\Utility\CategoryUtility;
use Illuminate\Auth\Events\PasswordReset;
use Keensoen\CPanelApi\CPanel;



class HomeController extends Controller
{
    public function select_staff_whatsapp()
    {
            $staffs = Staff::where('is_apper', 1)->get();
            return view('frontend.staff_whatsapp', compact('staffs'));
    }

    public function login()
    {
        if(Auth::check()){
            if(auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'staff') {
                return redirect()->route('website.main');
            }else {
                return redirect()->route('clientIndex');
            }
        }
        return view('frontend.user_login');
    }

    public function registration(Request $request)
    {

        if(Auth::check()){
            return redirect()->route('clientIndex');
        }

        if (!auth::check() && !empty($request->staff_name) ) {
            Session::put('staff_id', $request->staff_name);
            Session::put('cv_id', $request->cv_id);


        }elseif (!auth::check() && !empty($request->sponsor_staff_name)){
            Session::put('sponsor_staff_name', $request->sponsor_staff_name);
            Session::put('sponsor_contract_id', $request->sponsor_contract_id);
        }

        return view('frontend.user_registration');
    }

    /**
     * Show the customer/seller dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        if(Auth::user()->user_type == 'customer'){
            return view('frontend.user.customer.dashboard');
        }

        else {
            abort(404);
        }
    }

    public function profile(Request $request)
    {
        if(Auth::user()->user_type == 'customer'){
            return view('frontend.user.profile');
        }

    }
    public function successVerification()
    {
        $rediret_url='/';

        if(!empty(Session::get('cv_id'))){
            $cvs = Cv::find(Session::get('cv_id'));
            Session::forget('cv_id');

//            $check_res = Reservation::where('user_id', Auth::user()->id)->status( '!=', 6)->count();
            $check_count_reservation = Reservation::where('user_id', auth::user()->id)->whereNull('deleted_at')->count();
            $check_count_reservation_status = Reservation::where('user_id', auth::user()->id)->whereNull('deleted_at')->whereIn('status',[1,2,3])->count();
            if($check_count_reservation_status < 1) {
                if ($cvs->is_booking != 1 && $check_count_reservation < 5) {
//                && $check_res == 0
                    $res = new Reservation();
                    $res->user_id = Auth::user()->id;
                    $res->cv_id = $cvs->id;
                    $res->status = 2;
                    $res->code = env('ALPA_KEY') . $cvs->nationality->key_code . date('Ymd') . rand(10, 99);
                    $res->save();
                    $cvs->is_booking = 1;
                    $cvs->save();
                    NotificationUtility::set_notification(
                        "new_booking_cv",
                        "قام هذا العميل بطلب حجز لهذة السيرة الذاتيه رقم الحجز " . $res->code,
                        route('booking_cv_request.view', ['id' => $res->id]),
                        0,
                        Auth::user()->id,
                        'admin',
                        $res->id
                    );
                    $rediret_url = "/customer-service/" . $res->id;


                }
            }

        }
        return view('otp_systems.frontend.phone_confirm',compact('rediret_url'));

    }

    /**
     * Show the application frontend home.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slider_images = json_decode(get_setting('home_slider_images'), true);
        $expiresAt = \Carbon\Carbon::now()->addMinutes(60);
        Cache::put('home_slider_images', $slider_images, $expiresAt);
        $slider_images=Cache::get('home_slider_images');

        $banner_2_imags = json_decode(get_setting('home_banner2_images'));
        Cache::put('home_banner2_images', $banner_2_imags, $expiresAt);
        $banner_2_imags=Cache::get('home_banner2_images');
        $staffs = Staff::with('user')->where('is_apper', 1)->get();

        $minutes = \Carbon\Carbon::now()->addMinutes(60);
        $all_brands= \Illuminate\Support\Facades\Cache::remember('brands', $minutes, function() {
            return \App\Models\Brand::all();
        });


        $banner_1_imags = json_decode(get_setting('home_banner1_images'));
        Cache::put('home_banner1_images', $banner_1_imags, $expiresAt);
        $banner_1_imags=\Illuminate\Support\Facades\Cache::get('home_banner1_images');



        return view('frontend.layouts.app',compact('slider_images','banner_1_imags','banner_2_imags','all_brands','staffs'));
    }


    public function clientIndex(){
        if(Auth::check()) {
            if (auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'staff') {
                return redirect()->route('website.main');
            }
        }
        if(Session::get('cv_id')!=null){
            $cvs = Cv::find(Session::get('cv_id'));
            $check_count_reservation = Reservation::where('user_id', auth::user()->id)->whereNull('deleted_at')->count();
            $check_count_reservation_status = Reservation::where('user_id', auth::user()->id)->whereNull('deleted_at')->whereIn('status',[1,2,3])->count();
            if($check_count_reservation_status < 1) {
                if ($cvs->is_booking != 1 && $check_count_reservation < 5) {
//                    && $check_res == 0
                    $res = new Reservation();
                    $res->user_id = auth::user()->id;
                    $res->cv_id = Session::get('cv_id');
                    $res->status = 2;
                    $res->code = env('ALPA_KEY') . $cvs->nationality->key_code . date('Ymd') . rand(10, 99);
                    $res->save();
                    if(Session::get('staff_id')!=null){
                        $res->administrator_id = Session::get('staff_id');
                        $res->status = 3;
                        $res->save();
                        $user = User::find(Session::get('staff_id'));
                        //from freelancer to client
                        NotificationUtility::set_notification(
                            "change_booking_status",
                            "تم اسناد طلب حجز جديد لك",
                            route('booking_cv_request.view', ['id' => $res->id]),
                            $res->administrator_id,
                            Auth::user()->id,
                            'admin',
                            $res->id
                        );
                        $user_phone = $user->phone;
//                        $msg =   " عزيزى الموظف " . $user->name . " قام العميل " . auth::user()->name . " رقم جواله " . auth::user()->phone . " \nبحجز السيرة الذاتية الاتية " . static_asset(json_decode($res->cv->images)[0]);
                        $msg =  "يوجد لديكم حجز باسم ".auth::user()->name   ."برقم جوال " .auth::user()->phone ;

                        if(!empty($user)) {
                            sendSmsMassage($user_phone, $msg);
                        }
                    }
                    $cvs->is_booking = 1;
                    $cvs->save();
                    NotificationUtility::set_notification(
                        "new_booking_cv",
                        "قام هذا العميل بطلب حجز لهذة السيرة الذاتيه رقم الحجز " . $res->code,
                        route('booking_cv_request.view', ['id' => $res->id]),
                        0,
                        Auth::user()->id,
                        'admin',
                        $res->id
                    );
                    flash('تم الحجز بنجاح')->success();

                    Session::forget('cv_id');
                    if(Session::get('staff_id')==null) {
                        return redirect()->route('choose_customer_service', $res->id);
                    }else{
                        Session::forget('staff_id');
                        return redirect()->route('count_timer', $res->id);

                    }
//                return view('frontend.client_index');
                } else {
                    flash('ﻻ يمكنك انشاء طلب جديد برجاء المحاولة مرة اخرى')->error();
                }
            }else {
                flash(translate('ﻻ يمكنك انشاء طلب جديد الان يمكن متابعة طلبك او إلغاء السابق والبدأ فى طلب حجز جديد'))->error();
            }
        }
        elseif (Session::get('sponsor_contract_id')!=null){
            $contract = Contract::find(Session::get('sponsor_contract_id'));
            $Cv = CvPreviousSponsor::where('contract_id', $contract->id)->first();
            if( $Cv->is_active !=1) {
                $reservation_sponsor = new ReservationSponsor();
                $reservation_sponsor->contract_id = Session::get('sponsor_contract_id');
                $reservation_sponsor->administrator_id = Session::get('sponsor_staff_name');
                $reservation_sponsor->new_guarantor_id = auth::user()->id;
                $reservation_sponsor->old_guarantor_id = $contract->reservation->user->id;
                $reservation_sponsor->save();
                $Cv->is_active = 1;
                $Cv->save();
                $contract->reservation->sponsor_user_list = ($contract->reservation->sponsor_user_list != null) ? $contract->reservation->sponsor_user_list . ',' . auth::user()->id : auth::user()->id;
                $contract->reservation->user_id = auth::user()->id;
                $contract->reservation->save();
                NotificationUtility::set_notification(
                    "change_booking_status",
                    "تم اسناد طلب نقل كفالة جديد لك",
                    route('cv_previous_sponsor.edit', $reservation_sponsor->id) ,
                    $reservation_sponsor->administrator_id,
                    Auth::user()->id,
                    'admin',
                    $reservation_sponsor->id
                );
                $admin=User::find($reservation_sponsor->administrator_id);
                $user_phone = $admin->phone;
                $passport=$contract->reservation->cv->passport_id??"--";
                $msg =  "يوجد لديكم حجز باسم ".auth::user()->name ."برقم جوال " .auth::user()->phone ;
                if(!empty($admin)) {
                    sendSmsMassage($user_phone, $msg);
                }
                flash('تم ارسال طب نقل الكفالة بنجاح')->success();
                Session::forget(['sponsor_contract_id','sponsor_staff_name']);
            }else{
                flash('ﻻ يمكن نقل الكفاله للعامل لوجود حجز عليه')->error();

            }
        }
        return view('frontend.client_index');
    }


    // Ajax call
    public function new_verify(Request $request)
    {
        $email = $request->email;
        if(isUnique($email) == '0') {
            $response['status'] = 2;
            $response['message'] = 'Email already exists!';
            return json_encode($response);
        }

        $response = $this->send_email_change_verification_mail($request, $email);
        return json_encode($response);
    }


    // Form request
    public function update_email(Request $request)
    {
        $email = $request->email;
        if(isUnique($email)) {
            $this->send_email_change_verification_mail($request, $email);
            flash(translate('تـم إرسال رسالة تحقق الي البريد الالكتروني .'))->success();
            return back();
        }

        flash(translate('البريـد الالكتــروني موجــود بالفعــل'))->warning();
        return back();
    }

    public function send_email_change_verification_mail($request, $email)
    {
        $response['status'] = 0;
        $response['message'] = 'Unknown';

        $verification_code = Str::random(32);

        $array['subject'] = 'Email Verification';
        $array['from'] = env('MAIL_FROM_ADDRESS');
        $array['content'] = 'Verify your account';
        $array['link'] = route('email_change.callback').'?email_verificiation_code='.$verification_code.'&email='.$email;
        $array['sender'] = Auth::user()->name;
        $array['details'] = "Email Second";

        $user = (isset($request->customer_id)&& !empty($request->customer_id))?Customer::find($request->customer_id)->user:Auth::user();
        $user->email_verificiation_code = $verification_code;
        $user->email=$email;
        $user->save();

        try {
            Mail::to($email)->queue(new SecondEmailVerifyMailManager($array));

            $response['status'] = 1;
            $response['message'] = translate("تـم إرسـال رســالــة التحــقق الي البريــد الالكترونــي الخــاص بك.");

        } catch (\Exception $e) {
            // return $e->getMessage();
            $response['status'] = 0;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    public function email_change_callback(Request $request){
        if($request->has('email_verificiation_code') && $request->has('email')) {
            $verification_code_of_url_param =  $request->input('email_verificiation_code');
            $user = User::where('email_verificiation_code', $verification_code_of_url_param)->first();

            if($user != null) {

                $user->email = $request->input('email');
                $user->email_verificiation_code = null;
                $user->save();

                auth()->login($user, true);

                flash(translate('تـم تغييـر البريــد الالكترونــي بنحـــاح'))->success();
                return redirect()->route('dashboard');
            }
        }

        flash(translate('لم يتم التحقق من البريد الالكتروني الخاص بك , الرجاء إعادة إرسال البريد البريد الخاص بك'))->error();
        return redirect()->route('dashboard');

    }

    public function policiesRecruitment(Request $request){
        return view("frontend.policies");
    }
    public function musaned(Request $request){
        return view("frontend.musaned");
    }
    public function visa(Request $request){
        return view("frontend.visa-issuance");
    }
    public function reset_password_with_code(Request $request){
        if (($user = User::where('email', $request->email)->where('email_verificiation_code', $request->code)->first()) != null) {
            if($request->password == $request->password_confirmation){
                $user->password = Hash::make($request->password);
                $user->phone_verified_at = date('Y-m-d h:m:s');
                $user->save();
                event(new PasswordReset($user));
                auth()->login($user, true);

                flash(translate('تم تحديث كلمة السر بنجـــاح'))->success();

                if(auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'staff')
                {
                    return redirect()->route('website.main');
                }
                return redirect()->route('clientIndex');
            }
            else {
                flash("كلمة السر وتأكيد كلمة السر غير متطابقتان")->warning();
                return redirect()->route('password_request_back');
            }
        }
        else {
            flash("رمز التحقق غير متطابق")->error();
            return redirect()->route('password_request_back');
        }
    }
    public function frequently_questioned_create(Request $request)
    {

        $FrequentlyQuestioned = new FrequentlyQuestioned;

        $FrequentlyQuestioned->question = $request->question;
        $FrequentlyQuestioned->answer = $request->answer;
        $FrequentlyQuestioned->save();
        flash('تم إدراج الأسئلة المتكررة بنجاح')->success();
        return redirect()->route('website.other_pages');

    }

    public function frequently_questioned_update(Request $request)
    {

        $FrequentlyQuestioned =  FrequentlyQuestioned::find($request->fre_id);
        $FrequentlyQuestioned->question = $request->question;
        $FrequentlyQuestioned->answer = $request->answer;
        $FrequentlyQuestioned->save();
        flash('تم تحديث الاسألة المتكررة بنجـــاح')->success();
        return redirect()->route('website.other_pages');

    }
    public function frequently_questioned_destroy($id)
    {
        FrequentlyQuestioned::destroy(decrypt($id));
        flash('تم حذف الاسألة المتكررة بنجاح')->success();
        return redirect()->route('website.other_pages');

    }

    public function common_topics($id)
    {

        $feq_ques =  CommonTopic::find($id);
        return view('frontend.support.view',compact('feq_ques'));
    }
    public function common_useful_topics($id ,Request $request )
    {

        $feq_ques =  CommonTopic::find($id);
        $feq_ques->count_like +=1;
        $feq_ques->save();
        return 1;
    }
    public function count_unuseful_article($id)
    {

        $feq_ques =  CommonTopic::find($id);
        $feq_ques->count_dislike +=1;
        $feq_ques->save();

        return 1;
    }
    public function customer_update_profile(Request $request)
    {
        if(env('DEMO_MODE') == 'On'){
            flash(translate('عفوا ! الإجراء غير مسموح به في العرض '))->error();
            return back();
        }

        $user = Auth::user();
        $user->name = $request->name;
        $user->address = $request->address;
        $user->country = $request->country;
        $user->city = $request->city;
        $user->postal_code = $request->postal_code;


        if($request->new_password != null && ($request->new_password == $request->confirm_password)){
            $user->password = Hash::make($request->new_password);
        }
        $user->avatar_original = $request->photo;

        if($user->save()){
            flash(translate('تم تحديث ملف التعريف الخاص بك بنجــــاح'))->success();
            return back();
        }

        flash(translate('عفوا ! حــدث خطـــأ ما'))->error();
        return back();
    }

}
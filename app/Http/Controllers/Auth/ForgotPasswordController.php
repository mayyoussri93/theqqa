<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\User;
use App\Mail\SecondEmailVerifyMailManager;
use App\Utility\SmsUtility;
use Mail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function showBackLinkRequestForm()
    {
        return view('auth.passwords.back_email');
    }
    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email', $request->email)->first();
            if ($user != null) {

                $user->email_verificiation_code = rand(1000,9999);
                $user->save();

                $array['view'] = 'emails.verification';
                $array['from'] = env('MAIL_FROM_ADDRESS');
                $array['subject'] = translate('Password Reset');
                $array['content'] = translate('Verification Code is ').$user->email_verificiation_code;

                Mail::to($user->email)->queue(new SecondEmailVerifyMailManager($array));
                $email=$request->email;
                return view('auth.passwords.reset',compact('email'));
            }
            else {
                flash(translate('لا يـوجـد حسـاب مـسـجـل بـهـذا الـبـريـد الالـكـترونـي'))->error();
                return back();
            }
        }
        else{

            $user = User::where('phone', $request->email)->first();
            if ($user != null) {
                $user->verification_code = rand(1000,9999);
                $user->save();
//                SmsUtility::password_reset($user);
                $msg=   " مرحبأ بك ,نأمل أستخدام رمز التفعيل لتغير كلمة المرور " .$user->verification_code ;
                if(!empty($user->phone)) {
                    sendSmsMassage($user->phone, $msg);
                }
             $phone=   $request->email;
                return view('otp_systems.frontend.auth.passwords.reset_with_phone',compact('phone'));
            }
            else {
                flash(translate('لا يـوجـد حـساب مـسـجـل بـهـذا الرقم'))->error();
                return back();
            }
        }
    }
}

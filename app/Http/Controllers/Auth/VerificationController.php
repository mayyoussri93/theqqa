<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\SettingManagement\OTPVerificationController;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Show the email verification notice.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if ($request->user()->email != null) {
            return $request->user()->hasVerifiedEmail()
                            ? redirect($this->redirectPath())
                            : view('auth.verify');
        }
        else {
            $otpController = new OTPVerificationController;
            $otpController->send_code($request->user());
            return redirect()->route('verification');
        }
    }


    /**
     * Resend the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('resent', true);
    }

    public function verification_confirmation($code){
        $user = User::where('verification_code', $code)->first();
        if($user != null){
            $user->phone_verified_at = Carbon::now();
            $user->save();
            auth()->login($user, true);
            flash(translate('تـم تـأكـيــد الـبـريـد الالـكــتـرونـي بـنـجــاح'))->success();
        }
        else {
            flash(translate('عــفـوا , لـم نسـتطع تــأكيـد البـريـد الالـكـتـرونـي الخـاص بـك ,مـن فـضـلـك حـاول مرة اخـرى'))->error();
        }

        return redirect()->route('dashboard');
    }
}

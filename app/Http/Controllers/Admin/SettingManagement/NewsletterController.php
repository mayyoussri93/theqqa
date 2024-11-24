<?php

namespace App\Http\Controllers\Admin\SettingManagement;

use App\Http\Controllers\Controller;
use App\Mail\EmailManager;
use App\Models\Message;
use App\Models\Subscriber;
use App\Models\User;
use auth;
use Illuminate\Http\Request;
use Mail;

class NewsletterController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        $subscribers = Subscriber::all();
        return view('backend.SettingManagement.newsletters.index', compact('users', 'subscribers'));
    }
    public function massageIndex(Request $request)
    {
//        $meg = Message::where('user_id',)->get();
        $users = User::all();
        $subscribers = Message::all();
        return view('backend.SettingManagement.massage.create', compact('users', 'subscribers'));
    }

    public function massagelist($user_id)
    {

        $megs = Message::where('user_id',$user_id)->get();
        $user=User::find($user_id);
        return view('backend.SettingManagement.massage.index', compact('megs','user'));
    }

    public function massageSend(Request $request)
    {

        if(!empty($request->user_id)){
        $user=User::find($request->user_id);
        $user_phone=$user->phone;
        $megs =new Message();
        $megs->user_id=$request->user_id;
        $megs->from_user=auth::user()->id;
        $megs->message=$request->content;
        $megs->save();
        if(!empty($user_phone)) {
            sendSmsMassage($user_phone, $request->content);
        }
}

        if(!empty($request->client)){
            foreach ($request->client as $key =>$val ){
                $user=User::find($val);
                $user_phone=$user->phone;
                $megs =new Message();
                $megs->user_id=$val;
                    $megs->from_user=auth::user()->id;
                    $megs->message=$request->content;
                        $megs->save();
                if(!empty($user_phone)) {
                    sendSmsMassage($user_phone, $request->content);
                }

            }
        }
        if(!empty($request->clint_out)){
            foreach ($request->clint_out as $key =>$val2 ){
                $user_phone=$val2;
                if(!empty($user_phone)) {
                    sendSmsMassage($user_phone, $request->content);
                }

            }
        }
        if ($request->ajax()) {
            return [
                "status" => true,
                'msg'=>'تم ارسال الرسائل بنجاح'
            ];
        }else{
            flash(translate('تم ارسال الرسائل بنجاح'))->success();
            return redirect()->back();
        }

    }
    public function send(Request $request)
    {
        if (env('MAIL_USERNAME') != null) {
            //sends newsletter to selected users
        	if ($request->has('user_emails')) {
                foreach ($request->user_emails as $key => $email) {
                    $array['view'] = 'emails.newsletter';
                    $array['subject'] = $request->subject;
                    $array['from'] = env('MAIL_FROM_ADDRESS');
                    $array['content'] = $request->content;

                    try {
                        Mail::to($email)->queue(new EmailManager($array));
                    } catch (\Exception $e) {
                        //dd($e);
                    }
            	}
            }

            //sends newsletter to subscribers
            if ($request->has('subscriber_emails')) {
                foreach ($request->subscriber_emails as $key => $email) {
                    $array['view'] = 'emails.newsletter';
                    $array['subject'] = $request->subject;
                    $array['from'] = env('MAIL_FROM_ADDRESS');
                    $array['content'] = $request->content;

                    try {
                        Mail::to($email)->queue(new EmailManager($array));
                    } catch (\Exception $e) {
                        //dd($e);
                    }
            	}
            }
            //sends newsletter to subscribers
            if ($request->has('countact_emails')) {
                foreach ($request->countact_emails as $key => $email) {
                    $array['view'] = 'emails.newsletter';
                    $array['subject'] = $request->subject;
                    $array['from'] = env('MAIL_FROM_ADDRESS');
                    $array['content'] = $request->content;

                    try {
                        Mail::to($email)->queue(new EmailManager($array));
                    } catch (\Exception $e) {
                        //dd($e);
                    }
                }
            }
        }
        else {
            flash(translate('الـرجاء ضبط إعدادات SMTP اولا'))->error();
            return back();
        }

    	flash(translate('تـم إرسال النشــرة الاخباريــة'))->success();
    	return redirect()->route('admin.dashboard');
    }

    public function testEmail(Request $request){
        $array['view'] = 'emails.newsletter';
        $array['subject'] = "SMTP Test";
        $array['from'] = env('MAIL_FROM_ADDRESS');
        $array['content'] = "This is a test email.";

        try {
            Mail::to($request->email)->queue(new EmailManager($array));
        } catch (\Exception $e) {
            dd($e);
        }

        flash(translate('تــم إرســـال بريــد الكتـــرونــي'))->success();
        return back();
    }
}
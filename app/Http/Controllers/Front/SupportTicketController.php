<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\SupportMailManager;
use App\Models\Reservation;
use App\Models\Ticket;
use App\Models\TicketReply;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Mail;
use Yajra\DataTables\DataTables;

class SupportTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return view('frontend.user.support_ticket.index', compact('tickets'));
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        if(Ticket::where('resv_id',$request->profile_dropdown)->status('pending')->orWhere('status','open')->count()==0) {

            $ticket = new Ticket;
            $ticket->code = (Ticket::latest()->first() != null) ? Ticket::latest()->first()->id . date('Ymd') . rand(10, 99) : date('Ymd') . rand(10, 99);
            $ticket->user_id = Auth::user()->id;
            $ticket->subject = $request->subject;
            $ticket->resv_id = $request->profile_dropdown;
            $ticket->details = $request->details;
            $ticket->main_subject = $request->main_subject;

            if (!empty($request->attachments)) {
                $ticket->files = $request->attachments;
            }
            if ($ticket->save()) {

                $user = User::find(Auth::user()->id);
                $msg = " عزيزنا العميل ,تم تسليك الشكوى لدى مكتب روافد نجد بنجاح . وهى محل اهتمامنا و سيتم المتابعة و أعلامك بالمستجدات رقم الشكوى" . $ticket->code;
                if(!empty($user->phone)) {
                    sendSmsMassage($user->phone, $msg);
                }
                foreach (\App\Models\Staff::get() as $staff) {
                    if ($staff->user != null) {
                        $msg_2 = " تم رفع شكوى باسم : " . $user->name . " رقم الطلب " . $ticket->code;
                        sendSmsMassage($staff->user->phone, $msg_2);
                    }
                }
                $this->send_support_mail_to_admin($ticket);
                flash(translate('تم إرسال التذكرة بنجــاح'))->success();
                return back();
            } else {
                flash(translate('حــدث خطــأ مــا'))->error();
                return back();

            }
        }else{


            flash(translate('يوجد شكوى لهذا الحجز'))->error();
            return back();
        }
    }

    public function send_support_mail_to_admin($ticket){
        $array['view'] = 'emails.support';
        $array['subject'] = 'Support ticket Code is:- '.$ticket->code;
        $array['from'] = env('MAIL_FROM_ADDRESS');
        $array['content'] = 'مرحبا . تم إنشاء التذكرة بنجــاح . من فضلك قم بالتحقق من التذكرة';
        $array['link'] = route('support_ticket.admin_show', encrypt($ticket->id));
        $array['sender'] = $ticket->user->name;
        $array['details'] = $ticket->details;

        // dd($array);
        // dd(User::where('user_type', 'admin')->first()->email);
        try {
            Mail::to(User::where('user_type', 'admin')->first()->email)->queue(new SupportMailManager($array));
        } catch (\Exception $e) {
            // dd($e->getMessage());
        }
    }

    public function send_support_reply_email_to_user($ticket, $tkt_reply){
        $array['view'] = 'emails.support';
        $array['subject'] = 'Support ticket Code is:- '.$ticket->code;
        $array['from'] = env('MAIL_FROM_ADDRESS');
        $array['content'] = 'مرحبا . تم إنشاء التذكرة بنجــاح . يرجى التحقق من التذكرة';
        $array['link'] = route('support_ticket.show', encrypt($ticket->id));
        $array['sender'] = $tkt_reply->user->name;
        $array['details'] = $tkt_reply->reply;

        try {
            Mail::to($ticket->user->email)->queue(new SupportMailManager($array));
        } catch (\Exception $e) {
            //dd($e->getMessage());
        }
    }


    public function seller_store(Request $request)
    {
        $ticket_reply = new TicketReply;
        $ticket_reply->ticket_id = $request->ticket_id;
        $ticket_reply->user_id = $request->user_id;
        $ticket_reply->reply = $request->reply;
        if($request->hasFile('attachments')) {
            $ticket_reply->files = $request->file('attachments')->store('uploads/all', 'local');
        }
        $ticket_reply->ticket->viewed = 0;
        $ticket_reply->ticket->status = 'pending';
        $ticket_reply->ticket->save();
        if($ticket_reply->save()){

            flash(translate('تم إرسال الرد بنجــاح'))->success();
            return back();
        }
        else{
            flash(translate('حــدث خطــأ مــا'))->error();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::findOrFail(decrypt($id));
        $ticket->client_viewed = 1;
        $ticket->save();
        $ticket_replies = $ticket->ticketreplies;

        return view('frontend.user.support_ticket.show', compact('ticket','ticket_replies'));
    }
    public function ticket_refresh( Request $request)
    {
        $ticket = Ticket::findOrFail($request->ticket_id);
        $ticket->client_viewed = 1;
        $ticket->save();
        $ticket_replies = $ticket->ticketreplie;

        return view('frontend.partials.support_ticext',compact('ticket','ticket_replies'));
    }

    public function change_status(Request $request)
    {
        $id= $request->ticket_id;
        $ticket = Ticket::findOrFail($id);
        $ticket->status = $request->status;
        $ticket->save();
        flash(translate('تم تغير حالة الشكوى بنجاح'))->success();

        return back();
    }
    public function forwardTicket(Request $request)
    {
        $id= $request->ticket_id;
        $ticket = Ticket::findOrFail($id);
        $ticket->admin_id = $request->selected_staff;
        $ticket->save();
        $user_phone= User::find( $ticket->admin_id)->phone;
        $msg=$ticket->code."تم اسناد شكوى لك رقم";
        if (!empty($user_phone)&&!empty($msg)) {
            sendSmsMassage($user_phone, $msg);
        }

        flash(translate('تم تحويل الشكوى بنجاح'))->success();

        return back();
    }
    public function send_messesage(Request $request)
    {
        $id= $request->ticket_id;
        $ticket = Ticket::findOrFail($id);


        $ticket_reply = new TicketReply;
        $ticket_reply->ticket_id = $request->ticket_id;
        $ticket_reply->user_id = Auth::user()->id;
        $ticket_reply->reply = $request->reply;
        $ticket_reply->is_sms = 1;
        $ticket_reply->files = $request->attachments;
        $ticket_reply->save();
        $ticket->client_viewed = 0;
        $ticket->save();

            $user_phone= $ticket->user->phone;
            if (!empty($user_phone)&&!empty($request->reply)) {
                sendSmsMassage($user_phone, $request->reply);
            }

        flash(translate('تم ارسال الرسالة بنجاح بنجاح'))->success();

        return back();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {TicketReply::whereTicketId($id)->delete();
        Ticket::destroy($id);
        flash(translate('تم حذف الشكوى بنجاح'))->success();

        return back();
    }
    public function dataTypeSupportTicket(Request $request)
{
    if($request->ticket_type=='contract'){
        $data=Reservation::whereNull('deleted_at')->latest()->whereHas('contract')->whereHas('user')->with('user','cv')->get();
    }elseif ($request->ticket_type=='reservation'){
        $data=Reservation::whereNull('deleted_at')->latest()->whereHas('cv')->whereHas('user')->with('user','cv')->whereIn('status', [1, 2, 3,4])->get();
    }
    return response()->json($data);
}
    public function dataFrontSupportTicket(Request $request)
    {
        if($request->ticket_type=='contract'){
            $data=Reservation::whereNull('deleted_at')->latest()->whereHas('contract')->where('user_id',auth::user()->id)->with('user','cv')->get();
        }elseif ($request->ticket_type=='reservation'){
            $data=Reservation::whereNull('deleted_at')->latest()->whereHas('cv')->where('user_id',auth::user()->id)->with('user','cv')->whereIn('status', [1, 2, 3,4])->get();
        }
        return response()->json($data);
    }

}
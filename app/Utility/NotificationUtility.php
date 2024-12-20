<?php
/**
 * Created by PhpStorm.
 * User: Aunok
 * Date: 12/19/2019
 * Time: 4:37 PM
 */

namespace App\Utility;

use App\Models\Notification;
use App\Models\Reservation;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class NotificationUtility
{
    public static function set_notification($type, $message = '', $link = '/', $receiver = 0, $sender = false, $showing_panel = null,$request_id=null)
    {
        try {
            $notification = new Notification;
            $notification->notification_type = $type;
            $notification->sender_id = $sender ? $sender : (Auth::check() ? Auth::user()->id : 0);
            $notification->receiver_id = $receiver;
            $notification->message = translate($message);
            $notification->link = $link;
            $notification->seen_by_receiver = 0;
            $notification->showing_panel = $showing_panel;
            $notification->request_id = $request_id;
//            $notification->mobile_link = $mobile_link;

            $notification->save();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }

    public static function get_my_notifications($limit = 0, $only_unseen = true, $only_count = false, $paginated = false)
    {
        $list = array();
        $count = 0;
        if (!Auth::check() && !$only_count) {
            return $list;
        } elseif (!Auth::check() && $only_count) {
            return $count;
        }
        $panel = '';
        if (isCustomer()) {
            $panel = 'client';
        } else if (isSeller()) {
            $panel = 'seller';
        }else if(Auth::user()->user_type == 'staff'){
            $panel='';
        } else if (isAdmin()) {
            $panel = 'admin';
        }

        $notifications_query = Notification::with(['sender'])->where('receiver_id', Auth::user()->id)->latest();

        if ($panel == 'admin') {
            $notifications_query->orWhere('showing_panel', $panel);
        }
        if ($only_unseen == true) {
            $notifications_query->where('seen_by_receiver', 0);
        }

        //return only the numbers of notifications
        if ($only_count) {
            return $notifications_query->count();
        } else if ($paginated) {
            //return paginated data for all notifications page
            return $notifications_query->paginate($limit);
        }
        $notifications = $notifications_query->limit($limit)->get();

        foreach ($notifications as $notification) {
            if($notification->sender != null){
                $item = array();
                $item['id'] = $notification->id;
                $item['message'] = $notification->message;
                $item['link'] = url($notification->link);
                $item['sender_name'] = $notification->sender->name;
                $item['sender_photo'] = $notification->sender->photo > 0 ? my_asset($notification->sender->photo) : my_asset('assets/img/avatar-place.png');
                $item['seen'] = $notification->seen_by_receiver == 1 ? true : false;
                $item['date'] = Carbon::parse($notification->created_at)->locale(App::getLocale()=="en"?"en":"ar")->diffForHumans();
                $item['project'] =($notification->request_id!=null)?  $notification->request_id:null;
                $list[] = $item;
            }
        }

        return $list;
    }

    public static function make_my_notifications_seen()
    {
        try {
            $panel = '';

            if (isCustomer()) {
                $panel = 'client';
            } else if (isSeller()) {
                $panel = 'seller';
            } else if (isAdmin()) {
                $panel = 'admin';
            }
            if (!Auth::check()) {
                return false;
            }

            $notifications_query = Notification::where('receiver_id', Auth::user()->id);
            $notifications_query->where('seen_by_receiver', 0);

            if ($panel == 'admin') {
                $notifications_query->orWhere('showing_panel', $panel);
            }
            $notifications_query->update(['seen_by_receiver' => 1]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }
}

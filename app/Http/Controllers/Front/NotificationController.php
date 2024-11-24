<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use App\Utility\NotificationUtility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{

    public function frontend_listing()
    {
        NotificationUtility::make_my_notifications_seen();
        $notifications = NotificationUtility::get_my_notifications(5,false,0,true);

        return view('frontend.user.notifications',compact('notifications'));
    }

    public function update_seen_notfication(Request $request)
    {
        $notification = Notification::find($request->id);
        $notification->seen_by_receiver =1;
        $notification->save();
        return url($notification->link);

    }

}

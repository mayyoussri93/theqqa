<?php

namespace App\Http\Controllers\Admin\SettingManagement;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use App\Utility\NotificationUtility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_listing()
    {
        NotificationUtility::make_my_notifications_seen();
        $notifications = NotificationUtility::get_my_notifications(10,false,0,true);

        return view('backend.notifications',compact('notifications'));
    }
    public function user_logs(Request $request)
    {
        $activities = \Spatie\Activitylog\Models\Activity::latest();
        $selected_staff=$request->selected_staff;
        $subject_id=$request->subject_id;
        if ($request->selected_staff != null) {
            $activities = $activities->where('causer_id', $selected_staff);
        }
        if ($request->subject_id != null) {
            $activities = $activities->where('subject_id', $subject_id);
        }
        $users=User::where('user_type','admin')->orWhere('user_type','staff')->pluck('id')->toArray();
        $selected_table=$request->selected_table;
        if ($request->selected_table != null) {
            if ($request->selected_table == 1) {//sold
                $activities = $activities->where('subject_type',  'App\Models\User');
            } elseif ($request->selected_table == 2) {//booking
                $activities = $activities->where('subject_type',  'App\Models\Contract');
            } elseif ($request->selected_table == 3) {
                //not booking
                $activities = $activities->where('subject_type',  'App\Models\Reservation');
            } elseif ($request->selected_table == 4) {
                //back out
                $activities = $activities->where('subject_type',  'App\Models\Office');
            }
            elseif ($request->selected_table == 5) {
                $activities = $activities->where('subject_type', 'App\Models\OfficeProfile');
            }elseif ($request->selected_table == 6) {
                $activities = $activities->where('subject_type', 'App\Models\Cv');
            }
        }
        $activities = $activities->whereIn('causer_id',$users)->paginate(20)->appends(request()->query());
        return view('backend.user_logs',compact('activities','selected_table','selected_staff','subject_id'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    {
        //
    }

    public function update_admin_seen_notfication(Request $request)
    {
        $notification = Notification::find($request->id);
        $notification->seen_by_receiver =1;
        $notification->save();
        return url($notification->link);
//        return Redirect::to(url($notification->link));
//
//        return redirect()->away(url($notification->link))->send();
    }
    public function update_sound_notfication()
    {
        $notification = Notification::where('receiver_id', Auth::user()->id)->where('seen_by_receiver',0)->whereDate('created_at', '=', date('Y-m-d'))->count();

        if($notification >0){
            return 1;
        }else{
            return 0;
        }
    }

}

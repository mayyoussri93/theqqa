<?php
/**
 * Theqqa - Classified Ads Web Application
 * Copyright (c) BedigitCom. All Rights Reserved
 *
 * Website: http://www.
 *
 * Theqqa
 */

namespace App\Console\Commands;

use App\Models\City;
use App\Models\Cv;
use App\Models\Payment;
use App\Models\Reservation;
use App\Models\User;
use App\Notifications\PostArchived;
use App\Notifications\PostDeleted;
use App\Notifications\PostWilBeDeleted;
use App\Models\Nationality;
use App\Utility\NotificationUtility;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Jenssegers\Date\Date;
use auth;
class AdsCleaner extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ads:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all old Posts.';

    /**
     * Default Ads Expiration Duration
     *
     * @var int
     */
    private $activatedPostsExpiration = 2; // Archive the activated Posts after this expiration

    /**
     * AdsCleaner constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->activatedPostsExpiration = (int)get_setting('reservation_timer',48)/24;

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $posts = Reservation::whereIn('status',[14])->get();
        foreach ($posts as $post) {
            $createdDate = ($post->procedures_contract !=null)? $post->procedures_contract:$post->created_at;
            if( ($post->procedures_contract ==null)) {
                $this->activatedPostsExpiration = 3;
            }
            // Get today date with the TimeZone
            $currentDate = Carbon::today()->toDateString();


            // Debug
            // dd($today->diffInDays($post->created_at));

            /* Non-activated Ads */
            // Delete non-active Ads after '$this->unactivatedPostsExpiration' days
            if ( Carbon::parse(Carbon::now())->diffInDays($createdDate) >= $this->activatedPostsExpiration) {
                $cv=  Cv::find($post->cv_id);
                if(!empty($cv)){
                $cv->is_booking=0;
                $cv->is_sale=0;
                $cv->save();}
                if(!empty( $post->administrator_id)){
                            NotificationUtility::set_notification(
                "change_booking_status",
                $post->code ."لقد انتهت صلاحية الحجز رقم",
                route('cvs.edit', $post->cv_id) ,
                $post->administrator_id,
                1,
                'admin',
                $post->id
            );
                }
            NotificationUtility::set_notification(
                "change_booking_status",
                $post->code ."لقد انتهت صلاحية الحجز رقم",
                route('cvs.edit', $post->cv_id) ,
                0,
                1,
                'admin',
                $post->id
            );
            NotificationUtility::set_notification(
                "change_booking_status",
                $post->code ." انتهت صلاحية الحجز رقم",
                route('user.booking_log') ,
                $post->user_id,
              1,
                'client',
                $post->id
            );
                $post->delete();
                continue;
            }


        }
    }

}
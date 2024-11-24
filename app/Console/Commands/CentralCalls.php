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

use App\Models\Central;
use App\Traits\CentralTrait;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Jenssegers\Date\Date;
use auth;
class CentralCalls extends Command

{
    use CentralTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'central:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get new calls';

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


    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $data= central_data();
        if(!empty($data)){
            foreach ($data as $key=>$val){
                if(Central::where('central_ids',$val['id'])->count()==0) {
                    if($val['call_type']!="Internal") {
                        $user_data=$this->getUserCentralData($val['call_from']);
                        $central = new Central([
                            'central_ids' => $val['id'],
                            'date' => Carbon::createFromFormat('d/m/Y g:i A', $val['time'])->format('Y-m-d'),
                            'phone' => $this->getUserCentral($val['call_from']),
                            'client_name' =>($user_data !=  null)?$user_data["contact_name"]:null,
                            'employee_by' => $this->getUserCentral($val['call_to']),
                            'status' => $val['disposition'],
                            'call_duration' => $val['duration'] ?? 0,
                            'take_duration' => $val['talk_duration'] ?? 0,
                            'call_type' => $val['call_type'],
                            'time' => Carbon::createFromFormat('d/m/Y g:i A', $val['time'])->toTimeString(),

                        ]);
                        $central->save();
                        if(($user_data!=null)) {
                            $central_ids = Central::where('phone', $central->phone)->pluck('id')->toArray();
                            Central::whereIn('id', $central_ids)->update(['details' => $user_data['remark'] ?? null, 'client_name' => $user_data['contact_name'], 'contact_id' => $user_data['id']]);
                        }
                    }
                }
            }

        }
    }

}
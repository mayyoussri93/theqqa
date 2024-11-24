<?php

namespace App\Jobs;

use App\Models\Central;
use App\Traits\CentralTrait;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GetCentralDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels,CentralTrait;
    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->data as $key=>$val){
            if(Central::where('central_ids',$val['id'])->count()==0) {
                if($val['call_type']!="Internal") {
                    $user_data=$this->getUserCentralData($val['call_from']);
                    $central = new Central([
                        'central_ids' => $val['id'],
                        'date' => Carbon::createFromFormat('d/m/Y g:i A', $val['time'])->format('Y-m-d'),
                        'phone' =>$this->getUserCentral($val['call_from']),
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

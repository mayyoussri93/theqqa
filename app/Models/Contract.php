<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
class Contract extends Model
{
    //

    use LogsActivity;
    protected static $logAttributes = ["*"];
    protected static $logOnlyDirty = true;

    protected $guarded = [];
    public function getLogNameToUse(): ?string
    {
        return 'العقد';
    }
    public function getDescriptionForEvent(string $eventName): string
    {

        if($eventName =="created") {
            return "تم اضافة عقد جديد عن طريق هذا الموظف ";
        }elseif ($eventName =="updated"){
            return "تم تعديل العقد  عن طريق هذا الموظف ";

        }elseif ($eventName =="deleted"){
            return "تم مسح العقد عن طريق هذا الموظف ";

        }
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();

        // Chain fluent methods for configuration options
    }



    public function durationWorkSponsor()
    {
        return $this->belongsTo(DurationWorkSponsor::class, 'duration_id');
    }

    public function reasonforwaiver()
    {
        return $this->belongsTo(Reasonforwaiver::class, 'reason_id');
    }
    public function contractSource()
    {
        return $this->hasOne(ContractSource::class, 'id');
    }
    public function reservation()
    {
        return $this->belongsTo(Reservation::class,'resv_id','id');
    }
    public function getLodgingDataExportAttribute()
    {
        $data=[];


        $date_arrive = \Carbon\Carbon::parse($this->reservation->cv->expired_date);
        $now = \Carbon\Carbon::now();
        if( $date_arrive->gt($now) == true ) {
            $guarantee_status=   'فى الضمان';
        }else {
            $guarantee_status=   'خارج الضمان';
        }

        if($this->reservation->cv->for_campany == 2)
            $lodging_location= "ايواء جدة" ;
        elseif($this->reservation->cv->for_campany == 1)
            $lodging_location= "ايواء الرياض" ;

           $data['deportation_status']=$this->deportation_status;
        $data['worker_name']=$this->reservation->cv->cvs_name?? "--";
        $data['passport_id']=$this->reservation->cv->passport_id??'--';
        $data['contract_id']=$this->id;
        $data['office']=$this->reservation->cv->officeRelation->name??"--";
        $data['nationality']=$this->reservation->cv->nationality->name ??"--";
        $data['lodging_location']=$lodging_location;
        $data['sponsor_salary']=$this->reservation->cv->nationality->sponsor_salary .' ريال';
        $data['guarantee_status']=$guarantee_status;
        $data['user_name']=$this->reservation->user->name?? "--";;
        $data['arrived_at']=date('d-m-Y', strtotime($this->reservation->cv->arrived_date));;
        $data['Adminstaff']=$this->reservation->Adminstaff->name??"--";
        $data['return_date']=date('d-m-Y', strtotime($this->date_worker_returned));
        $data['reason_worker_returned']=$this->reason_worker_returned;


        return $data ;
    }

}

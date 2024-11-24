<?php

namespace App\Models;


use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
class Reservation extends Model
{
    use LogsActivity;
    use SoftDeletes;
   protected $table="rservations";
//   protected $with=['cv.officeRelation','user.customer','Adminstaff'];
    protected static $logAttributes = ["*"];
    protected static $logOnlyDirty = true;
    public function getLogNameToUse(): ?string
    {
        return 'طلب استقدام';
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        if($eventName =="created") {
            return "تم اضافة طلب استقدام جديد عن طريق هذا الموظف ";
        }elseif ($eventName =="updated"){
            return "تم تعديل طلب الاستقدام عن طريق هذا الموظف ";

        }elseif ($eventName =="deleted"){
            return "تم مسح طلب الاستقدام عن طريق هذا الموظف ";

        }
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();

        // Chain fluent methods for configuration options
    }
    public function getFullStatusAttribute()
    {
        if($this->status==5 )
            return translate('عقود غير معتمدة');
        elseif($this->status ==6)
            return translate('اعتماد العقد');
        elseif($this->status ==7)
            return translate('عقد جديد');
        elseif($this->status ==8)
            return translate('مساند');
        elseif($this->status ==9)
            return translate('التفويض');
        elseif($this->status ==10)
            return translate('التفييز');
        elseif($this->status ==11)
            return translate('التذكرة');
        elseif($this->status ==15)
            return translate('تم الوصول');
        elseif($this->status ==13)
            return translate('مرتجع');
        elseif($this->status ==14)
            return translate('مرحلة الاجراءات');
    }
    public function getContractDataExportAttribute()
    {

        $data=[];

        if ($this->contract->date_contract){
            $date = \Carbon\Carbon::createFromFormat('m/d/Y', $this->contract->date_contract);

            $now = \Carbon\Carbon::now();
            $diff = $date->diffInDays($now);
            $data['Period_date']= $diff . translate('يوم');
        }else{
            $data['Period_date']= "غير مسجل" ;
        }

        $data['user_name_only']=$this->user->name;
        $data['contract_id']=$this->contract->id;
        $data['user_name']= $this->user->name;
        $data['phone']=$this->user->phone??'';
        $data['contract_visa_num']=$this->contract->contract_visa_num??'';
        $data['national_identification_number']=$this->user->customer->national_identification_number??'';
        $data['musand_num']=$this->contract->musand_num??'';
        $data['passport_id']= $this->cv->passport_id??'';
        $data['cvs_name']=  $this->cv->cvs_name??'';
        $data['arrived_date']=  $this->cv->arrived_date??'لم يتم الوصول بعد';
        $data['nationality']=$this->cv->nationality->name??'';
        $data['recruitmentFormOccupation']=$this->cv->recruitmentFormOccupation->name??'';
        $data['created_at']= date('d-m-Y', strtotime($this->contract->created_at));
        $data['office']= $this->cv->officeRelation->name??'';
        $data['full_status']= $this->full_status??'';
        $data['Adminstaff']=  $this->Adminstaff->name??'';
        $data['contract_source_id']= ContractSource::find($this->contract->contract_source_id)->name ??'--';

        return $data ;
    }


    public function scopeStatus($query,$status)
    {
        return $query->where('status',$status);
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function cv(){
        return $this->belongsTo(Cv::class,'cv_id');
    }
    public function contract(){
        return $this->hasOne(Contract::class,'resv_id','id');
    }

    public function Adminstaff(){
        return $this->belongsTo(User::class,'administrator_id');
    }

}

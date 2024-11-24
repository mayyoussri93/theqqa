<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
class OfficeProfile extends Model
{
    use LogsActivity;
    protected $table = 'office_profiles';
    protected $fillable = [
        'office_id',
        'lang_merage',
        'lang_percentage',
        'profile_name',
        'job_id',
        'salary',
        'learn',
        'social_statuses',
        'languages',
        'skills',
        'religion_id',
'duration_contract',
'passport_validity_period',
'passport_place',
'birth_place',
'scr_y',
'scr_height',
'dst_y',
        'review_cv',
        'service_price'
    ];
    protected static $logAttributes = ["*"];
    protected static $logOnlyDirty = true;

    public function getLogNameToUse(): ?string
    {
        return 'ملف المكتب';
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        if($eventName =="created") {
            return "تم اضافة ملف المكتب  عن طريق هذا الموظف ";
        }elseif ($eventName =="updated"){
            return "تم تعديل ملف المكتب عن طريق هذا الموظف ";

        }elseif ($eventName =="deleted"){
            return "تم مسح ملف المكتب  عن طريق هذا الموظف ";

        }
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();

        // Chain fluent methods for configuration options
    }


//    protected $appends = ['name'];
//    public function getNameAttribute()
//    {
//$job=RecruitmentFormOccupation::find($this->attributes['job_id']);
//        return !empty($job)?$job->name:null;
//    }
    public function getLangMerageAttribute($lang_merage)
    {
        return $lang_merage == null ? json_encode([]) : $lang_merage;
    }
    public function getLangPercentageAttribute($lang_percentage)
    {
        return $lang_percentage == null ? json_encode([]) : $lang_percentage;
    }
    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id');
    }
    public function recruitmentFormReligion()
    {
        return $this->belongsTo(RecruitmentFormReligion::class, 'religion_id');
    }
    public function job(){
        return $this->belongsTo(RecruitmentFormOccupation::class,'job_id');
    }

}

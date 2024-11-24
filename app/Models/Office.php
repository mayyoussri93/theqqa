<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Eloquent\Model;
use App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
class Office extends Model
{
    protected $with=['office_translation'];
    use LogsActivity;
    protected $table = 'offices';
    protected $fillable = [
        "scr_y",
        "scr_height",
        "dst_y",
        'office_phone',
        'office_commercial_id',
        'office_country',
        'office_city',
        'office_street',
        'office_bank_country',
        'office_bank_account_name',
        'office_bank_code',
        'office_notes',
        'office_manager_id',
        'nationality_id'
    ];
    protected static $logAttributes = ["*"];
    protected static $logOnlyDirty = true;

    public function getLogNameToUse(): ?string
    {
        return 'المكتب';
    }
    public function getDescriptionForEvent(string $eventName): string
    {
        if($eventName =="created") {
            return "تم اضافة المكتب  عن طريق هذا الموظف ";
        }elseif ($eventName =="updated"){
            return "تم تعديل المكتب عن طريق هذا الموظف ";

        }elseif ($eventName =="deleted"){
            return "تم مسح المكتب  عن طريق هذا الموظف ";

        }
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();

        // Chain fluent methods for configuration options
    }
    protected $appends = ['name'];
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('hasOfficeName', function (Builder $builder) {
            $builder->with('office_translation')->whereHas('office_translation');
        });
    }
    public function scopeBan($query, $type)
    {
        return $query->where('ban', $type);
    }

    public function getNameAttribute($lang = false)
    {
        $lang = $lang == false ? App::getLocale() : $lang;
//        $office_translation = $this->office_translation()->where('office_translations.lang', 'ar')->first();
//

        return $this->office_translation[0]->name ??'';
    }
    public function office_translation($lang = false)
    {
        return $this->hasMany(OfficeTranslation::class, 'office_id')->where('office_translations.lang', 'ar');
    }
    public function cv($lang = false)
    {
        return $this->hasMany(Cv::class, 'office');
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'office_country');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'office_city');
    }
    public function manager()
    {
        return $this->belongsTo(User::class, 'office_manager_id');
    }
    public function languages()
    {
        return $this->belongsToMany(RecruitmentFormLanguage::class, 'office_languages', 'office_id', 'language_id');
    }
    public function socialStatuses()
    {
        return $this->belongsToMany(RecruitmentFormSocialStatus::class, 'office_social_statuses', 'office_id', 'social_status_id');
    }
    public function airports()
    {
        return $this->belongsToMany(Airport::class, 'office_airports');
    }
    public function jobs()
    {
        return $this->belongsToMany(RecruitmentFormOccupation::class, 'office_jobs', 'office_id', 'job_id');
    }
    public function religions()
    {
        return $this->belongsToMany(RecruitmentFormReligion::class, 'office_religions', 'office_id', 'religion_id');
    }
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'office_skills');
    }
    public function bankCountry()
    {
        return $this->belongsTo(country::class, 'office_bank_country');
    }
    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }

}

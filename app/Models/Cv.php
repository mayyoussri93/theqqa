<?php

namespace App\Models;


use App\Models\User;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Cv extends Model
{
    use SoftDeletes;
    use LogsActivity;
    protected $guarded = [];
//    protected $with=['officeRelation'];
    protected $fillable=[
//        'rent_status',
        'images',
        'new_image',
        'transfer_pic',
        'passport_id',
//        'biography_type',
        'salary',
        'cv_rev_type',
//        'is_rent',
        'service_price',
        'national_id',
        'occuption_id',
        'skills',
        'cv_log_id',
        'social_id',
        'age_id',
        'region_id',
        'personal_image',
        'lang_id',
        'lang_percentage',
        'lang_merage',
        'exper_id',
        'country_id',
        'is_booking',
        'is_sale',
        'office',
        'cvs_name',
        'passport_release_date',
        'passport_release_place',
        'passport_finish_release_date',
        'duration_contract',
        'child_num',
        'learning',
        'is_rapid',
        'birth_date',
        'place_birth',
        'experience_country',
        'years',
        'is_year_or_mouth',
        'weight',
        'length',
        'merge_check',
        'for_campany',
        'cv_rank',
        'airport_id',
        'ticket_date',
        'arrived_time',
        'ticket_image',
        'trip_num',
        'added_by',
        'profile_dropdown',
        'cv_url',
//        'residency_expire_number',
//        'residency_expire_date',
        'is_out',
        'transfered_to_rent_by',
        'transfered_from_rent_by',
        'deleted_by',
        'arrived_date',
        'expired_date',
        'throwback_date'];
    protected static $logAttributes = ["*"];
    protected static $logOnlyDirty = true;

    public function getLogNameToUse(): ?string
    {
        return 'السيرة الذاتية';
    }
    public function getDescriptionForEvent(string $eventName): string
    {

        if($eventName =="created") {
            return "تم اضافة سيرة الذاتية  جديدة عن طريق هذا الموظف ";
        }elseif ($eventName =="updated"){
            return "تم تعديل السيرة الذاتية عن طريق هذا الموظف ";

        }elseif ($eventName =="deleted"){
            return "تم مسح السيرة الذاتية  عن طريق هذا الموظف ";

        }
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();

        // Chain fluent methods for configuration options
    }

    public function getTicketDateAttribute($date)
    { if($date !=null){
        return Carbon::parse($date)->format('Y-m-d');

    }
    else {
        return $date;
    }
    }
    public function scopeRecruitingBiographyType($query)
    {
        return $query->where('biography_type', "1");
    }
    public function scopeRentBiographyType($query)
    {
        return $query->where('biography_type', "2");
    }
    public function scopeSold($query)
    {
        return $query->where('is_sale', 0);
    }
    public function scopeRapid($query)
    {
        return $query->where('is_rapid', 0);
    }
    public function scopeBooking($query)
    {
        return $query->where('is_booking', 0);
    }
    public function scopeIsRecruitment($query)
    {
        return $query->where('cv_rev_type', 1);
    }
    public function resvertions()
    {
        return $this->hasOne(Reservation::class,'cv_id');
    }
    public function airport(){
        return $this->hasOne(Airport::class,'id','airport_id');
    }
    public function getSkillsAttribute()
    {
        if($this->attributes['skills']!= "null" or $this->attributes['skills']!= null) {
            $skills=Skill::find(json_decode($this->attributes['skills']));

            if(!empty($skills)){
                $data =$skills->pluck('name')->toArray();
                return $data;

            }else {
                return null;
            }

        }else {
            return null;
        }
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'national_id');
    }

    public function officeRelation()
    {
        return $this->belongsTo(Office::class, 'office');
    }

    public function recruitmentFormOccupation()
    {
        return $this->belongsTo(RecruitmentFormOccupation::class, 'occuption_id');
    }

    public function recruitmentFormSocialStatus()
    {
        return $this->belongsTo(RecruitmentFormSocialStatus::class, 'social_id');
    }

    public function recruitmentFormAge()
    {
        return $this->belongsTo(RecruitmentFormAge::class, 'age_id');
    }

    public function recruitmentFormReligion()
    {
        return $this->belongsTo(RecruitmentFormReligion::class, 'region_id');
    }

    public function recruitmentFormLanguage()
    {
        return $this->belongsTo(RecruitmentFormLanguage::class, 'lang_id');
    }

    public function recruitmentFormExperience()
    {
        return $this->belongsTo(RecruitmentFormExperience::class, 'exper_id');
    }
    public function getCvDataExportAttribute()
    {
        $data=[];

        $data['worker_name']=$this->cvs_name?? "--";
        $data['passport_id']=$this->passport_id??'--';
        $data['office']=$this->officeRelation->name??"--";
        $data['nationality']=$this->nationality->name ??"--";
        $data['added_by']=($this->added_by!=null) ?((User::find($this->added_by)->name)??"--"):"--";
        $data['created_at']=$this->created_at;
//        $data['biography_type']=$this->biography_type;
        $data['is_booking']=$this->is_booking;
        $data['rent_status']=$this->rent_status;
        $data['cv_rev_type']=$this->cv_rev_type;

        $data['check_reservations_status'] =$this->resvertions->status??null;
        $data['contract_id'] =$this->resvertions->contract->id??null;

        $data['deportation_status']= $this->resvertions->contract->deportation_status??null;
        return $data ;
    }
    public function getCvDataFrontAttribute()
    {
        $data = [];

        $data['recruitmentFormOccupation'] = $this->recruitmentFormOccupation->name ?? '';
        $data['passport_id'] = $this->passport_id ?? '--';
        $data['office'] = $this->officeRelation->name ?? "--";
        $data['nationality'] = $this->nationality->name ?? "--";
        $data['recruitmentFormReligion'] = $this->recruitmentFormReligion->name ?? '';
        $data['service_price'] = $this->service_price ?? $this->nationality->salary;
        $data['recruitmentFormSocialStatus'] = ($this->recruitmentFormSocialStatus != null) ? translate($this->recruitmentFormSocialStatus->name) : "--";
        $data['recruitmentFormOccupation'] = ($this->salary != 0) ? $this->salary . translate(" ريال / شهر ") : "--";
        if ($this->recruitmentFormOccupation->id != null && $this->recruitmentFormOccupation->id == 5){
            $data['recruitmentFormOccupationName'] = translate('راتب السائق');
        }else {
            $data['recruitmentFormOccupationName'] = translate('راتب العاملة');
        }
        $data['recruitmentFormExperience']=($this->recruitmentFormExperience !=null)?translate($this->recruitmentFormExperience->name):"--";
        $data['id']=$this->id;
        $data['is_booking']=$this->is_booking;
        $data['images'] =$this->images??null;
        $data['new_image'] =$this->new_image??null;
        return $data ;
    }

    public function scopeFilterByAge($query,$id)
    {
        if ($id != null) {
            $age = RecruitmentFormAge::findOrFail($id);
            $query->whereBetween('age_id', [$age->from, $age->to]);


        }
    }




    public function scopeFilterByOccupation($query,$id)
    {
        if ($id != null) {
            $query->where('occuption_id',$id);


        }
    }

    public function scopeFilterByNationality($query,$id)
    {
        if ($id != null) {
            $query->where('national_id',$id);

        }
    }

    public function scopeFilterByReligion($query,$id)
    {
        if ($id != null) {
            $query->where('region_id',$id);

        }
    }

//    public function scopeFilterByReligion($query, $id)
//    {
//        if ($id != null) {
//            if (in_array($id, [1, 3])) {
//                $query->whereIn('region_id', [1, 3]);
//            } elseif (in_array($id, [2, 4])) {
//                $query->whereIn('region_id', [2, 4]);
//            }
//        }
//    }

    public function scopeFilterByExperience($query,$id)
    {
        if ($id != null) {
            $query->where('exper_id',$id);

        }
    }

}

<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class RecruitmentForm extends Model
{
    protected $table='recruitment_form';
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }



    public function recruitmentFormOccupation(){
        return $this->belongsTo(RecruitmentFormOccupation::class,'occuption_id');
    }

    public function recruitmentFormSocialStatus(){
        return $this->belongsTo(RecruitmentFormSocialStatus::class,'social_id');
    }

    public function recruitmentFormAge(){
    return $this->belongsTo(RecruitmentFormAge::class,'age_id');
    }


    public function recruitmentFormReligion(){
        return $this->belongsTo(RecruitmentFormReligion::class,'region_id');
    }

    public function recruitmentFormLanguage(){
        return $this->belongsTo(RecruitmentFormLanguage::class,'lang_id');
    }

    public function recruitmentFormExperience(){
        return $this->belongsTo(RecruitmentFormExperience::class,'exper_id');
    }
    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }

}
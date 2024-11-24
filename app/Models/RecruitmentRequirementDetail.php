<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecruitmentRequirementDetail extends Model
{
protected $table="recruitment_requirements_details";
    public function recruitmentRequirement()
    {
        return $this->belongsTo(RecruitmentRequirement::class,'recruitment_requirement_id');
    }
}

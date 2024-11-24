<?php

namespace App\Models;


use App\Models\User;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class CvPreviousSponsor extends Model
{
    protected $table="cv_previous_sponsor";

    use SoftDeletes;

    public function scopeApperFront($query)
    {
        return $query->where('apper_front', 1);
    }
    public function scopeIsWantWork($query)
    {
        return $query->where('is_want_work', 1);
    }

    public function getIsWantWorkAttribute($status)
    {
        if( $status===""){
            return null;
        }elseif (  $status===0){
            return 0;
        }
        elseif ($status===1){
            return 1;
        }
    }
//    public function cv()
//    {
//        return $this->belongsTo(Cv::class, 'cv_id');
//    }
    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }


    public function scopeFilterByAge($query,$id)
    {

        if ($id != null) {
            $query->withWhereHas('contract.reservation.cv', function ($q)use ($id) {
                $age = RecruitmentFormAge::findOrFail($id);
                $q->whereBetween('age_id', [$age->from, $age->to]);
            });

        }
    }


    public function scopeFilterByNationality($query,$id)
    {

        if ($id != null) {
            $query->withWhereHas('contract.reservation.cv', function ($q)use ($id) {
                $q->where('national_id', $id);
            });

        }
    }

}

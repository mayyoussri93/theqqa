<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class  ReservationSponsor extends Model
{
    protected $table='reservation_sponsor';
    protected $guarded = [];
    use SoftDeletes;
    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }
    public function adminSponsor()
    {
        return $this->belongsTo(User::class,'administrator_id','id');
    }
    public function deletedBY()
    {
        return $this->belongsTo(User::class,'deleted_by','id');
    }
    public function oldGuarantor()
    {
        return $this->belongsTo(User::class,'old_guarantor_id','id');
    }
    public function newGuarantor()
    {
        return $this->belongsTo(User::class,'new_guarantor_id','id');
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


class FinancialRequest extends Model
{
    protected $guarded = [];
    public function setReceivedDateAttribute($value)
    {
        $this->attributes['received_date'] = date('Y/m/d', strtotime($value));
    }
    public function setReturnDateAttribute($value)
    {
        $this->attributes['return_date'] = date('Y/m/d', strtotime($value));
    }
    public function financialRequestType(){
        return $this->belongsTo(FinancialRequestType::class,'financial_request_id');
    }
    public function admin(){
        return $this->belongsTo(User::class,'user_id');
    }


}

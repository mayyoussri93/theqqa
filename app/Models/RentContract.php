<?php

namespace App\Models;

use Carbon\Carbon;
use Google\Service\SecurityCommandCenter\Cve;
use Illuminate\Database\Eloquent\Model;

class RentContract extends Model
{
    protected $guarded = [];
protected $fillable=[
    'user_id',
    'administrator_id',
    'amount_sponsorship_transfer',
    'salary_transfer_sponsorship',
    'monthly_cost',
    'hourly_rate',
    'monthly_salary',
    'cv_id',
    'rent_contract_value',
    'date_contract',
    'working_hours',
    'previous_sponsor',
    'contract_count_day',
    'contract_from_day',
    'contract_to_day'
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function administrator()
    {
        return $this->belongsTo(User::class,'administrator_id','id');
    }
    public function cv()
    {
        return $this->belongsTo(Cv::class,'cv_id','id');
    }
    public function setDateContractAttribute($date)
    {

        $this->attributes['date_contract'] = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');;
    }
    public function setContractFromDayAttribute($date)
    {

        $this->attributes['contract_from_day'] = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');;
    }
    public function setContractToDayAttribute($date)
    {
        $this->attributes['contract_to_day'] = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');;
    }
}

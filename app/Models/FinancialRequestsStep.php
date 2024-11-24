<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class FinancialRequestsStep extends Model
{
    protected $guarded = [];

    public function financialRequest()
    {
        return $this->belongsTo(FinancialRequest::class,'request_id');
    }

    public function admin(){
        return $this->belongsTo(User::class,'user_id');
    }

}

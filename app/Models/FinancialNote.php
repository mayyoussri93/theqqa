<?php

namespace App\Models;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class FinancialNote extends Model
{
    protected $guarded = [];

    public function financial_request(){
        return $this->belongsTo(FinancialRequest::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}

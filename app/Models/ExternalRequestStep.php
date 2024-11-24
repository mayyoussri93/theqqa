<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExternalRequestStep extends Model
{
    protected $table = "external_requests_steps";
    protected $guarded = [];

    public function externalRequest()
    {
        return $this->belongsTo(ExternalRequest::class,'request_id');
    }

    public function admin(){
        return $this->belongsTo(User::class,'user_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExternalRequestType extends Model
{
    protected $table = "external_requests_types";

    protected $fillable = ['name','user_id'];
//    public function externalRequests(){
//        return $this->hasOne(ExternalRequest::class,'external_request_type_id');
//    }
    //

}

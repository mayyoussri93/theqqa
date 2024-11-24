<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExternalRequest extends Model
{
    protected $table = "external_requests";
    protected $fillable = ['request_type','user_id','title','subject','attatches','pending'];
//    protected $guarded = [];
    public function externalRequestType(){
        return $this->belongsTo(ExternalRequestType::class,'external_request_type_id');
    }

    public function department(){
        return $this->belongsTo(Department::class,'to_department_id');
    }

    public function admin(){
        return $this->belongsTo(User::class,'user_id');
    }
    //

}

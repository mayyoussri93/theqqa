<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ExternalRequest;
use App\Models\User;
class ExternalNote extends Model
{
    protected $table = "external_notes";
    protected $guarded = [];

    public function external_request(){
        return $this->belongsTo(ExternalRequest::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}

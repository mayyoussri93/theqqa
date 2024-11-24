<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Central extends Model
{
 protected $table="central";
 protected $fillable=['edit_by','phone','status','employee_by','details','date','time','central_ids','client_name','call_duration','take_duration','call_type','contact_id'];
    public function user()
    {
        return $this->belongsTo(User::class,'employee_by');
    }
}

<?php

namespace App\Models;


use App\Models\User;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use SoftDeletes;

   public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }



}

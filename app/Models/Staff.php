<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $with=['user'];
    protected $guarded = [];
    public function user()
    {
    return $this->belongsTo(User::class);
    }
    public function nationality()
    {
        return $this->belongsTo(Nationality::class,'national_id');
    }

    public function role()
    {
    return $this->belongsTo(Role::class);
    }

    public static function withExternalRequests()
    {
        return self::whereHas('user.externalRequests')->get();
    }

}

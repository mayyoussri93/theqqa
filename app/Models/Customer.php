<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;


class Customer extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function reservation(){
        return $this->hasMany(Reservation::class,'user_id');

    }
    public function accommodationType()
    {
        return $this->belongsTo(AccommodationType::class, 'office_city');
    }
}

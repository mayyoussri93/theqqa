<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class City extends Model
{
    public function country()
    {
        return $this->belongsTo(App\Models\Country::class);
    }


}

<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class LodgingNotes extends Model
{
    protected $fillable = [];

    public function contract()
    {
        return $this->belongsTo(Contract::class,'contract_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'added_by');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Ticket extends Model
{
    public function scopeStatus($query,$status)
    {
        return $query->where('status',$status);
    }
    public function admin(){
        return $this->belongsTo(User::class,'admin_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function ticketreplies()
    {
        return $this->hasMany(TicketReply::class)->orderBy('created_at', 'desc');
    }

}

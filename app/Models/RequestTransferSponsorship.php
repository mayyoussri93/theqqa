<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestTransferSponsorship extends Model
{
protected $table="request_transfer_sponsorship";
    protected $fillable = ['user_id', 'cv_sponsorship_id', 'sponsor_staff_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function admin()
    {
        return $this->belongsTo(User::class, 'sponsor_staff_id');
    }
    public function cvPreviousSponsor()
    {
        return $this->belongsTo(CvPreviousSponsor::class, 'cv_sponsorship_id');
    }
}

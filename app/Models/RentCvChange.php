<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class RentCvChange extends Model
{
    protected $fillable = [  'user_id',
        'old_cv',
        'new_cv','contact_id'];
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function oldCv()
    {
        return $this->belongsTo(Cv::class,'old_cv');
    }
    public function newCv()
    {
        return $this->belongsTo(Cv::class,'new_cv');
    }
}

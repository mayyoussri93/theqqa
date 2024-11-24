<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function commment_replies()
    {
        return $this->hasMany(CommentReply::class)->orderBy('created_at', 'desc');
    }

}

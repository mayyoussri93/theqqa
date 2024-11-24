<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommonTopic extends Model
{
    protected $table = 'common_topics';

    public function readCommonTopic() {
        return $this->hasMany(ReadCommonTopic::class,'topic_id');
    }
}

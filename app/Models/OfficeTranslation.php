<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficeTranslation extends Model
{
    protected $fillable = ['lang', 'office_id', 'name'];
    public function office()
    {
        return $this->belongsTo(Office::class);
    }
}

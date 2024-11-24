<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Concession extends Model
{
    protected $table = "Concessions";

    protected $fillable = ['name', 'religion','age','experience','experience_years', 'image','note'];

}

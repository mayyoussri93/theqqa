<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractSource extends Model
{
    use HasFactory;
    protected $table="contract_sources";
    protected $guarded = [];

    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

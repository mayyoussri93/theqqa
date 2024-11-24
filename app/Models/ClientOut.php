<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
/**
 * App\Models\ClientOut
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $phone
 * @property string|null $service
 * @property string|null $city
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientOut newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientOut newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientOut query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientOut whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientOut whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientOut whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientOut whereUpdatedAt($value)
 * @mixin \Eloquent
 */

class ClientOut extends Model
{
   public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}

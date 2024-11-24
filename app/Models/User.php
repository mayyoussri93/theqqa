<?php

namespace App\Models;

use App\Models\Reservation;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use App\Notifications\EmailVerificationNotification;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use LogsActivity;
    protected static $logAttributes = ["*"];
    protected static $logOnlyDirty = true;

    public function getLogNameToUse(): ?string
    {
        return 'المستخدم';
    }
    public function getDescriptionForEvent(string $eventName): string
    {

        if($eventName =="created") {
            return "تم اضافة مستخدم جديد عن طريق هذا الموظف ";
        }elseif ($eventName =="updated"){
            return "تم تعديل المستخدم  عن طريق هذا الموظف ";

        }elseif ($eventName =="deleted"){
            return "تم مسح المستخدم عن طريق هذا الموظف ";

        }
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();

        // Chain fluent methods for configuration options
    }
    public function sendEmailVerificationNotification()
    {
        $this->notify(new EmailVerificationNotification());
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'address', 'city', 'postal_code', 'phone', 'country', 'provider_id', 'phone_verified_at', 'verification_code', 'nationality_id', 'user_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeName($query,$name)
    {
        return $query->where('name', 'like', '%' . $name . '%');
    }
    public function scopePhone($query,$phone)
    {
        return $query->where('phone', 'like', '%' . $phone . '%');
    }
    public function customer()
    {
        return $this->hasOne(Customer::class);
    }




    public function staff()
    {
        return $this->hasOne(Staff::class);
    }
    public function externalRequests()
    {
        return $this->hasMany(ExternalRequest::class, 'user_id');
    }





    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
    public function reservation()
    {
        return $this->hasMany(Reservation::class, 'user_id');
    }

    public function nationality()
    {
        return $this->belongsTo(Country::class,'nationality_id','id');
    }
    public function getPhoneWhatsappExportAttribute()
    {
     return preg_replace('/[^0-9]/', '',  $this->whatsapp_phone);

    }
}

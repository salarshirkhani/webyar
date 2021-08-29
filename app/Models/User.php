<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Rinvex\Subscriptions\Traits\HasSubscriptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;
    use HasSubscriptions;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'birthdate', 'situation', 'password', 'type', 'mobile'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at', 'email', 'email_verified_at'
    ];

    protected $appends = [
        'name'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getNameAttribute() {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function Absence() {
        return $this->hasOne('App\Models\Absence', 'employee_id');
    }

    public function Payment() {
        return $this->hasOne('App\Models\Payment', 'employee_id');
    }

    public function messages() {
        return $this->hasMany('App\Models\messages', 'user_id');
    }

    public function messagesend() {
        return $this->hasMany('App\Models\messages', 'sender_id');
    }

    public function enquiries() {
        return $this->hasMany('App\Enquiry', 'employee_id');
    }

    public function defaultSubscription() {
        return $this->subscription("{$this->type}-{$this->id}");
    }

    public function newDefaultSubscription($plan) {
        return $this->newSubscription("{$this->type}-{$this->id}", $plan);
    }

    public function routeNotificationForSms() {
        return $this->mobile;
    }
}

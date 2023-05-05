<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Webpatser\Uuid\Uuid;

use App\UserDetail;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'id';
    public $timestamps = true;
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 
        'password',
        'role',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        self::creating(function($model) {
            $model->id = Uuid::generate()->string;
        });
    }

    public function details()
    {
        return $this->hasOne('App\UserDetail', 'user_id', 'id');
    }

    public function billingAddresses()
    {
        return $this->hasMany('App\BillingAddress', 'user_id', 'id');
    }

    public function shippingAddresses()
    {
        return $this->hasMany('App\ShippingAddress', 'user_id', 'id');
    }
}

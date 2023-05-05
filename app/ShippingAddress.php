<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Webpatser\Uuid\Uuid;

class ShippingAddress extends Model
{
    protected $table = 'shipping_addresses';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        
        'first_name',
        'last_name',
        'address',
        'city',
        'postal_code',
        'phone',
        'country_code',
    ];

    protected $hidden = [
        
    ];

    protected static function boot()
    {
    	parent::boot();

    	self::creating(function($model) {
            $model->id = Uuid::generate()->string;
    	});
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
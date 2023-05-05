<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Webpatser\Uuid\Uuid;

class Shipping extends Model
{
    protected $table = 'shippings';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $incrementing = false;

    protected $fillable = [
        'shipping_code',

        'shipping_address_id',
        
        'courier',
        'done_at',
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

    public function invoice()
    {
        return $this->belongsTo('App\Invoice', 'id', 'shipping_id');
    }
}
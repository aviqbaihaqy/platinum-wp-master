<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Webpatser\Uuid\Uuid;

class Cart extends Model
{
    protected $table = 'carts';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $incrementing = false;

    protected $fillable = [
        'user_id',

        'product_id',
        'amount',
        'total',
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

    public static function getGrandTotal($user_id)
    {
        $carts = self::where('user_id', $user_id)->get();

        $grandTotal = 0;
        foreach ($carts as $cart) {
            $grandTotal += $cart->total;
        }

        return $grandTotal;
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function product()
    {
        return $this->hasOne('App\Product', 'id', 'product_id');
    }
}
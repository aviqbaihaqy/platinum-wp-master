<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Webpatser\Uuid\Uuid;

class StocksRecord extends Model
{
    protected $table = 'stocks_records';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $incrementing = false;

    protected $fillable = [
        'product_id',
        
        'event',
        
        'amount',

        'details',

        'executor_id',
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

    public function product()
    {
        return $this->hasOne('App\Product', 'product_id', 'id');
    }
}
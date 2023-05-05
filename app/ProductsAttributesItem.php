<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Webpatser\Uuid\Uuid;

class ProductsAttributesItem extends Model
{
    protected $table = 'products_attributes_items';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $incrementing = false;

    protected $fillable = [
        'products_attribute_id',
        
        'value',
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

    public function productAttribute()
    {
        return $this->belongsTo('App\ProductsAttributes', 'products_attribute_id', 'id');
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Webpatser\Uuid\Uuid;

class ProductsAttribute extends Model
{
    protected $table = 'products_attributes';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $incrementing = false;

    protected $fillable = [
        'product_id',

        'attribute_name',
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
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }

    public function values()
    {
        return $this->hasMany('App\ProductsAttributesItem', 'products_attribute_id', 'id');
    }
}
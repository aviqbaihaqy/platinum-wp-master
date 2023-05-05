<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Webpatser\Uuid\Uuid;

class ProductsTerm extends Model
{
    protected $table = 'products_terms';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $incrementing = false;

    protected $fillable = [
        'product_id',
        'warranty_unit',
        'warranty_terms',
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
        return $this->belongsTo('App\Product', 'id', 'product_id');
    }
}
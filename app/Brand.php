<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Webpatser\Uuid\Uuid;

class Brand extends Model
{
    protected $table = 'brands';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $incrementing = false;

    protected $fillable = [
        'brand_logo',
        'name'
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

    public static function uploadPhoto($fileRequest)
    {
        $fileName = 'uploads/products/';
        $fileName .= '[ ' . Carbon::now()->format('Y-m-d H:i:s') . ' ]'; 
        $fileName .= $fileRequest->getClientOriginalName();

        $fileRequest->move(public_path(), $fileName);

        return $fileName;
    }

    public function products()
    {
        return $this->hasMany('App\Product', 'brand_id', 'id');
    }
}
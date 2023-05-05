<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Webpatser\Uuid\Uuid;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $incrementing = false;

    protected $fillable = [
        'name',
        'background_image',
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
        $destination = 'uploads/products/';
        
        $fileName = $destination . '[' . Carbon::now()->format('Y-m-d H:i:s') . ']'; 
        $fileName .= $fileRequest->getClientOriginalName();

        $fileRequest->move(public_path($destination), $destination . $fileName);

        return $fileName;
    }

    public function subcategories()
    {
        return $this->hasMany('App\SubCategory', 'category_id', 'id');
    }
}
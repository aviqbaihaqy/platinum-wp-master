<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Webpatser\Uuid\Uuid;

use App\SubCategory;
use App\Stock;
use App\ProductPhoto;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $incrementing = false;

    protected $fillable = [
        'product_code',

        'name',
        'uri',
        'price',
        'buying_price',

        'subcategory_id',

        'status',
        'description',

        'is_favourite',
    ];

    protected $hidden = [
        
    ];

    protected static function boot()
    {
    	parent::boot();

    	self::creating(function($model) {
            $model->id = Uuid::generate()->string;
            $model->uri = self::generateUri($model->name);

            // assigning category from sub category data
            $subcategory = SubCategory::findOrFail($model->subcategory_id);
            $model->category_id = $subcategory->category_id;
    	});

        self::updating(function($model) {
            if ($model->isDirty('name'))
                $model->uri = self::generateUri($model->name);
        });
    }

    public static function generateUri($productName)
    {
        return str_replace(' ', '-', strtolower($productName));
    }

    public static function createStock($id, $amount)
    {
        $stock = new Stock();

        $stock->product_id = $id;
        $stock->amount = $amount;

        return $stock->save();
    }

    public static function savePhoto($product_id, $file)
    {
        $photo = new ProductsPhoto();

        $photo->product_id = $product_id;
        $photo->directory = $photo->uploadPhoto($file);
        
        $photo->save();
    }

    public static function search($search = '')
    {
        $results = self::where('name', 'like', '%' . $search . '%')->get();

        return $results;
    }

    public static function searchPaginate($search = '')
    {
        $results = self::where('name', 'like', '%' . $search . '%')->paginate();

        return $results;
    }

    public function subcategory()
    {
        return $this->belongsTo('App\SubCategory', 'subcategory_id', 'id');
    }

    public function attributes()
    {
        return $this->hasMany('App\ProductsAttribute')->orderBy('attribute_name');
    }

    public function photo()
    {
        return $this->hasOne('App\ProductsPhoto', 'product_id', 'id');
    }

    public function photos()
    {
        return $this->hasMany('App\ProductsPhoto', 'product_id', 'id');
    }

    public function banner()
    {
        return $this->hasOne('App\ProductsBanner', 'product_id', 'id');
    }

    public function stock()
    {
        return $this->hasOne('App\Stock', 'product_id', 'id');
    }

    public function dimensions()
    {
        return $this->hasMany('App\ProductsDimension', 'product_id', 'id');
    }

    public function term()
    {
        return $this->hasOne('App\ProductsTerm', 'product_id', 'id');
    }
}
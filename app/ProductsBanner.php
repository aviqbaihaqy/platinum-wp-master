<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Webpatser\Uuid\Uuid;

use Carbon\Carbon;

class ProductsBanner extends Model
{
    protected $table = 'products_banners';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $incrementing = false;

    protected $fillable = [
        'product_id',
        'directory',
    ];

    protected $hidden = [
        
    ];

    protected static function boot()
    {
        parent::boot();

        self::creating(function($model) {
            $model->id = Uuid::generate()->string;
        });

        self::updating(function($model) {
            $model->removeFromFolder($model->directory);
        });

        self::deleting(function($model) {
            self::removeFromFolder($model->directory);
        });
    }

    public static function uploadBanner($fileRequest)
    {
        $destination = 'uploads/products/banners/';
        
        $fileName = $destination . '[' . Carbon::now()->format('Y-m-d H:i:s') . ']'; 
        $fileName .= $fileRequest->getClientOriginalName();

        $fileRequest->move(public_path($destination), $destination . $fileName);

        return $fileName;
    }

    /**
     * Remove photo to public folder.
     *
     * @param  \Illuminate\Http\Request  $fileName
     * @return null
     */
    public static function removeFromFolder($fileName)
    {
        try {
            $delete = File::delete($fileName);
        } catch (Exception $e) {
            $delete = $e->getMessage();
        }

        return $delete;
    }

    public function product()
    {
        return $this->belongsTo('App\Product', 'id', 'product_id');
    }
}
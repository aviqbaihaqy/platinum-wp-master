<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Webpatser\Uuid\Uuid;
use \Carbon\Carbon;

use App\User;

class UserDetail extends Model
{
    protected $table = 'user_details';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $incrementing = false;

    protected $fillable = [
        'user_id',

        'profile_photo',
        
        'nip',
        'first_name',
        'last_name',
        'address',
        'city',
        'postal_code',
        'phone',
        'country_code',
        'company',
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
        $destination = 'uploads/profiles_pictures/';
        
        $fileName = $destination . '[' . Carbon::now()->format('Y-m-d H:i:s') . ']'; 
        $fileName .= $fileRequest->getClientOriginalName();

        $fileRequest->move(public_path($destination), $destination . $fileName);

        return $fileName;
    }
}
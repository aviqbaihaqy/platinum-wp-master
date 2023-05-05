<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Webpatser\Uuid\Uuid;
use Carbon\Carbon;

class Visitor extends Model
{
    protected $table = 'visitors';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $incrementing = false;

    protected $fillable = [
        'ip_address',
        'hits',
        'last_visit',
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

    public static function hit() {
        $ipAddress = (string) $_SERVER['REMOTE_ADDR'];

        $visitor = self::where('ip_address', $ipAddress)
            ->get()
            ->first();

        $now = Carbon::now();
        $startOfDay = $now->copy()->startOfDay();

        if($visitor)
            $startOfDay >= $visitor->last_visit ? $visitor->hits++ : null;
        else
            $visitor = new self(['ip_address' => $ipAddress]);

        $visitor->last_visit = Carbon::now();
        $visitor->save();
    }
}
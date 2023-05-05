<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Midtrans extends Model
{
    protected $table = 'midtrans';
    protected $primaryKey = 'snap_token';
    public $timestamps = true;
    public $incrementing = false;

    protected $fillable = [
        'snap_token',
        'snap_response', // JSON
    ];

    protected static function boot()
    {
    	parent::boot();
    }

    public static function updateTransaction($model)
    {
        $response = json_decode($model->snap_response);
        
        $transaction = $model->transaction;
        $transaction->status = $response->transaction_status;
        $transaction->save();
    }

    public function saveResponse($snap_response)
    {
        $this->attributes['snap_response'] = json_encode($snap_response);
        self::save();

        return self::updateTransaction($this);
    }

    public function transaction()
    {
        return $this->belongsTo('App\Transaction', 'snap_token', 'midtrans_snap_token');
    }
}
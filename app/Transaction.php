<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Webpatser\Uuid\Uuid;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $incrementing = false;

    protected $fillable = [
        'payment_method',
        'midtrans_snap_token',
        'shipping_address_id',
        'payer_id',
        'payer_name',
        'status',
    ];

    protected $hidden = [
        
    ];

    protected static function boot()
    {
    	parent::boot();

    	self::creating(function($model) {
            $model->id = Uuid::generate()->string;
    	});

        self::updated(function($model) {
            $newStatus = $model->status;

            // Updating the invoice data
            if($model->payment_method == 'midtrans') {
                $invoice = $model->invoice;
                if($newStatus == 'settlement')
                    $invoice->status = 'paid';
                else
                    $invoice->status = 'unpaid';
                $invoice->save();
            }
        });
    }

    public function invoice()
    {
        return $this->belongsTo('App\Invoice', 'id', 'transaction_id');
    }

    public function billingAddress()
    {
        return $this->hasOne('App\BillingAddress', 'billing_address_id', 'id');
    }

    public function shippingAddress()
    {
        return $this->hasOne('App\ShippingAddress', 'id', 'shipping_address_id');
    }

    public function payer()
    {
        return $this->hasOne('App\User', 'payer_id', 'id');
    }

    public function midtrans()
    {
        return $this->hasOne('App\Midtrans', 'snap_token', 'midtrans_snap_token');
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;
use Webpatser\Uuid\Uuid;
use Carbon\Carbon;

class Invoice extends Model
{
    protected $table = 'invoices';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'client_name',

        'invoice_code',
        'discount',
        'grand_total',

        'transaction_id',
        'shipping_id',

        'sales_name',

        'status',
        'payment_due',

        'created_at',
    ];

    protected $hidden = [
        
    ];

    protected static function boot()
    {
    	parent::boot();

    	self::creating(function($model) {
            $model->id = Uuid::generate()->string;
            $model->payment_due = Carbon::now()->copy()->endOfDay();
            $model->invoice_code = Uuid::generate()->string;

            if(Auth::user()->role != 'user')
                $model->inputter_id = Auth::user()->id;
    	});

        self::updated(function($model) {
            if($model->isDirty('status') && $model->status == 'shipped') {
                self::deliverItems($model);
            }
        }); 
    }

    public static function deliverItems($model)
    {
        // get all invoice items
        $invoiceItems = $model->items;

        $undeliveredItems = $invoiceItems->where('delivery_status', 'undelivered');
        foreach ($undeliveredItems as $item) {
            $item->delivery_status = 'delivered';
            $save = $item->save();

            if($save) {
                // get stok data
                $product = $item->product;
                $stock = $product->stock;

                // update stock
                $stock->amount -= $item->amount; // decrease the amount
                $stock->save();
            }
        }
    }

    public function client()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function inputter()
    {
        return $this->belongsTo('App\User', 'inputter_id', 'id');
    }

    public function items()
    {
        return $this->hasMany('App\InvoiceItem', 'invoice_id', 'id');
    }

    public function shipping()
    {
        return $this->hasOne('App\Shipping', 'id', 'shipping_id');
    }

    public function transaction()
    {
        return $this->hasOne('App\Transaction', 'id', 'transaction_id');
    }
}
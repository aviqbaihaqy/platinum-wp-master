<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Webpatser\Uuid\Uuid;

class InvoiceItem extends Model
{
    protected $table = 'invoice_items';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $incrementing = false;

    protected $fillable = [
        'invoice_id',

        'product_id',
        'amount',
        'total',

        'note',

        'delivery_status',
    ];

    protected $hidden = [
        
    ];

    protected static function boot()
    {
    	parent::boot();

    	self::creating(function($model) {
            $model->id = Uuid::generate()->string;
    	});

        self::created(function($model) {
            self::updateInvoiceTotal($model);
        });

        self::updated(function($model) {
            self::updateInvoiceTotal($model);
        });

        self::deleting(function($model) {
            $model->invoice->grand_total -= $model->total;
            $model->invoice->save();
        });
    }

    public static function updateInvoiceTotal($model)
    {
        $invoice = $model->invoice;

        $grandTotal = 0;

        foreach($invoice->items as $key => $item) {
            $grandTotal += $item->total;
        }

        $invoice->grand_total = $grandTotal - $invoice->discount;
        $invoice->save();
    }

    public function product()
    {
        return $this->hasOne('App\Product', 'id', 'product_id');
    }

    public function invoice()
    {
        return $this->belongsTo('App\Invoice', 'invoice_id', 'id');
    }
}
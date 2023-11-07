<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerLedger extends Model
{
    protected $table = 'customer_ledgers';

    protected $fillable = [
        'person_id', 'product_id', 'quantity', 'total_amount', 'payment_id', 'discount_id', 'voucher_id'
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}

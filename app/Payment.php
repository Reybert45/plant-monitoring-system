<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'or_no', 'ar_no', 'amount_paid', 'transaction_date'
    ];

    public function customer_ledgers()
    {
        return $this->hasMany(CustomerLedger::class);
    }

    public function payment_methods()
    {
        return $this->hasMany(PaymentMethod::class);
    }
}

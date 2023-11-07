<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerOrderStatus extends Model
{
    protected $table = 'customer_order_statuses';

    protected $fillable = ['name'];

    public function customerOrder()
    {
        return $this->belongsTo(CustomerOrder::class);
    }
}

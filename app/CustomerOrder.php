<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerOrder extends Model
{
    protected $table = 'customer_orders';

    protected $fillable = [
        'person_id', 'product_id', 'product_quantity', 'addon_id', 'addon_quantity', 'order_date', 'order_time', 'customer_order_status_id', 'created_by_id', 'updated_by_id'
    ];

    public function customer_order_statuses()
    {
        return $this->hasMany(CustomerOrderStatus::class);
    }
}

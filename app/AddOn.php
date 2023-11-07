<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddOn extends Model
{
    protected $table = 'addons';

    protected $fillable = [
        'name', 'description', 'price', 'quantity', 'product_id'
    ];

    public function product() 
    {
        return $this->belongsTo(Product::class);
    }
}

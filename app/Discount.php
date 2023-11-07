<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discounts';

    protected $fillable = [
        'name', 'description', 'percentage_amount', 'fixed_amount'
    ];
}

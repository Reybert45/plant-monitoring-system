<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = 'vouchers';

    protected $fillable = [
        'name', 'description', 'percentage_amount', 'fixed_amount'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddressStatus extends Model
{
    protected $table = 'address_statuses';

    protected $fillable = ['name'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fertilizer extends Model
{
    protected $table = 'fertilizers';
    protected $fillable = ['name'];
}

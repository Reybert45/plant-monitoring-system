<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    protected $table = 'barangays';
    protected $fillable = ['name', 'street_id'];

    public function street()
    {
        return $this->belongsTo(Street::class);
    }
}

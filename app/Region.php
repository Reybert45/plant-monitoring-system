<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'regions';
    protected $fillable = ['name', 'barangay_id'];

    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }
}

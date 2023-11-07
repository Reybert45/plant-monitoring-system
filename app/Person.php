<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'people';

    protected $fillable = [
        'first_name', 'last_name'
    ];

    public function suffix() 
    {
        return $this->belongsTo(Suffix::class);
    }

    public function address() 
    {
        return $this->hasMany(Address::class);
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }
}

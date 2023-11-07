<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $table = 'genders';

    protected $fillable = ['name'];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}

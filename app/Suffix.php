<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suffix extends Model
{
    protected $table = 'suffixes';

    protected $fillable = ['name'];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}

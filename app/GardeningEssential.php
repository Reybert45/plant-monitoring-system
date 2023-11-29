<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GardeningEssential extends Model
{
    protected $table = 'gardening_essentials';
    protected $fillable = ['plant_id', 'essential_type_id', 'link'];
}

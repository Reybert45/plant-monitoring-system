<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HarvestedPlant extends Model
{
    protected $table = 'harvested_plants';
    protected $fillable = ['plant_id', 'quantity', 'amount', 'harvested_date', 'user_id'];

    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

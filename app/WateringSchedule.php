<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WateringSchedule extends Model
{
    protected $table = 'watering_schedules';
    protected $fillable = ['plant_id', 'watering_date', 'watering_time', 'user_id'];

    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }
}

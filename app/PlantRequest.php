<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlantRequest extends Model
{
    protected $table = 'plant_requests';
    protected $fillable = ['name', 'description', 'planting_date', 'harvest_date', 'location', 'quantity', 'price', 'plant_status_id', 'life_cycle_stage_id', 'user_id', 'fertilizer_id', 'watering_schedule', ''];

    public function plant_status()
    {
        return $this->belongsTo(PlantStatus::class);
    }
    
    public function life_cycle_stage()
    {
        return $this->belongsTo(LifeCycleStage::class);
    }

    public function fertilizer()
    {
        return $this->belongsTo(Fertilizer::class);
    }
}

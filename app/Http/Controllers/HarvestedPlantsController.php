<?php

namespace App\Http\Controllers;

use App\HarvestedPlant;
use App\Plant;
use Illuminate\Http\Request;

class HarvestedPlantsController extends AdminBaseController
{
    public function index()
    {
        return view('plant/harvested_index');
    }

    public function data()
    {
        $harvested_plants_list = HarvestedPlant::with('plant', 'plant.plant_status', 'plant.life_cycle_stage', 'plant.fertilizer')->get();
        $datatable = collect($harvested_plants_list)
            ->map(function($harvested_plant) {
                return [
                    'id' => $harvested_plant->plant->id,
                    'name' => $harvested_plant->plant->name,
                    'description' => $harvested_plant->plant->description,
                    'planting_date' => $harvested_plant->plant->planting_date,
                    'harvest_date' => $harvested_plant->harvested_date,
                    'location' => $harvested_plant->plant->location,
                    'quantity' => $harvested_plant->quantity,
                    'plant_quantity' => $harvested_plant->plant->quantity,
                    'image_url' => $harvested_plant->plant->image_url,
                    'plant_status' => $harvested_plant->plant->plant_status->name,
                    'life_cycle_stage' => $harvested_plant->plant->life_cycle_stage->name,
                    'fertilizer' => $harvested_plant->plant->fertilizer->name,
                    'plant_status_id' => $harvested_plant->plant->plant_status_id,
                    'life_cycle_stage_id' => $harvested_plant->plant->life_cycle_stage_id,
                    'fertilizer_id' => $harvested_plant->plant->fertilizer_id,
                    'watering_schedule' => $harvested_plant->plant->watering_schedule,
                    'quantity_harvested' => $harvested_plant->plant->quantity_harvested,
                ];
            });

        $datatable = $datatable->toArray();

        return view('plant/harvested_data', compact('datatable'));
    }
}

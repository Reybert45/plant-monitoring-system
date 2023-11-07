<?php

namespace App\Http\Controllers;

use App\Plant;
use Illuminate\Http\Request;

class GrowingPlantController extends AdminBaseController
{
    public function index()
    {
        return view('plant/growing_index');
    }

    public function data()
    {
        $plant_list = Plant::with('plant_status', 'life_cycle_stage', 'fertilizer')->where('plant_status_id', 1)->orderBy('name', 'asc')->get();
        $datatable = collect($plant_list)
            ->map(function($plant) {
                return [
                    'id' => $plant->id,
                    'name' => $plant->name,
                    'description' => $plant->description,
                    'planting_date' => $plant->planting_date,
                    'harvest_date' => $plant->harvest_date,
                    'location' => $plant->location,
                    'quantity' => $plant->quantity,
                    'image_url' => $plant->image_url,
                    'plant_status' => $plant->plant_status->name,
                    'life_cycle_stage' => $plant->life_cycle_stage->name,
                    'fertilizer' => $plant->fertilizer->name,
                    'plant_status_id' => $plant->plant_status_id,
                    'life_cycle_stage_id' => $plant->life_cycle_stage_id,
                    'fertilizer_id' => $plant->fertilizer_id,
                    'watering_schedule' => $plant->watering_schedule,
                ];
            });

        $datatable = $datatable->toArray();

        return view('plant/growing_data', compact('datatable'));
    }
}

<?php

namespace App\Http\Controllers;

use App\PlantRequest;
use Illuminate\Http\Request;

class PlantRequestController extends Controller
{
    public function store()
    {
        try {   
            $name = \Request::get('name');
            $quantity = \Request::get('quantity');
            $description = \Request::get('description');
            $location = \Request::get('location');
            $plant_status_id = \Request::get('plant_status_id');
            $life_cycle_stage_id = \Request::get('life_cycle_stage_id');
            $fertilizer_id = \Request::get('fertilizer_id');
            $watering_schedule = \Request::get('watering_schedule');
            $sow_depth = \Request::get('sow_depth');
            $distance_between_plants = \Request::get('distance_between_plants');
            $lowest_temperature = \Request::get('lowest_temperature');
            $highest_temperature = \Request::get('highest_temperature');
            $days_before_germination = \Request::get('days_before_germination');
            
            $messages = [
                'plant_status_id.required' => 'Plant status is required.',
                'life_cycle_stage_id.required' => 'Life cycle stage is required.',
                'fertilizer_id.required' => 'Fertilizer is required.',
                'planting_harvest_date.required' => 'Planting & harvest is required.',
            ];

            $validate = \Validator::make(\Request::all(), [
                'name' => 'required',
                'quantity' => 'required',
                'description' => 'required',
                'location' => 'required',
                'plant_status_id' => 'required',
                'life_cycle_stage_id' => 'required',
                'fertilizer_id' => 'required',
                'watering_schedule' => 'required',
                'planting_harvest_date' => 'required',
                'sow_depth' => 'required',
                'distance_between_plants' => 'required',
                'lowest_temperature' => 'required',
                'highest_temperature' => 'required',
                'days_before_germination' => 'required',
            ], $messages);
            
            if(!$validate->passes()) {
                return response()->json(['status' => 'Validated', 'message' => 'Some fields have not passed in the validation process.', 'errors' => $validate->errors(), 'timeout' => 3000]);
            }
            
            $planting_date = date('Y-m-d', strtotime(explode(" to ", \Request::get('planting_harvest_date'))[0]));
            $harvest_date = date('Y-m-d', strtotime(explode(" to ", \Request::get('planting_harvest_date'))[1]));
           
            $plant = PlantRequest::firstOrCreate([
                'name' => $name,
                'description' => $description,
                'location' => $location,
                'plant_status_id' => $plant_status_id,
                'life_cycle_stage_id' => $life_cycle_stage_id,
                'fertilizer_id' => $fertilizer_id,
            ]);
            $plant -> quantity = $quantity;
            $plant -> watering_schedule = $watering_schedule;
            $plant -> planting_date = $planting_date;
            $plant -> harvest_date = $harvest_date;
            $plant -> sow_depth = $sow_depth;
            $plant -> distance_between_plants = $distance_between_plants;
            $plant -> lowest_temperature = $lowest_temperature;
            $plant -> highest_temperature = $highest_temperature;
            $plant -> days_before_germination = $days_before_germination;
            if(\Request::hasFile('plant_file')) {
                $file = \Request::file('plant_file');
                $file_name = $file->getClientOriginalName();
                $ext = $file->getClientOriginalExtension();
                $renamed_file = str_shuffle(mt_rand(999999999, 9999999999999999).$file_name).".".$ext;

                $file->move(public_path() . '/assets/images/plants/', $renamed_file);
                $plant -> image_url = '/assets/images/plants/'. $renamed_file;
            } else {
                $plant -> image_url = '/assets/images/no-image.png';
            }
            $plant -> created_by_id = auth()->user()->id;
            $plant -> save();

            return response()->json(['status' => 'Success', 'message' => 'You have successfully added a new plant.', 'timeout' => 1000]);

        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000, 'line' => $e->getLine()]);
        }
    }
}

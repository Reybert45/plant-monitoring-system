<?php

namespace App\Http\Controllers;

use App\Fertilizer;
use App\HarvestedPlant;
use App\LifeCycleStage;
use App\Plant;
use App\PlantRequest;
use App\PlantStatus;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PlantController extends AdminBaseController
{
    public function index()
    {
        $plant_statuses_list = PlantStatus::all();
        $life_cycle_stages_list = LifeCycleStage::all();
        $fertilizers_list = Fertilizer::all();
        return view('plant/index', compact('plant_statuses_list', 'life_cycle_stages_list', 'fertilizers_list'));
    }

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
           
            $plant = Plant::firstOrCreate([
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

    public function update()
    {
        try {
            $id = \Request::get('id');
            $name = \Request::get('name');
            $quantity = \Request::get('quantity');
            $description = \Request::get('description');
            $location = \Request::get('location');
            $plant_status_id = \Request::get('plant_status_id');
            $life_cycle_stage_id = \Request::get('life_cycle_stage_id');
            $fertilizer_id = \Request::get('fertilizer_id');
            $watering_schedule = \Request::get('watering_schedule');
            $planting_date = date('Y-m-d', strtotime(explode(" to ", \Request::get('planting_harvest_date'))[0]));
            $harvest_date = date('Y-m-d', strtotime(explode(" to ", \Request::get('planting_harvest_date'))[1]));
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
            
            $plant = Plant::find($id);
            $plant -> name = $name;
            $plant -> description = $description;
            $plant -> location = $location;
            $plant -> plant_status_id = $plant_status_id;
            $plant -> life_cycle_stage_id = $life_cycle_stage_id;
            $plant -> fertilizer_id = $fertilizer_id;
            $plant -> quantity = $quantity;
            $plant -> watering_schedule = $watering_schedule;
            $plant -> planting_date = $planting_date;
            $plant -> harvest_date = $harvest_date;
            $plant -> name = $name;
            $plant -> sow_depth = $sow_depth;
            $plant -> distance_between_plants = $distance_between_plants;
            $plant -> lowest_temperature = $lowest_temperature;
            $plant -> highest_temperature = $highest_temperature;
            $plant -> days_before_germination = $days_before_germination;
            $plant -> update();

            return response()->json(['status' => 'Success', 'message' => 'You have successfully updated the plant.', 'timeout' => 1000]);

        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000, 'line' => $e->getLine()]);
        }
    }

    public function delete()
    {
        try {
            $id = \Request::get('id');
            
            $plant = Plant::find($id);
            $file = public_path().$plant->image_url;

            if(\File::exists($file)) {
                \File::delete($file);
            }
            $plant -> delete();

            return response()->json(['status' => 'Success', 'message' => 'You have successfully deleted the plant.', 'timeout' => 1000]);

        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000]);
        }
    }

    public function data()
    {
        $plant_list = Plant::with('plant_status', 'life_cycle_stage', 'fertilizer')->orderBy('name', 'asc')->get();

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
                    'sow_depth' => $plant->sow_depth,
                    'distance_between_plants' => $plant->distance_between_plants,
                    'lowest_temperature' => $plant->lowest_temperature,
                    'highest_temperature' => $plant->highest_temperature,
                    'days_before_germination' => $plant->days_before_germination
                ];
            });

        $datatable = $datatable->toArray();
        return view('plant/data', compact('datatable'));
    }
    
    public function chart_data()
    {
        $harvested_plants_list = HarvestedPlant::all();
        $harvested_arr = [];
            // dd($harvested_plants_list->toArray());
        foreach($harvested_plants_list as $harvested_plant) {
            $count = HarvestedPlant::whereRaw('DATE_FORMAT(harvested_date, "%b %Y") = ?', [date('M Y', strtotime($harvested_plant->harvested_date))])->sum('quantity');
            $harvested_arr[date('M Y', strtotime($harvested_plant->harvested_date))] = $count;
        }

        return response()->json($harvested_arr);
    }

    public function fetch()
    {
        $plant_list = Plant::with('plant_status', 'life_cycle_stage', 'fertilizer')->where('is_harvested', 0)->orderBy('name', 'asc')->get();
        $datatable = collect($plant_list)
            ->map(function($plant) {
                // Define your reference date range
                $startDateReference = Carbon::parse($plant->planting_date); // Replace with your reference start date
                $endDateReference = Carbon::parse($plant->harvest_date);   // Replace with your reference end date

                // Calculate the number of days in the reference range
                $totalDaysReference = $startDateReference->diffInDays($endDateReference);

                // Assuming you have a specific date you want to compare
                $yourDate = Carbon::parse($plant->harvest_date); // Replace with your date
                
                // Calculate the days remaining
                $daysRemaining = $yourDate->diffInDays(Carbon::now());

                // Calculate the days between your date and the reference range
                $daysBetween = $yourDate->diffInDays($startDateReference);

                // Calculate the percentages
                $percentageDaysRemaining = ($daysRemaining / $totalDaysReference) * 100;
                $percentageDaysBetween = ($daysBetween / $totalDaysReference) * 100;

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
                    'total_days' => $totalDaysReference,
                    'remaining_days' => $daysRemaining,
                    'remaining_percentage' => round($percentageDaysRemaining, 0),
                    'percentage' => $percentageDaysBetween
                ];
            });
            
        return view('plant/fetch', compact('datatable'));
    }

    public function approve()
    {
        try {
            $id = \Request::get('id');
            $plant_request = PlantRequest::find($id);

            $plant = Plant::firstOrCreate([
                'name' => $plant_request->name,
                'description' => $plant_request->description,
                'location' => $plant_request->location,
                'plant_status_id' => $plant_request->plant_status_id,
                'life_cycle_stage_id' => $plant_request->life_cycle_stage_id,
                'fertilizer_id' => $plant_request->fertilizer_id,
            ]);
            $plant -> quantity = $plant_request->quantity;
            $plant -> watering_schedule = $plant_request->watering_schedule;
            $plant -> planting_date = $plant_request->planting_date;
            $plant -> harvest_date = $plant_request->harvest_date;
            $plant -> sow_depth = $plant_request->sow_depth;
            $plant -> distance_between_plants = $plant_request->distance_between_plants;
            $plant -> lowest_temperature = $plant_request->lowest_temperature;
            $plant -> highest_temperature = $plant_request->highest_temperature;
            $plant -> days_before_germination = $plant_request->days_before_germination;
            $plant -> image_url = $plant_request->image_url;
            $plant -> created_by_id = auth()->user()->id;
            $plant -> save();

            $plant_request -> is_verified = 1;
            $plant_request -> update();

            return response()->json(['status' => 'Success', 'message' => 'You have successfully approved a new plant.', 'timeout' => 1000]);
        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000, 'line' => $e->getLine()]);
        }
    }
    
    public function disapprove()
    {
        try {
            $id = \Request::get('id');
            $plant_request = PlantRequest::find($id);
            $file = public_path().$plant_request->image_url;

            if(\File::exists($file)) {
                \File::delete($file);
            }
            $plant_request -> delete();

            return response()->json(['status' => 'Success', 'message' => 'You have successfully disapproved a new plant.', 'timeout' => 1000]);
        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000, 'line' => $e->getLine()]);
        }
    }
}

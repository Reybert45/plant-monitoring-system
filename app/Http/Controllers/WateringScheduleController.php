<?php

namespace App\Http\Controllers;

use App\Plant;
use App\WateringSchedule;
use Illuminate\Http\Request;

class WateringScheduleController extends Controller
{
    public function index()
    {
        $plants_list = Plant::where('quantity', '!=', 0)->where('is_harvested', 0)->get();
        return view('user/watering_schedule/index', compact('plants_list'));
    }

    public function store()
    {
        try {
            $plant_id = \Request::get('plant_id');
            $watering_date = \Request::get('watering_date');
            $watering_time = \Request::get('watering_time');
    
            if($watering_time < date('h:i:s')) {
                $status = ['status' => 'Failed', 'message' => 'The entered time has expired.', 'timeout' => 2000];
            } else if($watering_date < date('Y-m-d')) {
                $status = ['status' => 'Failed', 'message' => 'The entered date has expired.', 'timeout' => 2000];
            } else if($plant_id == "") {
                $status = ['status' => 'Failed', 'message' => 'Please select the plant to water.', 'timeout' => 2000];
            } else {
                $watering_schedule = WateringSchedule::firstOrCreate([
                    'plant_id' => $plant_id,
                    'watering_date' => $watering_date,
                    'watering_time' => $watering_time,
                    'user_id' => auth()->user()->id
                ]);
                
                $status = ['status' => 'Success', 'message' => 'The new plant watering schedule has been successfully created.', 'timeout' => 1000];
            }
        } catch(\Exception $e) {
          return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000]);
        }

        return response()->json($status);
    }

    public function update()
    {
        try {
  
            $id = \Request::get('id');
            $watering_date = \Request::get('watering_date');
            $watering_time = \Request::get('watering_time');
    
            if($watering_time < date('h:i:s')) {
                $status = ['status' => 'Failed', 'message' => 'The entered time has expired.', 'timeout' => 2000];
            } else if($watering_date < date('Y-m-d')) {
                $status = ['status' => 'Failed', 'message' => 'The entered date has expired.', 'timeout' => 2000];
            } else {
                $watering_schedule = WateringSchedule::find($id);
                $watering_schedule -> watering_date = $watering_date;
                $watering_schedule -> watering_time = $watering_time;
                $watering_schedule -> user_id = auth()->user()->id;
                $watering_schedule -> update();
    
                $status = ['status' => 'Success', 'message' => 'The plant watering schedule has been successfully updated.', 'timeout' => 1000];
            }
        } catch(\Exception $e) {
          return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000]);
        }

        return response()->json($status);
    }

    public function delete()
    {
        try {
            $id = \Request::get('id');

            $watering_schedule = WateringSchedule::find($id);
            $watering_schedule -> delete();

            return response()->json(['status' => 'Success', 'message' => 'You have successfully deleted the schedule.', 'timeout' => 1000]);

        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000]);
        }
    }

    public function changeStatus()
    {
        try {
            $id = \Request::get('id');
            $status = \Request::get('status');

            $watering_schedule = WateringSchedule::find($id);
            $watering_schedule -> status = $status;
            $watering_schedule -> update();

            return response()->json(['status' => 'Success', 'message' => 'You have successfully updated the status.', 'timeout' => 1000]);
        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000]);
        }
    }

    public function data()
    {
        $watering_schedules_list = WateringSchedule::with('plant')->get();
        $datatable = collect($watering_schedules_list)
            ->map(function($watering_schedule) {
                return [
                    'id' => $watering_schedule->id,
                    'plant_id' => $watering_schedule->plant_id,
                    'name' => $watering_schedule->plant->name,
                    'date' => $watering_schedule->watering_date,
                    'time' => $watering_schedule->watering_time,
                    'status' => $watering_schedule->status,
                ];
            });

        return view('user/watering_schedule/data', compact('datatable'));
    }
}

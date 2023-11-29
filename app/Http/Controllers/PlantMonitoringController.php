<?php

namespace App\Http\Controllers;

use App\GardeningEssential;
use App\HarvestedPlant;
use App\Plant;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PlantMonitoringController extends Controller
{
    public function details()
    {
        try {
            $id = \Request::get('id');
            $plant = Plant::find($id);

            $deadline = Carbon::parse($plant->harvest_date);
            $currentDate = Carbon::now();
            $daysRemaining = $currentDate->diffInDays($deadline);
            
            $harvest_statuses_arr = ["Optimal Month", "Average Month", "Unfavorable Month"];

            $harvested_plants_arr = [];
            $harvested_plants_list = HarvestedPlant::where('plant_id', $plant->id)->get();
            // dd($harvested_plants_list->toArray());
            foreach($harvested_plants_list as $harvested_plant) {
                $total_quantity = HarvestedPlant::where('plant_id', $plant->id)->whereRaw('DATE_FORMAT(harvested_date, "%Y-%m") = ?', [date('Y-m', strtotime($harvested_plant->harvested_date))])->sum('quantity');

                if($total_quantity < 100) {
                    $status = "Unfavorable Month";
                    $percentage_qty = round(($total_quantity / 100) * 100, 0);
                    $color = "#F9A900";
                } else if($total_quantity >= 100 && $total_quantity <= 500) {
                    $status = "Average Month";
                    $percentage_qty = round(($total_quantity / 500) * 100, 0);
                    $color = "#E2F247";
                } else if($total_quantity > 500) {
                    $status = "Optimal Month";
                    $percentage_qty = round(($total_quantity / 600) * 100, 0);
                    $color = "#12A04B";
                }

                $harvested_plants_arr[date('F, Y', strtotime($harvested_plant->harvested_date))] = array(
                    'percentage_qty' => $percentage_qty,
                    'status' => $status,
                    'color' => $color
                );
            }
        } catch(\Exception $e) {
            return response()->json(['status' => 'failed', 'message' => $e->getMessage(), 'line' => $e->getLine()]);
        }

        return view('plant/detail', compact('plant', 'daysRemaining', 'harvested_plants_arr', 'id'));
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
}

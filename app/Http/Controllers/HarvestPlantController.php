<?php

namespace App\Http\Controllers;

use App\HarvestedPlant;
use App\Plant;
use Illuminate\Http\Request;

class HarvestPlantController extends Controller
{
    public function index()
    {
        $plants_list = Plant::where('quantity', '!=', 0)->get();
        return view('user/harvest_plant/index', compact('plants_list'));
    }

    public function store()
    {
        $id = \Request::get('id');
        $harvested_date = \Request::get('harvested_date');
        $quantity = \Request::get('quantity');
        $amount = \Request::get('amount');

        $plant = Plant::find($id);

        if((int)$quantity > $plant->quantity || (int)$quantity < 1) {
            $status = ['status' => 'Failed', 'message' => 'Not enough plants to harvest.'];
        } else if($amount < 1) {
            $status = ['status' => 'Failed', 'message' => 'Amount must not less than to 1.'];
        } else if($harvested_date == "") {
            $status = ['status' => 'Failed', 'message' => 'Please select harvest date.'];
        } else if($harvested_date < $plant->planting_date) {
            $status = ['status' => 'Failed', 'message' => 'Harvesting should occur only after the planting date has passed.'];
        } else if($harvested_date < $plant->harvest_date) {
            $status = ['status' => 'Failed', 'message' => 'It is not the right time to reap the plant.'];
        } else {
            $harvested_plants = HarvestedPlant::firstOrCreate([
                'plant_id' => $id,
                'harvested_date' => $harvested_date,
                'quantity' => $quantity,
                'amount' => $amount,
                'user_id' => auth()->user()->id
            ]); 

            $plant -> quantity = $plant->quantity - (int)$quantity;
            $plant -> updated_by_id = auth()->user()->id;
            $plant -> update();

            $status = ['status' => 'Success', 'message' => 'You have successfully harvested this plant'];
        }
        
        return response()->json($status);
    }

    public function plants_list()
    {
        $plants_list = Plant::where('quantity', '!=', 0)->get();
        return view('user/harvest_plant/data', compact('plants_list'));
    }
}

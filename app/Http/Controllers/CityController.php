<?php

namespace App\Http\Controllers;

use App\City;
use App\Region;
use Illuminate\Http\Request;

class CityController extends AdminBaseController
{
    public function index()
    {
        $regions_list = Region::all();
        return view('city/index', compact('regions_list'));
    }

    public function store()
    {
        try {
            $name = \Request::get('name');
            $region_id = \Request::get('region_id');

            $validate = \Validator::make(\Request::all(), [
                'name' => 'required',
                'region_id' => 'required',
            ]);

            if(!$validate->passes()) {
                return response()->json(['status' => 'Validated', 'message' => 'Some fields have not passed in the validation process.', 'errors' => $validate->errors(), 'timeout' => 3000]);
            }

            $city = City::firstOrCreate([
                'name' => $name,
                'region_id' => $region_id,
            ]);

            return response()->json(['status' => 'Success', 'message' => 'You have successfully added a new city.', 'timeout' => 1000]);

        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000]);
        }
    }

    public function update()
    {
        try {
            $id = \Request::get('id');
            $name = \Request::get('name');
            $region_id = \Request::get('region_id');

            $validate = \Validator::make(\Request::all(), [
                'name' => 'required',
                'region_id' => 'required',
            ]);

            if(!$validate->passes()) {
                return response()->json(['status' => 'Validated', 'message' => 'Some fields have not passed in the validation process.', 'errors' => $validate->errors(), 'timeout' => 3000]);
            }

            $city = City::find($id);
            $city -> name = $name;
            $city -> region_id = $region_id;
            $city -> save();

            return response()->json(['status' => 'Success', 'message' => 'You have successfully updated the city.', 'timeout' => 1000]);

        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000]);
        }
    }

    public function delete()
    {
        try {
            $id = \Request::get('id');

            $city = City::find($id);
            $city -> delete();

            return response()->json(['status' => 'Success', 'message' => 'You have successfully deleted the city.', 'timeout' => 1000]);

        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000]);
        }
    }

    public function data()
    {
        $city_list = City::with('region')->orderBy('name', 'asc')->get();
        $datatable = collect($city_list)
            ->map(function($city) {
                $editBtn = '<a type="button" class="btn btn-warning btn-sm edit-btn" data-city="'.base64_encode(json_encode($city)).'"><span class="fa fa-edit"></span> Edit</a>';
                $deleteBtn = '<a type="button" class="btn btn-warning btn-sm delete-btn" data-id="'.$city->id.'"><span class="fa fa-trash"></span> Delete</a>';
                return [
                    'id' => $city->id,
                    'name' => $city->name,
                    'region' => $city->region->name,
                    'region_id' => $city->region_id,
                    'actions' => $editBtn . " " . $deleteBtn
                ];
            });

        return view('city/data', compact('datatable'));
    }
}

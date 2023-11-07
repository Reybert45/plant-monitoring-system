<?php

namespace App\Http\Controllers;

use App\City;
use App\Province;
use Illuminate\Http\Request;

class ProvinceController extends AdminBaseController
{
    public function index()
    {
        $cities_list = City::all();
        return view('province/index', compact('cities_list'));
    }

    public function store()
    {
        try {
            $name = \Request::get('name');
            $city_id = \Request::get('city_id');

            $validate = \Validator::make(\Request::all(), [
                'name' => 'required',
                'city_id' => 'required',
            ]);

            if(!$validate->passes()) {
                return response()->json(['status' => 'Validated', 'message' => 'Some fields have not passed in the validation process.', 'errors' => $validate->errors(), 'timeout' => 3000]);
            }

            $province = Province::firstOrCreate([
                'name' => $name,
                'city_id' => $city_id,
            ]);

            return response()->json(['status' => 'Success', 'message' => 'You have successfully added a new province.', 'timeout' => 1000]);

        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000]);
        }
    }

    public function update()
    {
        try {
            $id = \Request::get('id');
            $name = \Request::get('name');
            $city_id = \Request::get('city_id');

            $validate = \Validator::make(\Request::all(), [
                'name' => 'required',
                'city_id' => 'required',
            ]);

            if(!$validate->passes()) {
                return response()->json(['status' => 'Validated', 'message' => 'Some fields have not passed in the validation process.', 'errors' => $validate->errors(), 'timeout' => 3000]);
            }

            $province = Province::find($id);
            $province -> name = $name;
            $province -> city_id = $city_id;
            $province -> save();

            return response()->json(['status' => 'Success', 'message' => 'You have successfully updated the province.', 'timeout' => 1000]);

        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000]);
        }
    }

    public function delete()
    {
        try {
            $id = \Request::get('id');

            $province = Province::find($id);
            $province -> delete();

            return response()->json(['status' => 'Success', 'message' => 'You have successfully deleted the province.', 'timeout' => 1000]);

        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000]);
        }
    }

    public function data()
    {
        $province_list = Province::with('city')->orderBy('name', 'asc')->get();
        $datatable = collect($province_list)
            ->map(function($province) {
                $editBtn = '<a type="button" class="btn btn-warning btn-sm edit-btn" data-province="'.base64_encode(json_encode($province)).'"><span class="fa fa-edit"></span> Edit</a>';
                $deleteBtn = '<a type="button" class="btn btn-warning btn-sm delete-btn" data-id="'.$province->id.'"><span class="fa fa-trash"></span> Delete</a>';
                return [
                    'id' => $province->id,
                    'name' => $province->name,
                    'city' => $province->city->name,
                    'city_id' => $province->city_id,
                    'actions' => $editBtn . " " . $deleteBtn
                ];
            });

        return view('province/data', compact('datatable'));
    }
}

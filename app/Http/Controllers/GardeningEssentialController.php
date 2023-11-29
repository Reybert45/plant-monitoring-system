<?php

namespace App\Http\Controllers;

use App\EssentialType;
use App\GardeningEssential;
use App\Plant;
use Illuminate\Http\Request;

class GardeningEssentialController extends AdminBaseController
{
    public function index()
    {
        $plants_list = Plant::all();
        $essentials_type_list = EssentialType::all();
        return view('gardening_essential/index', compact('plants_list', 'essentials_type_list'));
    }

    public function store()
    {
        try {
            $plant_id = \Request::get('plant_id');
            $essential_type_id = \Request::get('essential_type_id');
            $link = \Request::get('link');

            $message = [
                'plant_id.required' => 'Vegetable is required.', 
                'essential_type_id.required' => 'Essential type is required.', 
            ];

            $validate = \Validator::make(\Request::all(), [
                'plant_id' => 'required',
                'essential_type_id' => 'required',
                'link' => 'required',
            ], $message);

            if(!$validate->passes()) {
                return response()->json(['status' => 'Validated', 'message' => 'Some fields have not passed in the validation process.', 'errors' => $validate->errors(), 'timeout' => 3000]);
            }

            $gardening_essential = GardeningEssential::firstOrCreate([
                'plant_id' => $plant_id,
                'essential_type_id' => $essential_type_id,
                'link' => $link
            ]);

            return response()->json(['status' => 'Success', 'message' => 'You have successfully added a new gardening essential.', 'timeout' => 1000]);

        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000]);
        }
    }

    public function update()
    {
        try {
            $id = \Request::get('id');
            $plant_id = \Request::get('plant_id');
            $essential_type_id = \Request::get('essential_type_id');
            $link = \Request::get('link');

            $message = [
                'plant_id.required' => 'Vegetable is required.', 
                'essential_type_id.required' => 'Essential type is required.', 
            ];

            $validate = \Validator::make(\Request::all(), [
                'plant_id' => 'required',
                'essential_type_id' => 'required',
                'link' => 'required',
            ], $message);

            if(!$validate->passes()) {
                return response()->json(['status' => 'Validated', 'message' => 'Some fields have not passed in the validation process.', 'errors' => $validate->errors(), 'timeout' => 3000]);
            }

            $gardening_essential = GardeningEssential::find($id);
            $gardening_essential -> plant_id = $plant_id;
            $gardening_essential -> essential_type_id = $essential_type_id;
            $gardening_essential -> link = $link;
            $gardening_essential -> update();

            return response()->json(['status' => 'Success', 'message' => 'You have successfully updated the gardening essential.', 'timeout' => 1000]);

        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000]);
        }
    }

    public function delete()
    {
        try {
            $id = \Request::get('id');

            $gardening_essential = GardeningEssential::find($id);
            $gardening_essential -> delete();

            return response()->json(['status' => 'Success', 'message' => 'You have successfully deleted the gardening_essential.', 'timeout' => 1000]);

        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000]);
        }
    }

    public function data()
    {
        $gardening_essential_list = GardeningEssential::all();
        $datatable = collect($gardening_essential_list)
            ->map(function($gardening_essential) {
                $plant = Plant::where('id', $gardening_essential->plant_id)->first();
                $editBtn = '<a type="button" class="btn btn-warning btn-sm edit-btn" data-gardening_essential="'.base64_encode(json_encode($gardening_essential)).'"><span class="fa fa-edit"></span> Edit</a>';
                $deleteBtn = '<a type="button" class="btn btn-warning btn-sm delete-btn" data-id="'.$gardening_essential->id.'"><span class="fa fa-trash"></span> Delete</a>';
                return [
                    'id' => $gardening_essential->id,
                    'name' => $plant->name,
                    'plant_id' => $plant->id,
                    'essential_type_id' => $gardening_essential->essential_type_id,
                    'link' => $plant->link,
                    'link' => $gardening_essential->link,
                    'actions' => $editBtn . " " . $deleteBtn
                ];
            });

        return view('gardening_essential/data', compact('datatable'));
    }
}

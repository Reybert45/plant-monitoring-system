<?php

namespace App\Http\Controllers;

use App\Barangay;
use App\Region;
use Illuminate\Http\Request;

class RegionController extends AdminBaseController
{
    public function index()
    {
        $barangays_list = Barangay::all();
        return view('region/index', compact('barangays_list'));
    }

    public function store()
    {
        try {
            $name = \Request::get('name');
            $barangay_id = \Request::get('barangay_id');

            $validate = \Validator::make(\Request::all(), [
                'name' => 'required',
                'barangay_id' => 'required',
            ]);

            if(!$validate->passes()) {
                return response()->json(['status' => 'Validated', 'message' => 'Some fields have not passed in the validation process.', 'errors' => $validate->errors(), 'timeout' => 3000]);
            }

            $region = Region::firstOrCreate([
                'name' => $name,
                'barangay_id' => $barangay_id,
            ]);

            return response()->json(['status' => 'Success', 'message' => 'You have successfully added a new region.', 'timeout' => 1000]);

        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000]);
        }
    }

    public function update()
    {
        try {
            $id = \Request::get('id');
            $name = \Request::get('name');
            $barangay_id = \Request::get('barangay_id');

            $validate = \Validator::make(\Request::all(), [
                'name' => 'required',
                'barangay_id' => 'required',
            ]);

            if(!$validate->passes()) {
                return response()->json(['status' => 'Validated', 'message' => 'Some fields have not passed in the validation process.', 'errors' => $validate->errors(), 'timeout' => 3000]);
            }

            $region = Region::find($id);
            $region -> name = $name;
            $region -> barangay_id = $barangay_id;
            $region -> save();

            return response()->json(['status' => 'Success', 'message' => 'You have successfully updated the region.', 'timeout' => 1000]);

        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000]);
        }
    }

    public function delete()
    {
        try {
            $id = \Request::get('id');

            $region = Region::find($id);
            $region -> delete();

            return response()->json(['status' => 'Success', 'message' => 'You have successfully deleted the region.', 'timeout' => 1000]);

        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000]);
        }
    }

    public function data()
    {
        $region_list = Region::with('barangay')->orderBy('name', 'asc')->get();
        $datatable = collect($region_list)
            ->map(function($region) {
                $editBtn = '<a type="button" class="btn btn-warning btn-sm edit-btn" data-region="'.base64_encode(json_encode($region)).'"><span class="fa fa-edit"></span> Edit</a>';
                $deleteBtn = '<a type="button" class="btn btn-warning btn-sm delete-btn" data-id="'.$region->id.'"><span class="fa fa-trash"></span> Delete</a>';
                return [
                    'id' => $region->id,
                    'name' => $region->name,
                    'barangay' => $region->barangay->name,
                    'barangay_id' => $region->barangay_id,
                    'actions' => $editBtn . " " . $deleteBtn
                ];
            });

        return view('region/data', compact('datatable'));
    }
}

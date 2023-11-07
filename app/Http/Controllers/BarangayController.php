<?php

namespace App\Http\Controllers;

use App\Barangay;
use App\Street;
use Illuminate\Http\Request;

class BarangayController extends AdminBaseController
{
    public function index()
    {
        $streets_list = Street::all();
        return view('barangay/index', compact('streets_list'));
    }

    public function store()
    {
        try {
            $name = \Request::get('name');
            $street_id = \Request::get('street_id');

            $validate = \Validator::make(\Request::all(), [
                'name' => 'required',
                'street_id' => 'required',
            ]);

            if(!$validate->passes()) {
                return response()->json(['status' => 'Validated', 'message' => 'Some fields have not passed in the validation process.', 'errors' => $validate->errors(), 'timeout' => 3000]);
            }

            $barangay = Barangay::firstOrCreate([
                'name' => $name,
                'street_id' => $street_id,
            ]);

            return response()->json(['status' => 'Success', 'message' => 'You have successfully added a new barangay.', 'timeout' => 1000]);

        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000]);
        }
    }

    public function update()
    {
        try {
            $id = \Request::get('id');
            $name = \Request::get('name');
            $street_id = \Request::get('street_id');

            $validate = \Validator::make(\Request::all(), [
                'name' => 'required',
                'street_id' => 'required',
            ]);

            if(!$validate->passes()) {
                return response()->json(['status' => 'Validated', 'message' => 'Some fields have not passed in the validation process.', 'errors' => $validate->errors(), 'timeout' => 3000]);
            }

            $barangay = Barangay::find($id);
            $barangay -> name = $name;
            $barangay -> street_id = $street_id;
            $barangay -> save();

            return response()->json(['status' => 'Success', 'message' => 'You have successfully updated the barangay.', 'timeout' => 1000]);

        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000]);
        }
    }

    public function delete()
    {
        try {
            $id = \Request::get('id');

            $barangay = Barangay::find($id);
            $barangay -> delete();

            return response()->json(['status' => 'Success', 'message' => 'You have successfully deleted the barangay.', 'timeout' => 1000]);

        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000]);
        }
    }

    public function data()
    {
        $barangay_list = Barangay::with('street')->orderBy('name', 'asc')->get();
        $datatable = collect($barangay_list)
            ->map(function($barangay) {
                $editBtn = '<a type="button" class="btn btn-warning btn-sm edit-btn" data-barangay="'.base64_encode(json_encode($barangay)).'"><span class="fa fa-edit"></span> Edit</a>';
                $deleteBtn = '<a type="button" class="btn btn-warning btn-sm delete-btn" data-id="'.$barangay->id.'"><span class="fa fa-trash"></span> Delete</a>';
                return [
                    'id' => $barangay->id,
                    'name' => $barangay->name,
                    'street' => $barangay->street->name,
                    'street_id' => $barangay->street_id,
                    'actions' => $editBtn . " " . $deleteBtn
                ];
            });

        return view('barangay/data', compact('datatable'));
    }
}

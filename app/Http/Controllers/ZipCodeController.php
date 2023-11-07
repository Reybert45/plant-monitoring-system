<?php

namespace App\Http\Controllers;

use App\Province;
use App\ZipCode;
use Illuminate\Http\Request;

class ZipCodeController extends AdminBaseController
{
    public function index()
    {
        $provinces_list = Province::all();
        return view('zipcode/index', compact('provinces_list'));
    }

    public function store()
    {
        try {
            $name = \Request::get('name');
            $province_id = \Request::get('province_id');

            $validate = \Validator::make(\Request::all(), [
                'name' => 'required',
                'province_id' => 'required',
            ]);

            if(!$validate->passes()) {
                return response()->json(['status' => 'Validated', 'message' => 'Some fields have not passed in the validation process.', 'errors' => $validate->errors(), 'timeout' => 3000]);
            }

            $zipcode = ZipCode::firstOrCreate([
                'name' => $name,
                'province_id' => $province_id,
            ]);

            return response()->json(['status' => 'Success', 'message' => 'You have successfully added a new zipcode.', 'timeout' => 1000]);

        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000]);
        }
    }

    public function update()
    {
        try {
            $id = \Request::get('id');
            $name = \Request::get('name');
            $province_id = \Request::get('province_id');

            $validate = \Validator::make(\Request::all(), [
                'name' => 'required',
                'province_id' => 'required',
            ]);

            if(!$validate->passes()) {
                return response()->json(['status' => 'Validated', 'message' => 'Some fields have not passed in the validation process.', 'errors' => $validate->errors(), 'timeout' => 3000]);
            }

            $zipcode = ZipCode::find($id);
            $zipcode -> name = $name;
            $zipcode -> province_id = $province_id;
            $zipcode -> save();

            return response()->json(['status' => 'Success', 'message' => 'You have successfully updated the zipcode.', 'timeout' => 1000]);

        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000]);
        }
    }

    public function delete()
    {
        try {
            $id = \Request::get('id');

            $zipcode = ZipCode::find($id);
            $zipcode -> delete();

            return response()->json(['status' => 'Success', 'message' => 'You have successfully deleted the zipcode.', 'timeout' => 1000]);

        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000]);
        }
    }

    public function data()
    {
        $zipcode_list = ZipCode::with('province')->orderBy('name', 'asc')->get();
        $datatable = collect($zipcode_list)
            ->map(function($zipcode) {
                $editBtn = '<a type="button" class="btn btn-warning btn-sm edit-btn" data-zipcode="'.base64_encode(json_encode($zipcode)).'"><span class="fa fa-edit"></span> Edit</a>';
                $deleteBtn = '<a type="button" class="btn btn-warning btn-sm delete-btn" data-id="'.$zipcode->id.'"><span class="fa fa-trash"></span> Delete</a>';
                return [
                    'id' => $zipcode->id,
                    'province' => $zipcode->province->name,
                    'province_id' => $zipcode->province_id,
                    'name' => $zipcode->name,
                    'actions' => $editBtn . " " . $deleteBtn
                ];
            });
        // dd($datatable);
        return view('zipcode/data', compact('datatable'));
    }
}

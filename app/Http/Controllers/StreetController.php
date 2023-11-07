<?php

namespace App\Http\Controllers;

use App\Street;
use Illuminate\Http\Request;

class StreetController extends AdminBaseController
{
    public function index()
    {
        return view('street/index');
    }

    public function store()
    {
        try {
            $name = \Request::get('name');

            $validate = \Validator::make(\Request::all(), [
                'name' => 'required',
            ]);

            if(!$validate->passes()) {
                return response()->json(['status' => 'Validated', 'message' => 'Some fields have not passed in the validation process.', 'errors' => $validate->errors(), 'timeout' => 3000]);
            }

            $street = Street::firstOrCreate([
                'name' => $name,
            ]);

            return response()->json(['status' => 'Success', 'message' => 'You have successfully added a new street.', 'timeout' => 1000]);

        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000]);
        }
    }

    public function update()
    {
        try {
            $id = \Request::get('id');
            $name = \Request::get('name');

            $validate = \Validator::make(\Request::all(), [
                'name' => 'required',
            ]);

            if(!$validate->passes()) {
                return response()->json(['status' => 'Validated', 'message' => 'Some fields have not passed in the validation process.', 'errors' => $validate->errors(), 'timeout' => 3000]);
            }

            $street = Street::find($id);
            $street -> name = $name;
            $street -> save();

            return response()->json(['status' => 'Success', 'message' => 'You have successfully updated the street.', 'timeout' => 1000]);

        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000]);
        }
    }

    public function delete()
    {
        try {
            $id = \Request::get('id');

            $street = Street::find($id);
            $street -> delete();

            return response()->json(['status' => 'Success', 'message' => 'You have successfully deleted the street.', 'timeout' => 1000]);

        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000]);
        }
    }

    public function data()
    {
        $street_list = Street::orderBy('name', 'asc')->get();
        $datatable = collect($street_list)
            ->map(function($street) {
                $editBtn = '<a type="button" class="btn btn-warning btn-sm edit-btn" data-street="'.base64_encode(json_encode($street)).'"><span class="fa fa-edit"></span> Edit</a>';
                $deleteBtn = '<a type="button" class="btn btn-warning btn-sm delete-btn" data-id="'.$street->id.'"><span class="fa fa-trash"></span> Delete</a>';
                return [
                    'id' => $street->id,
                    'name' => $street->name,
                    'actions' => $editBtn . " " . $deleteBtn
                ];
            });

        return view('street/data', compact('datatable'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Fertilizer;
use Illuminate\Http\Request;

class FertilizerController extends AdminBaseController
{
    public function index()
    {
        return view('fertilizer/index');
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

            $fertilizer = Fertilizer::firstOrCreate([
                'name' => $name,
            ]);

            return response()->json(['status' => 'Success', 'message' => 'You have successfully added a new fertilizer.', 'timeout' => 1000]);

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

            $fertilizer = Fertilizer::find($id);
            $fertilizer -> name = $name;
            $fertilizer -> save();

            return response()->json(['status' => 'Success', 'message' => 'You have successfully updated the fertilizer.', 'timeout' => 1000]);

        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000]);
        }
    }

    public function delete()
    {
        try {
            $id = \Request::get('id');

            $fertilizer = Fertilizer::find($id);
            $fertilizer -> delete();

            return response()->json(['status' => 'Success', 'message' => 'You have successfully deleted the fertilizer.', 'timeout' => 1000]);

        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000]);
        }
    }

    public function data()
    {
        $fertilizer_list = Fertilizer::orderBy('name', 'asc')->get();
        $datatable = collect($fertilizer_list)
            ->map(function($fertilizer) {
                $editBtn = '<a type="button" class="btn btn-warning btn-sm edit-btn" data-fertilizer="'.base64_encode(json_encode($fertilizer)).'"><span class="fa fa-edit"></span> Edit</a>';
                $deleteBtn = '<a type="button" class="btn btn-warning btn-sm delete-btn" data-id="'.$fertilizer->id.'"><span class="fa fa-trash"></span> Delete</a>';
                return [
                    'id' => $fertilizer->id,
                    'name' => $fertilizer->name,
                    'actions' => $editBtn . " " . $deleteBtn
                ];
            });

        return view('fertilizer/data', compact('datatable'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Gender;
use Illuminate\Http\Request;

class GenderController extends AdminBaseController
{
    public function index()
    {
        return view('gender/index');
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

            $gender = Gender::firstOrCreate([
                'name' => $name,
            ]);

            return response()->json(['status' => 'Success', 'message' => 'You have successfully added a new gender.', 'timeout' => 1000]);

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

            $gender = Gender::find($id);
            $gender -> name = $name;
            $gender -> save();

            return response()->json(['status' => 'Success', 'message' => 'You have successfully updated the gender.', 'timeout' => 1000]);

        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000]);
        }
    }

    public function delete()
    {
        try {
            $id = \Request::get('id');

            $gender = Gender::find($id);
            $gender -> delete();

            return response()->json(['status' => 'Success', 'message' => 'You have successfully deleted the gender.', 'timeout' => 1000]);

        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000]);
        }
    }

    public function data()
    {
        $gender_list = Gender::orderBy('name', 'asc')->get();
        $datatable = collect($gender_list)
            ->map(function($gender) {
                $editBtn = '<a type="button" class="btn btn-warning btn-sm edit-btn" data-gender="'.base64_encode(json_encode($gender)).'"><span class="fa fa-edit"></span> Edit</a>';
                $deleteBtn = '<a type="button" class="btn btn-warning btn-sm delete-btn" data-id="'.$gender->id.'"><span class="fa fa-trash"></span> Delete</a>';
                return [
                    'id' => $gender->id,
                    'name' => $gender->name,
                    'actions' => $editBtn . " " . $deleteBtn
                ];
            });

        return view('gender/data', compact('datatable'));
    }
}

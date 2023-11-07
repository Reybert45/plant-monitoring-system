<?php

namespace App\Http\Controllers;

use App\Suffix;
use Illuminate\Http\Request;

class SuffixController extends AdminBaseController
{
    public function index()
    {
        return view('suffix/index');
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

            $suffix = Suffix::firstOrCreate([
                'name' => $name,
            ]);

            return response()->json(['status' => 'Success', 'message' => 'You have successfully added a new suffix.', 'timeout' => 1000]);

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

            $suffix = Suffix::find($id);
            $suffix -> name = $name;
            $suffix -> save();

            return response()->json(['status' => 'Success', 'message' => 'You have successfully updated the suffix.', 'timeout' => 1000]);

        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000]);
        }
    }

    public function delete()
    {
        try {
            $id = \Request::get('id');

            $suffix = Suffix::find($id);
            $suffix -> delete();

            return response()->json(['status' => 'Success', 'message' => 'You have successfully deleted the suffix.', 'timeout' => 1000]);

        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000]);
        }
    }

    public function data()
    {
        $suffix_list = Suffix::orderBy('name', 'asc')->get();
        $datatable = collect($suffix_list)
            ->map(function($suffix) {
                $editBtn = '<a type="button" class="btn btn-warning btn-sm edit-btn" data-suffix="'.base64_encode(json_encode($suffix)).'"><span class="fa fa-edit"></span> Edit</a>';
                $deleteBtn = '<a type="button" class="btn btn-warning btn-sm delete-btn" data-id="'.$suffix->id.'"><span class="fa fa-trash"></span> Delete</a>';
                return [
                    'id' => $suffix->id,
                    'name' => $suffix->name,
                    'actions' => $editBtn . " " . $deleteBtn
                ];
            });

        return view('suffix/data', compact('datatable'));
    }
}

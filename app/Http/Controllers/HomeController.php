<?php

namespace App\Http\Controllers;

use App\Address;
use App\Barangay;
use App\City;
use App\Gender;
use App\Person;
use App\Province;
use App\Region;
use App\Street;
use App\Suffix;
use App\User;
use App\ZipCode;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function my_profile()
    {
        $suffixes_list = Suffix::all();
        $genders_list = Gender::all();
        $addresses_list = Address::where('person_id', auth()->user()->person_id)->with([
            'address_status', 'street', 'barangay',
            'region', 'city', 'province', 'zipcode'
        ])->get();
        $streets_list = Street::orderBy('name', 'asc')->get();
        $barangays_list = Barangay::orderBy('name', 'asc')->get();
        $regions_list = Region::orderBy('name', 'asc')->get();
        $cities_list = City::orderBy('name', 'asc')->get();
        $provinces_list = Province::orderBy('name', 'asc')->get();
        $zipcodes_list = ZipCode::orderBy('name', 'asc')->get();
        $profile = User::where('id', auth()->user()->id)->with(['person'])->first();

        return view('user/profile/index', compact('suffixes_list', 'genders_list', 'addresses_list', 'streets_list', 'barangays_list', 'regions_list', 'cities_list', 'provinces_list', 'zipcodes_list', 'profile'));
    }

    public function update()
    {
        try {
            $validator = \Validator::make(\Request::all(), [
                'first_name' => 'required',
                'middle_name' => 'required',
                'last_name' => 'required',
                'birthdate' => 'required',
                'gender_id' => 'required',
                'suffix_id' => 'required',
            ]);

            if(!$validator->passes()) {
                return response()->json(['status' => 'Failed!', 'message' => 'All fields are required.', 'timeout' => 1500]);
            }

            $first_name = \Request::get('first_name');
            $middle_name = \Request::get('middle_name');
            $last_name = \Request::get('last_name');
            $birthdate = \Request::get('birthdate');
            $gender_id = \Request::get('gender_id');
            $suffix_id = \Request::get('suffix_id');

            $person = Person::find(auth()->user()->person_id);
            $person -> first_name = $first_name;
            $person -> middle_name = $middle_name;
            $person -> last_name = $last_name;
            $person -> birthdate = $birthdate;
            $person -> gender_id = $gender_id;
            $person -> suffix_id = $suffix_id;
            $person -> update();

            return response()->json(['status' => 'Success', 'message' => 'You have successfully updated your information.', 'timeout' => 1000]);

        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed!', 'message' => $e->getMessage(), 'line' => $e->getLine(), 'timeout' => 2000]);
        }
    }

    public function changepass()
    {
        try {
            $old_password = \Request::get('old_password');
            $new_password = \Request::get('new_password');
            $confirm_password = \Request::get('confirm_password');
            
            $validator = \Validator::make(\Request::all(), [
                'old_password' => 'required|min:6',
                'new_password' => 'required|min:6',
                'confirm_password' => 'required|min:6',
            ]);

            if(!$validator->passes()) {
                $html = '<ul>';

                foreach($validator->errors()->all() as $error) {
                    $html .= "<li><b>".$error."</b></li>";
                }
                $html .= '</ul>';

                return response()->json(['status' => 'Failed', 'message' => $html, 'timeout' => 2000]);
            }

            $user = User::find(auth()->user()->id);

            if($old_password != $user->secret_key) {
                return response()->json(['status' => 'Failed', 'message' => 'Incorrect old password', 'timeout' => 2000]);
            } else {
                if($new_password != $confirm_password) {
                    return response()->json(['status' => 'Failed', 'message' => 'Your new password must match the confirmation password.', 'timeout' => 2000]);
                } else {
                    $user -> password = \Hash::make($new_password);
                    $user -> secret_key = $confirm_password;
                    $user -> update();
                }
            }

            return response()->json(['status' => 'Success', 'message' => 'You have successfully updated your information.', 'timeout' => 1000]);
        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed!', 'message' => $e->getMessage(), 'line' => $e->getLine(), 'timeout' => 2000]);
        }
    }

    public function update_address()
    {
        try {
            $address_id = \Request::get('address_id');
            $street_id = \Request::get('street_id');
            $barangay_id = \Request::get('barangay_id');
            $region_id = \Request::get('region_id');
            $city_id = \Request::get('city_id');
            $province_id = \Request::get('province_id');
            $zipcode_id = \Request::get('zipcode_id');
            $address_status_name = \Request::get('address_status_name');

            $validator = \Validator::make(\Request::all(), [
                'street_id' => 'required',
                'barangay_id' => 'required',
                'region_id' => 'required',
                'city_id' => 'required',
                'province_id' => 'required',
                'zipcode_id' => 'required',
            ]);

            if(!$validator->passes()) {
                return response()->json(['status' => 'Failed', 'message' => 'All fields are required to save.', 'timeout' => 1500]);
            }
            
            $address = Address::find($address_id);
            $address -> street_id = $street_id;
            $address -> barangay_id = $barangay_id;
            $address -> region_id = $region_id;
            $address -> city_id = $city_id;
            $address -> province_id = $province_id;
            $address -> zipcode_id = $zipcode_id;
            $address -> update();
            
            return response()->json(['status' => 'Success', 'message' => 'You have successfully updated your '.$address_status_name.'.', 'timeout' => 1000]);
        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed!', 'message' => $e->getMessage(), 'line' => $e->getLine(), 'timeout' => 2000]);
        }
    }
}

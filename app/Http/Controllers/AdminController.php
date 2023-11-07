<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Address;
use App\AddressStatus;
use App\Barangay;
use App\City;
use App\Gender;
use App\Plant;
use App\Person;
use App\Province;
use App\Region;
use App\Street;
use App\Suffix;
use App\User;
use App\ZipCode;
use Illuminate\Http\Request;

class AdminController extends AdminBaseController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins_count = Admin::all()->count();
        $users_count = User::all()->count();
        $plants_count = Plant::all()->count();
        $harvested_count = Plant::where('plant_status_id', 2)->get()->count();
        return view('admin', compact('admins_count', 'users_count', 'plants_count', 'harvested_count'));
    }

    public function manage()
    {
        $genders_list = Gender::all();
        $suffixes_list = Suffix::all();
        $address_statuses_list = AddressStatus::all();
        foreach($address_statuses_list as $address_status) {
            $streets_list = Street::all();
            $barangays_list = Barangay::all();
            $regions_list = Region::all();
            $cities_list = City::all();
            $provinces_list = Province::all();
            $zipcodes_list = ZipCode::all();
            $address_status -> streets_list = $streets_list;
            $address_status -> barangays_list = $barangays_list;
            $address_status -> regions_list = $regions_list;
            $address_status -> cities_list = $cities_list;
            $address_status -> provinces_list = $provinces_list;
            $address_status -> zipcodes_list = $zipcodes_list;
        }

        return view('admin/index', compact('genders_list', 'suffixes_list', 'address_statuses_list'));
    }

    public function store()
    {
        try {
            $username = \Request::get('username');
            $email = \Request::get('email');
            $first_name = \Request::get('first_name');
            $middle_name = \Request::get('middle_name');
            $last_name = \Request::get('last_name');
            $suffix_id = \Request::get('suffix_id');
            $gender_id = \Request::get('gender_id');
            $birthdate = \Request::get('birthdate');
            $password = \Request::get('password');
            $confirm_password = \Request::get('confirm_password');
            
            $messages = [
                'suffix_id.required' => 'Suffix is required.',
                'gender_id.required' => 'Gender is required.',
                'current_address.street_id.required' => 'Street is required.',
                'current_address.barangay_id.required' => 'Barangay is required.',
                'current_address.region_id.required' => 'Region is required.',
                'current_address.city_id.required' => 'City is required.',
                'current_address.province_id.required' => 'Province is required.',
                'current_address.zipcode_id.required' => 'Zip code is required.',
                'permanent_address.street_id.required' => 'Street is required.',
                'permanent_address.barangay_id.required' => 'Barangay is required.',
                'permanent_address.region_id.required' => 'Region is required.',
                'permanent_address.city_id.required' => 'City is required.',
                'permanent_address.province_id.required' => 'Province is required.',
                'permanent_address.zipcode_id.required' => 'Zip code is required.',
            ];

            $validate = \Validator::make(\Request::all(), [
                'username' => 'required|unique:admins',
                'email' => 'required|email|unique:admins',
                'first_name' => 'required',
                'last_name' => 'required',
                'suffix_id' => 'required',
                'gender_id' => 'required',
                'birthdate' => 'required',
                'password' => 'min:6|required_with:confirm_password|same:confirm_password',
                'confirm_password' => 'min:6',
                'current_address.street_id' => 'required',
                'current_address.barangay_id' => 'required',
                'current_address.region_id' => 'required',
                'current_address.city_id' => 'required',
                'current_address.province_id' => 'required',
                'current_address.zipcode_id' => 'required',
                'permanent_address.street_id' => 'required',
                'permanent_address.barangay_id' => 'required',
                'permanent_address.region_id' => 'required',
                'permanent_address.city_id' => 'required',
                'permanent_address.province_id' => 'required',
                'permanent_address.zipcode_id' => 'required',
            ], $messages);

            if(!$validate->passes()) {
                return response()->json(['status' => 'Validated', 'message' => 'Some fields have not passed in the validation process.', 'errors' => $validate->errors(), 'timeout' => 3000]);
            }

            $person = Person::firstOrCreate([
                'first_name' => $first_name,
                'last_name' => $last_name,
            ]);
            $person -> middle_name = $middle_name;
            $person -> suffix_id = $suffix_id;
            $person -> gender_id = $gender_id;
            $person -> birthdate = $birthdate;
            $person -> save();

            $current_address = Address::firstOrCreate([
                'person_id' => $person->id,
                'address_status_id' => 1,
                'street_id' => \Request::get('current_address')['street_id'],
                'barangay_id' => \Request::get('current_address')['barangay_id'],
                'region_id' => \Request::get('current_address')['region_id'],
                'city_id' => \Request::get('current_address')['city_id'],
                'province_id' => \Request::get('current_address')['province_id'],
                'zipcode_id' => \Request::get('current_address')['zipcode_id']
            ]);
            
            $permanent_address = Address::firstOrCreate([
                'person_id' => $person->id,
                'address_status_id' => 2,
                'street_id' => \Request::get('permanent_address')['street_id'],
                'barangay_id' => \Request::get('permanent_address')['barangay_id'],
                'region_id' => \Request::get('permanent_address')['region_id'],
                'city_id' => \Request::get('permanent_address')['city_id'],
                'province_id' => \Request::get('permanent_address')['province_id'],
                'zipcode_id' => \Request::get('permanent_address')['zipcode_id']
            ]);

            $admin = Admin::firstOrCreate([
                'person_id' => $person->id,
                'username' => $username,
                'email' => $email,
            ]);
            $admin -> password = \Hash::make($password);
            $admin -> secret_key = $confirm_password;
            $admin -> save();

            return response()->json(['status' => 'Success', 'message' => 'You have successfully added a new admin.', 'timeout' => 1000]);

        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000]);
        }
    }

    public function update()
    {
        try {
            $id = \Request::get('id');
            $username = \Request::get('username');
            $email = \Request::get('email');
            $first_name = \Request::get('first_name');
            $middle_name = \Request::get('middle_name');
            $last_name = \Request::get('last_name');
            $suffix_id = \Request::get('suffix_id');
            $gender_id = \Request::get('gender_id');
            $birthdate = \Request::get('birthdate');
            $password = \Request::get('password');
            $confirm_password = \Request::get('confirm_password');
            $is_active = \Request::get('is_active');

            $messages = [
                'suffix_id.required' => 'The suffix field is required.',
                'gender_id.required' => 'The gender field is required.',
                'current_address.street_id.required' => 'Street is required.',
                'current_address.barangay_id.required' => 'Barangay is required.',
                'current_address.region_id.required' => 'Region is required.',
                'current_address.city_id.required' => 'City is required.',
                'current_address.province_id.required' => 'Province is required.',
                'current_address.zipcode_id.required' => 'Zip code is required.',
                'permanent_address.street_id.required' => 'Street is required.',
                'permanent_address.barangay_id.required' => 'Barangay is required.',
                'permanent_address.region_id.required' => 'Region is required.',
                'permanent_address.city_id.required' => 'City is required.',
                'permanent_address.province_id.required' => 'Province is required.',
                'permanent_address.zipcode_id.required' => 'Zip code is required.',
            ];

            $fields_arr = array();

            $validate_fields = array(
                'username' => 'required',
                'email' => 'required|email',
                'first_name' => 'required',
                'last_name' => 'required',
                'suffix_id' => 'required',
                'gender_id' => 'required',
                'birthdate' => 'required',
                'current_address.street_id' => 'required',
                'current_address.barangay_id' => 'required',
                'current_address.region_id' => 'required',
                'current_address.city_id' => 'required',
                'current_address.province_id' => 'required',
                'current_address.zipcode_id' => 'required',
                'permanent_address.street_id' => 'required',
                'permanent_address.barangay_id' => 'required',
                'permanent_address.region_id' => 'required',
                'permanent_address.city_id' => 'required',
                'permanent_address.province_id' => 'required',
                'permanent_address.zipcode_id' => 'required',
            );
            array_push($fields_arr, $validate_fields);

            if($password != "" || $confirm_password != "") {
                $password_arr = array(
                    'password' => 'min:6|required_with:confirm_password|same:confirm_password',
                    'confirm_password' => 'min:6',
                );
                array_push($fields_arr, $password_arr);
            }

            $validate = \Validator::make(\Request::all(), array_merge(...$fields_arr), $messages);

            if(!$validate->passes()) {
                return response()->json(['status' => 'Validated', 'message' => 'Some fields have not passed in the validation process.', 'errors' => $validate->errors(), 'timeout' => 3000]);
            }

            $admin = Admin::find($id);
            $admin -> username = $username;
            $admin -> email = $email;
            if($password != "" || $password != "") {
                $admin -> password = \Hash::make($password);
                $admin -> secret_key = $confirm_password;
            }
            $admin -> is_active = $is_active;
            $admin -> save();
            
            $person = Person::find($admin->person_id);
            $person -> first_name = $first_name;
            $person -> middle_name = $middle_name;
            $person -> last_name = $last_name;
            $person -> suffix_id = $suffix_id;
            $person -> gender_id = $gender_id;
            $person -> birthdate = $birthdate;
            $person -> update();

            $current_address = Address::where('person_id', $person->id)->where('address_status_id', 1)->first();
            $current_address -> person_id = $person->id;
            $current_address -> street_id = \Request::get('current_address')['street_id'];
            $current_address -> barangay_id = \Request::get('current_address')['barangay_id'];
            $current_address -> region_id = \Request::get('current_address')['region_id'];
            $current_address -> city_id = \Request::get('current_address')['city_id'];
            $current_address -> province_id = \Request::get('current_address')['province_id'];
            $current_address -> zipcode_id = \Request::get('current_address')['zipcode_id'];
            $current_address -> update();
            
            $permanent_address = Address::where('person_id', $person->id)->where('address_status_id', 2)->first();
            $permanent_address -> person_id = $person->id;
            $permanent_address -> street_id = \Request::get('permanent_address')['street_id'];
            $permanent_address -> barangay_id = \Request::get('permanent_address')['barangay_id'];
            $permanent_address -> region_id = \Request::get('permanent_address')['region_id'];
            $permanent_address -> city_id = \Request::get('permanent_address')['city_id'];
            $permanent_address -> province_id = \Request::get('permanent_address')['province_id'];
            $permanent_address -> zipcode_id = \Request::get('permanent_address')['zipcode_id'];
            $permanent_address -> update();

            return response()->json(['status' => 'Success', 'message' => 'You have successfully updated the admin.', 'timeout' => 1000]);

        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000]);
        }
    }

    public function delete()
    {
        try {
            $id = \Request::get('id');
            $admin = Admin::find($id);
            $check_account = Admin::find(auth()->user()->id);
            if($check_account->person_id != $admin->person_id) {
                $person_id = $admin->person_id;
                $admin -> delete();
                
                if(!\DB::table('admins')->where('person_id', $person_id)->exists()) {
                    $person = Person::find($person_id);
                    $person -> delete();
                    \DB::table('addresses')->where('person_id', $person_id)->delete();
                }
            } else {
                return response()->json(['status' => 'Failed', 'message' => 'You are not permitted to delete your own account.', 'timeout' => 3000]);
            }
            
            return response()->json(['status' => 'Success', 'message' => 'You have successfully deleted the admin.', 'timeout' => 1000]);
        } catch(\Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage(), 'timeout' => 3000]);
        }
    }

    public function data()
    {
        $admin_list = Admin::with(
            'person', 'person.suffix', 'person.gender',
            'person.address', 'person.address.address_status',
            'person.address.street', 'person.address.barangay',
            'person.address.city', 'person.address.province',
            'person.address.zipcode'
        )->get()->toArray();
           
        $datatable = collect($admin_list)
            ->map(function($admin) {
                $editBtn = '<a type="button" class="btn btn-warning btn-sm edit-btn" data-admin="'.base64_encode(json_encode($admin)).'"><span class="fa fa-edit"></span> Edit</a>';
                $deleteBtn = '<a type="button" class="btn btn-warning btn-sm delete-btn" data-id="'.$admin['id'].'"><span class="fa fa-trash"></span> Delete</a>';
                $html = '';
                if(isset($admin['person']['address'])) {
                    $html .= '<ul>';
                    foreach($admin['person']['address'] as $address) {
                        $html .= '<li><h5>'.$address['address_status']['name'].'</h5></li>
                            <ul>
                                <li>'.$address['street']['name'].' '.$address['barangay']['name'].' '.$address['city']['name'].' '.$address['province']['name'].' '.$address['zipcode']['name'].'</li><br />
                            </ul>
                        ';
                    }
                    $html .= '</ul>';
                }

                return [
                    'id' => $admin['id'],
                    'name' => mb_convert_case($admin['person']['first_name'], MB_CASE_TITLE, "UTF-8") .' '. (!in_array($admin['person']['middle_name'], ["",null,".","N/A","n/a","NA"]) ? substr(mb_convert_case($admin['person']['middle_name'], MB_CASE_TITLE, "UTF-8"), 0, 1).'.' : '') .' '. mb_convert_case($admin['person']['last_name'], MB_CASE_TITLE, "UTF-8") ." ". (!in_array($admin['person']['suffix_id'], [1,0,"NA"]) ? $admin['person']['suffix']['name'] : ''),
                    'username' => $admin['username'],
                    'email' => $admin['email'],
                    'is_active' => $admin['is_active'],
                    'password' => $admin['secret_key'],
                    'birthdate' => $admin['person']['birthdate'],
                    'gender' => $admin['person']['gender']['name'],
                    'address' => $html,
                    'suffix_id' => $admin['person']['suffix_id'],
                    'gender_id' => $admin['person']['gender_id'],
                    'first_name' => $admin['person']['first_name'],
                    'middle_name' => $admin['person']['middle_name'],
                    'last_name' => $admin['person']['last_name'],
                    'current_address_street_id' => $admin['person']['address'][0]['street_id'],
                    'current_address_barangay_id' => $admin['person']['address'][0]['barangay_id'],
                    'current_address_region_id' => $admin['person']['address'][0]['region_id'],
                    'current_address_city_id' => $admin['person']['address'][0]['city_id'],
                    'current_address_province_id' => $admin['person']['address'][0]['province_id'],
                    'current_address_zipcode_id' => $admin['person']['address'][0]['zipcode_id'],
                    'permanent_address_street_id' => $admin['person']['address'][1]['street_id'],
                    'permanent_address_barangay_id' => $admin['person']['address'][1]['barangay_id'],
                    'permanent_address_region_id' => $admin['person']['address'][1]['region_id'],
                    'permanent_address_city_id' => $admin['person']['address'][1]['city_id'],
                    'permanent_address_province_id' => $admin['person']['address'][1]['province_id'],
                    'permanent_address_zipcode_id' => $admin['person']['address'][1]['zipcode_id'],
                    'actions' => $editBtn . " " . $deleteBtn
                ];
            });
        // return response()->json($datatable);
        return view('admin/data', compact('datatable'));
    }
}

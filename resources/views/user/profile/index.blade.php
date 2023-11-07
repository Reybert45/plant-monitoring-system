@extends('layouts/main')

@section('title') Watering Schedules @stop

@section('contents')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3><span class="fa fa-user-alt"></span> Account Profile</h3>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row justify-content-between">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <form id="profileForm">
                            <div class="form-group">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="" value="{{ $profile->person->first_name }}">
                            </div>
                            <div class="form-group">
                                <label for="middle_name" class="form-label">Middle Name</label>
                                <input type="text" name="middle_name" id="middle_name" class="form-control" placeholder="" value="{{ $profile->person->middle_name }}">
                            </div>
                            <div class="form-group">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="" value="{{ $profile->person->last_name }}">
                            </div>
                            <div class="form-group">
                                <label for="suffix_id" class="form-label">Suffix</label>
                                <select name="suffix_id" id="suffix_id" class="form-control">
                                    <option value="">--</option>
                                    @foreach ($suffixes_list as $suffix)
                                        <option value="{{ $suffix->id }}" {{ $profile->person->suffix_id == $suffix->id ? 'selected' : '' }}>{{ $suffix->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="birthdate" class="form-label">Birthdate</label>
                                <input type="date" name="birthdate" id="birthdate" class="form-control" placeholder="" value="{{ $profile->person->birthdate }}">
                            </div>
                            <div class="form-group">
                                <label for="gender_id" class="form-label">Gender</label>
                                <select name="gender_id" id="gender_id" class="form-control">
                                    <option value="">--</option>
                                    @foreach ($genders_list as $gender)
                                        <option value="{{ $gender->id }}" {{ $profile->person->gender_id == $gender->id ? 'selected' : '' }}>{{ $gender->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="button" id="save-information-btn" class="btn btn-primary float-end"><span class="fa fa-save"></span> Save Information</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-5">
                <div class="card">
                    <div class="card-body">
                        <form id="securityForm">
                            <div class="form-group">
                                <label for="old_password" class="form-label">Old Password</label>
                                <input type="password" name="old_password" id="old_password" class="form-control" placeholder="******" value="">
                            </div>
                            <div class="form-group">
                                <label for="new_password" class="form-label">New Password</label>
                                <input type="password" name="new_password" id="new_password" class="form-control" placeholder="******" value="">
                            </div>
                            <div class="form-group">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="******" value="">
                            </div>
                            <div class="form-group">
                                <button type="button" id="change-password-btn" class="btn btn-primary float-end"><span class="fas fa-key"></span> Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            @foreach ($addresses_list as $address)
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <form class="addressForm">
                                <h4><span class="fas fa-map-marker"></span> {{ $address->address_status->name }}</h4>
                                <div class="form-group">
                                    <label for="street_id" class="form-label">Street</label>
                                    <select name="street_id" id="street_id" class="form-control">
                                        <option value="">--</option>
                                        @foreach ($streets_list as $street)
                                            <option value="{{ $street->id }}" {{ $address->street_id == $street->id ? 'selected' : '' }}>{{ $street->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="barangay_id" class="form-label">Barangay</label>
                                    <select name="barangay_id" id="barangay_id" class="form-control">
                                        <option value="">--</option>
                                        @foreach ($barangays_list as $barangay)
                                            <option value="{{ $barangay->id }}" data-street_id="{{ $barangay->street_id }}" {{ $address->barangay_id == $barangay->id ? 'selected' : '' }}>{{ $barangay->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="region_id" class="form-label">Region</label>
                                    <select name="region_id" id="region_id" class="form-control">
                                        <option value="">--</option>
                                        @foreach ($regions_list as $region)
                                            <option value="{{ $region->id }}" data-barangay_id="{{ $region->barangay_id }}" {{ $address->region_id == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="city_id" class="form-label">City</label>
                                    <select name="city_id" id="city_id" class="form-control">
                                        <option value="">--</option>
                                        @foreach ($cities_list as $city)
                                            <option value="{{ $city->id }}" data-region_id="{{ $city->region_id }}" {{ $address->city_id == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="province_id" class="form-label">Province</label>
                                    <select name="province_id" id="province_id" class="form-control">
                                        <option value="">--</option>
                                        @foreach ($provinces_list as $province)
                                            <option value="{{ $province->id }}" data-city_id="{{ $province->city_id }}" {{ $address->province_id == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="zipcode_id" class="form-label">Zip Code</label>
                                    <select name="zipcode_id" id="zipcode_id" class="form-control">
                                        <option value="">--</option>
                                        @foreach ($zipcodes_list as $zipcode)
                                            <option value="{{ $zipcode->id }}" data-province_id="{{ $zipcode->province_id }}" {{ $address->zipcode_id == $zipcode->id ? 'selected' : '' }}>{{ $zipcode->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary float-end update-address-btn" data-address_status_name="{{ $address->address_status->name }}" data-address_id="{{ $address->id }}"><span class="fa fa-save"></span> Update {{ $address->address_status->name }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>
@stop
@section('scripts')
<script type="text/javascript" src="{{ asset('js/profile.js') }}"></script>
@stop
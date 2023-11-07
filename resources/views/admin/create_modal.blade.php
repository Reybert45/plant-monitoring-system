<div class="modal fade text-left" data-bs-backdrop="static" id="createAdmin" tabindex="-1" role="dialog" aria-labelledby="createAdminLabel1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createAdminLabel1"><span class="fa fa-plus-circle"></span> Add New Admin</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <section id="basic-horizontal-layouts">
                    <div class="row match-height">
                        <div class="col-md-12 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <form id="createForm" class="form form-horizontal">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for="user-name-horizontal">Username<sup class="text-danger"><b>*</b></sup></label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="user-name-horizontal" class="form-control" name="username" placeholder="User Name">
                                                                <span class="text-danger span-error username-error"></span>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="email-address-horizontal">Email Address<sup class="text-danger"><b>*</b></sup></label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="email" id="email-address-horizontal" class="form-control" name="email" placeholder="Email Address">
                                                                <span class="text-danger span-error email-error"></span>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="first-name-horizontal">First Name<sup class="text-danger"><b>*</b></sup></label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="first-name-horizontal" class="form-control" name="first_name" placeholder="First Name">
                                                                <span class="text-danger span-error first_name-error"></span>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="middle-name-horizontal">Middle Name</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="first-name-horizontal" class="form-control" name="middle_name" placeholder="Middle Name">
                                                                <span class="text-danger span-error middle_name-error"></span>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="last-name-horizontal">Last Name<sup class="text-danger"><b>*</b></sup></label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="first-name-horizontal" class="form-control" name="last_name" placeholder="Last Name">
                                                                <span class="text-danger span-error last_name-error"></span>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="suffix-horizontal">Suffix<sup class="text-danger"><b>*</b></sup></label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <select name="suffix_id" id="suffix-horizontal" class="form-control">
                                                                    <option value="">--</option>
                                                                    @foreach ($suffixes_list as $suffix)
                                                                        <option value="{{ $suffix->id }}">{{ $suffix->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <span class="text-danger span-error suffix_id-error"></span>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="gender-horizontal">Gender<sup class="text-danger"><b>*</b></sup></label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <select name="gender_id" id="gender-horizontal" class="form-control">
                                                                    <option value="">--</option>
                                                                    @foreach ($genders_list as $gender)
                                                                        <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <span class="text-danger span-error gender_id-error"></span>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="birthdate-horizontal">Birthdate<sup class="text-danger"><b>*</b></sup></label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="date" id="birthdate-horizontal" class="form-control flatpickr-no-config" name="birthdate" placeholder="Select date..">
                                                                <span class="text-danger span-error birthdate-error"></span>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="password-horizontal">Password<sup class="text-danger"><b>*</b></sup></label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="password" id="password-horizontal" class="form-control" name="password" placeholder="Password">
                                                                <span class="text-danger span-error password-error"></span>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="confirm-password-horizontal">Confirm Password<sup class="text-danger"><b>*</b></sup></label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="password" id="confirm-password-horizontal" class="form-control" name="confirm_password" placeholder="Confirm Password">
                                                                <span class="text-danger span-error confirm_password-error"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        @foreach ($address_statuses_list as $address_status)
                                                            <h6>{{ $address_status->name }}</h6>

                                                            <div class="row" id="{{ strtolower(str_replace(" ","_",$address_status->name)) }}">
                                                                <div class="col-md-4">
                                                                    <label for="street-horizontal">Street<sup class="text-danger"><b>*</b></sup></label>
                                                                </div>
                                                                <div class="col-md-8 form-group">
                                                                    <select name="street_id" id="street-horizontal" class="form-control">
                                                                        <option value="">--</option>
                                                                        @foreach ($address_status->streets_list as $street)
                                                                            <option value="{{ $street->id }}">{{ $street->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <span class="text-danger span-error {{ strtolower(str_replace(" ","_",$address_status->name)) }}_street_id-error"></span>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="barangay-horizontal">Barangay<sup class="text-danger"><b>*</b></sup></label>
                                                                </div>
                                                                <div class="col-md-8 form-group">
                                                                    <select name="barangay_id" id="barangay-horizontal" class="form-control">
                                                                        <option value="">--</option>
                                                                        @foreach ($address_status->barangays_list as $barangay)
                                                                            <option value="{{ $barangay->id }}" data-street_id="{{ $barangay->street_id }}" hidden="true">{{ $barangay->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <span class="text-danger span-error {{ strtolower(str_replace(" ","_",$address_status->name)) }}_barangay_id-error"></span>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="region-horizontal">Region<sup class="text-danger"><b>*</b></sup></label>
                                                                </div>
                                                                <div class="col-md-8 form-group">
                                                                    <select name="region_id" id="region-horizontal" class="form-control">
                                                                        <option value="">--</option>
                                                                        @foreach ($address_status->regions_list as $region)
                                                                            <option value="{{ $region->id }}" data-barangay_id="{{ $region->barangay_id }}" hidden="true">{{ $region->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <span class="text-danger span-error {{ strtolower(str_replace(" ","_",$address_status->name)) }}_region_id-error"></span>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="city-horizontal">City<sup class="text-danger"><b>*</b></sup></label>
                                                                </div>
                                                                <div class="col-md-8 form-group">
                                                                    <select name="city_id" id="city-horizontal" class="form-control">
                                                                        <option value="">--</option>
                                                                        @foreach ($address_status->cities_list as $city)
                                                                            <option value="{{ $city->id }}" data-region_id="{{ $city->region_id }}" hidden="true">{{ $city->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <span class="text-danger span-error {{ strtolower(str_replace(" ","_",$address_status->name)) }}_city_id-error"></span>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="province-horizontal">Province<sup class="text-danger"><b>*</b></sup></label>
                                                                </div>
                                                                <div class="col-md-8 form-group">
                                                                    <select name="province_id" id="province-horizontal" class="form-control">
                                                                        <option value="">--</option>
                                                                        @foreach ($address_status->provinces_list as $province)
                                                                            <option value="{{ $province->id }}" data-city_id="{{ $province->city_id }}" hidden="true">{{ $province->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <span class="text-danger span-error {{ strtolower(str_replace(" ","_",$address_status->name)) }}_province_id-error"></span>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="zipcode-horizontal">Zip Code<sup class="text-danger"><b>*</b></sup></label>
                                                                </div>
                                                                <div class="col-md-8 form-group">
                                                                    <select name="zipcode_id" id="zipcode-horizontal" class="form-control">
                                                                        <option value="">--</option>
                                                                        @foreach ($address_status->zipcodes_list as $zipcode)
                                                                            <option value="{{ $zipcode->id }}" data-province_id="{{ $zipcode->province_id }}" hidden="true">{{ $zipcode->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <span class="text-danger span-error {{ strtolower(str_replace(" ","_",$address_status->name)) }}_zipcode_id-error"></span>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block"><span class="fa fa-times-circle"></span> Close</span>
                </button>
                <button type="button" class="btn btn-light-secondary reset-btn">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block"><span class="fa fa-redo-alt"></span> Reset</span>
                </button>
                <button type="button" id="add-btn" class="btn btn-primary ms-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block"><span class="fa fa-plus-circle"></span> Add</span>
                </button>
            </div>
        </div>
    </div>
</div>
<header>
    <nav class="navbar navbar-expand navbar-light navbar-top">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
                <i class="bi bi-justify fs-3"></i>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-lg-0">
                        @if(auth()->user()->username != 'admin')
                        <?php
                            $plants_list = App\Plant::where('is_harvested', 0)->get();
                            foreach ($plants_list as $plant) {
                                $deadline = Carbon\Carbon::parse($plant->harvest_date);
                                $currentDate = Carbon\Carbon::now();
                                $daysRemaining = $currentDate->diffInDays($deadline);
                                $plant->days = $daysRemaining;
                            }
                        ?>
                            <li class="nav-item dropdown me-3">
                                <a class="nav-link active dropdown-toggle text-gray-600" href="#" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                    <i class='bi bi-bell bi-sub fs-4'></i>
                                    <span class="badge badge-notification bg-danger">{{ count($plants_list) != 0 ? count($plants_list) : "" }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end notification-dropdown" aria-labelledby="dropdownMenuButton" style="height: 50vh; overflow-y: scroll;">
                                    <li class="dropdown-header">
                                        <h6>Vegetables Stats</h6>
                                    </li>
                                    @foreach ($plants_list as $plant)
                                    <li class="dropdown-item notification-item" data-id="{{ $plant->id }}" data-bs-toggle="modal" data-bs-target="#plantDetails">
                                        <a class="d-flex align-items-center" href="#">
                                            <div class="notification-icon bg-primary">
                                                <img src="{{ url($plant->image_url) }}" alt="{{ $plant->name }} Image" style="width: 40px; border-radius: 50%; height: 40px;" />
                                            </div>
                                            <div class="notification-text ms-4">
                                                <p class="notification-title font-bold">{{ $plant->name }}</p>
                                                <p class="notification-subtitle font-thin text-sm">{{ $plant->days == 1 ?
                                                    $plant->days .' Day' : $plant->days .' Days' }} more to harvest</p>
                                            </div>
                                        </a>
                                    </li>
                                    @endforeach
                                    <li>
                                        <p class="text-center py-2 mb-0"><a href="#" data-bs-toggle="modal" data-bs-target="#viewALlPlants">View all Vegetables</a></p>
                                    </li>
                                </ul>
                            </li>
                        @else
                        <?php
                            $plants_request_list = App\PlantRequest::where('is_verified', 0)->get();

                        ?>
                            <li class="nav-item dropdown me-3">
                                <a class="nav-link active dropdown-toggle text-gray-600" href="#" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                    <i class='bi bi-bell bi-sub fs-4'></i>
                                    <span class="badge badge-notification bg-danger">{{ count($plants_request_list) }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end notification-dropdown" aria-labelledby="dropdownMenuButton" style="height: 50vh; overflow-y: scroll;">
                                    <li class="dropdown-header">
                                        <h6>Farmer's Requests</h6>
                                    </li>
                                    @foreach ($plants_request_list as $plants_request)
                                        <li class="dropdown-item notification-item" data-plants_request="{{ base64_encode(json_encode($plants_request)) }}" data-id="{{ $plants_request->id }}" data-bs-toggle="modal" data-bs-target="#viewRequest">
                                            <a class="d-flex align-items-center" href="#">
                                                <div class="notification-icon bg-primary">
                                                    <img src="{{ url($plants_request->image_url) }}" alt="{{ $plants_request->name }} Image" style="width: 40px; border-radius: 50%; height: 40px;" />
                                                </div>
                                                <div class="notification-text ms-4">
                                                    <p class="notification-title font-bold">{{ $plants_request->name }}</p>
                                                    <p class="notification-subtitle font-thin text-sm">{{ date('Y-m-d', strtotime($plants_request->created_at)) == date('Y-m-d') ? 'Requested today' : 'Requested on '. date('F j, Y', strtotime($plants_request->created_at)) }}</p>
                                                </div>
                                            </a>
                                        </li>         
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    </ul>
                <?php
                    $admin = App\Admin::where('id', auth()->user()->id)->with('person')->first();
                ?>
                <div class="dropdown">
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-menu d-flex">
                            <div class="user-name text-end me-3">
                                <h6 class="mb-0 text-gray-600">{{ mb_convert_case($admin->person->first_name, MB_CASE_TITLE, "UTF-8") ." ". mb_convert_case($admin->person->last_name, MB_CASE_TITLE, "UTF-8") }}</h6>
                                <p class="mb-0 text-sm text-gray-600">{{ auth()->user()->username == 'admin' ? 'Administrator' : 'Employee' }}</p>
                            </div>
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    <img src="{{ asset('assets/compiled/jpg/1.jpg') }}">
                                </div>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="min-width: 11rem;">
                        <li>
                            <h6 class="dropdown-header">Hello, {{ mb_convert_case($admin->person->first_name, MB_CASE_TITLE, "UTF-8") }}!</h6>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ auth()->user()->username == 'admin' ? url('admin/logout') : url('user/logout') }}"><i class="icon-mid bi bi-box-arrow-left me-2"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>

<div class="modal fade text-left" id="viewALlPlants" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1"><span class="bi bi-flower2"></span> Vegetables Percentage Status</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12" id="plantsDataContainer">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade text-left" data-bs-backdrop="static" id="plantDetails" tabindex="-1" role="dialog" aria-labelledby="plantDetailsLabel1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="plantDetailsLabel1"><span class="bi bi-flower3"></span> Vegetable Details</h2>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body" id="detail-container">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block"><span class="fa fa-times-circle"></span> Close</span>
                </button>
            </div>
        </div>
    </div>
</div>

@if(auth()->user()->username == 'admin')
<div class="modal fade text-left" data-bs-backdrop="static" id="viewRequest" tabindex="-1" role="dialog" aria-labelledby="viewRequestLabel1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-scrollable" role="document">
        <div class="modal-content">
        <div class="modal-header">
                <h5 class="modal-title" id="createPlantLabel1"><span class="fa fa-plus-circle"></span> View Vegetable Details
                </h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <section id="basic-vertical-layouts">
                    <div class="row match-height">
                        <div class="col-md-12 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <form id="createForm" class="form form-vertical">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="card">
                                                            <div class="card-content">
                                                                <div class="form-group has-icon-left">
                                                                    <label for="plant-name-icon">Plant Name</label>
                                                                    <div class="position-relative">
                                                                        <input type="text" class="form-control" name="name"
                                                                            placeholder="Ex. Egg Plant" id="plant-name-icon">
                                                                        <div class="form-control-icon">
                                                                            <i class="bi bi-flower1"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group has-icon-left">
                                                                    <label for="quantity-icon">Quantity</label>
                                                                    <div class="position-relative">
                                                                        <input type="number" class="form-control" name="quantity"
                                                                            placeholder="Ex. 21" id="quantity-icon">
                                                                        <div class="form-control-icon">
                                                                            <i class="bi bi-bucket-fill"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group has-icon-left">
                                                                    <label for="days-before-germination-icon">Days Before Germination</label>
                                                                    <div class="position-relative">
                                                                        <input type="text" class="form-control" name="days_before_germination"
                                                                            placeholder="Ex. 7-14 Days" id="days-before-germination-icon">
                                                                        <div class="form-control-icon">
                                                                            <i class="bi bi-flower1"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group has-icon-left">
                                                                    <label for="lowest-temperature-icon">Lowest Temperature</label>
                                                                    <div class="position-relative">
                                                                        <input type="text" class="form-control" name="lowest_temperature"
                                                                            placeholder="Ex. 20°C" id="lowest-temperature-icon">
                                                                        <div class="form-control-icon">
                                                                            <i class="fa fa-temperature-low"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group has-icon-left">
                                                                    <label for="highest-temperature-icon">Highest Temperature</label>
                                                                    <div class="position-relative">
                                                                        <input type="text" class="form-control" name="highest_temperature"
                                                                            placeholder="Ex. 29°C" id="highest-temperature-icon">
                                                                        <div class="form-control-icon">
                                                                            <i class="fa fa-temperature-high"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group has-icon-left">
                                                                    <label for="plant-name-icon">Description</label>
                                                                    <div class="position-relative">
                                                                        <textarea name="description" id="plant-name-icon" class="form-control" cols="10" rows="2" placeholder="..."></textarea>
                                                                        <div class="form-control-icon">
                                                                            <i class="fa fa-book-open"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group has-icon-left">
                                                                    <label for="plant-name-icon">Planting Date - Harvest Date</label>
                                                                    <div class="position-relative">
                                                                        <input type="date" name="planting_harvest_date" class="form-control flatpickr-range mb-3" placeholder="Select date..">
                                                                        <div class="form-control-icon">
                                                                            <i class="bi bi-calendar-date-fill"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group has-icon-left">
                                                                    <label for="location-icon">Location</label>
                                                                    <div class="position-relative">
                                                                        <textarea name="location" id="location-icon" class="form-control" cols="10" rows="2" placeholder="..."></textarea>
                                                                        <div class="form-control-icon">
                                                                            <i class="fa fa-location-arrow"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group has-icon-left">
                                                                    <label for="plant-status-icon">Vegetable Status</label>
                                                                    <div class="position-relative">
                                                                        <select name="plant_status_id" id="plant-status-icon" class="form-control">
                                                                            <option value="">--</option>
                                                                            @foreach (App\PlantStatus::all() as $plant_status)
                                                                                <option value="{{ $plant_status->id }}">{{ $plant_status->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        <div class="form-control-icon">
                                                                            <i class="bi bi-flower3"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group has-icon-left">
                                                                    <label for="life-cycle-stage-icon">Life Cycle Stage</label>
                                                                    <div class="position-relative">
                                                                        <select name="life_cycle_stage_id" id="life-cycle-stage-icon" class="form-control">
                                                                            <option value="">--</option>
                                                                            @foreach (App\LifeCycleStage::all() as $life_cycle_stage)
                                                                                <option value="{{ $life_cycle_stage->id }}">{{ $life_cycle_stage->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        <div class="form-control-icon">
                                                                            <i class="bi bi-flower2"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group has-icon-left">
                                                                    <label for="fertilizer-icon">Fertilizer</label>
                                                                    <div class="position-relative">
                                                                        <select name="fertilizer_id" id="fertilizer-icon" class="form-control">
                                                                            <option value="">--</option>
                                                                            @foreach (App\Fertilizer::all() as $fertilizer)
                                                                                <option value="{{ $fertilizer->id }}">{{ $fertilizer->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        <div class="form-control-icon">
                                                                            <i class="bi bi-water"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group has-icon-left">
                                                                    <label for="watering-schedule-icon">Watering Schedule</label>
                                                                    <div class="position-relative">
                                                                        <input type="date" name="watering_schedule" id="watering-schedule-icon" class="form-control with-time-flatpickr-no-config flatpickr-input" />
                                                                        <div class="form-control-icon">
                                                                            <i class="fa fa-hand-holding-water"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group has-icon-left">
                                                                    <label for="sow-depth-icon">Sow Depth</label>
                                                                    <div class="position-relative">
                                                                        <input type="number" name="sow_depth" id="sow-depth-icon" placeholder="Ex. 1.3 Centimeters" class="form-control" />
                                                                        <div class="form-control-icon">
                                                                            <i class="dripicons dripicons-arrow-down"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group has-icon-left">
                                                                    <label for="distance-between-plants-icon">Distance Between Plants</label>
                                                                    <div class="position-relative">
                                                                        <input type="text" name="distance_between_plants" id="distance-between-plants-icon" placeholder="Ex. 60 Centimeters" class="form-control" />
                                                                        <div class="form-control-icon">
                                                                            <i class="dripicons dripicons-swap"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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
                <button type="button" id="approve-btn" class="btn btn-primary ms-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block"><span class="fa fa-plus-circle"></span> Approve</span>
                </button>
                <button type="button" id="disappove-btn" class="btn btn-warning text-white ms-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block"><span class="fa fa-times"></span> Disapprove</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endif
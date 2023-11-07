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
                        @if(auth()->user()->username == 'admin')
                            <li class="nav-item dropdown me-3">
                                <a class="nav-link active dropdown-toggle text-gray-600" href="#" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                    <i class='bi bi-bell bi-sub fs-4'></i>
                                    <span class="badge badge-notification bg-danger">7</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end notification-dropdown" aria-labelledby="dropdownMenuButton" style="height: 50vh; overflow-y: scroll;">
                                    <li class="dropdown-header">
                                        <h6>Plants Stats</h6>
                                    </li>
                                    <?php
                                    $plants_list = App\Plant::where('is_harvested', 0)->get();
                                    foreach ($plants_list as $plant) {
                                        $deadline = Carbon\Carbon::parse($plant->harvest_date);
                                        $currentDate = Carbon\Carbon::now();
                                        $daysRemaining = $currentDate->diffInDays($deadline);
                                        $plant->days = $daysRemaining;
                                    }
                                    ?>
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
                                        <p class="text-center py-2 mb-0"><a href="#" data-bs-toggle="modal" data-bs-target="#viewALlPlants">View all Plants</a></p>
                                    </li>
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
                                <p class="mb-0 text-sm text-gray-600">{{ auth()->user() == 'admin' ? 'Administrator' : 'Employee' }}</p>
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
                <h5 class="modal-title" id="myModalLabel1"><span class="bi bi-flower2"></span> Plants Percentage Status</h5>
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
                <h2 class="modal-title" id="plantDetailsLabel1"><span class="bi bi-flower3"></span> Plant Details</h2>
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
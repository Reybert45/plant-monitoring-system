@extends('layouts/main')

@section('title') Harvest Vegetable @stop

@section('contents')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-12 order-md-1 order-last">
                <h3><span class="bi bi-flower2"></span> Vegetables</h3>

                <a type="button" class="btn btn-primary float-end mb-4" data-bs-toggle="modal" data-bs-target="#requestModal"><span class="fas fa-envelope"></span> Request Vegetable Addition</a>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row gallery" id="row-gallery">
                            @foreach ($plants_list as $plant)
                            <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">
                                <a href="#">
                                    <img class="w-100" src="{{ url($plant->image_url) }}" data-bs-toggle="modal" data-bs-target="#plantModal" data-plant="{{ base64_encode(json_encode($plant)) }}" style="border-radius: 6px;" />
                                </a>
                                <h5 class="text-subtitle text-center text-muted">{{ $plant->name }}</h5>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade text-left" data-bs-backdrop="static" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="requestModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="requestModalLabel1"><span class="fa fa-plus-circle"></span> Request New Vegetable
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
                                        <form id="requestForm" class="form form-vertical">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="card">
                                                            <div class="card-content">
                                                                <div class="card-body">
                                                                    <input type="file" class="image-preview-filepond" name="plant_file">
                                                                </div>
                                                                <div class="form-group has-icon-left">
                                                                    <label for="plant-name-icon">Plant Name</label>
                                                                    <div class="position-relative">
                                                                        <input type="text" class="form-control" name="name" placeholder="Ex. Egg Plant" id="plant-name-icon">
                                                                        <div class="form-control-icon">
                                                                            <i class="bi bi-flower1"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group has-icon-left">
                                                                    <label for="quantity-icon">Quantity</label>
                                                                    <div class="position-relative">
                                                                        <input type="number" class="form-control" name="quantity" placeholder="Ex. 21" id="quantity-icon">
                                                                        <div class="form-control-icon">
                                                                            <i class="bi bi-bucket-fill"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group has-icon-left">
                                                                    <label for="days-before-germination-icon">Days Before Germination</label>
                                                                    <div class="position-relative">
                                                                        <input type="text" class="form-control" name="days_before_germination" placeholder="Ex. 7-14 Days" id="days-before-germination-icon">
                                                                        <div class="form-control-icon">
                                                                            <i class="bi bi-flower1"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group has-icon-left">
                                                                    <label for="lowest-temperature-icon">Lowest Temperature</label>
                                                                    <div class="position-relative">
                                                                        <input type="text" class="form-control" name="lowest_temperature" placeholder="Ex. 20°C" id="lowest-temperature-icon">
                                                                        <div class="form-control-icon">
                                                                            <i class="fa fa-temperature-low"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group has-icon-left">
                                                                    <label for="highest-temperature-icon">Highest Temperature</label>
                                                                    <div class="position-relative">
                                                                        <input type="text" class="form-control" name="highest_temperature" placeholder="Ex. 29°C" id="highest-temperature-icon">
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
                                                                            @foreach ($plant_statuses_list as $plant_status)
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
                                                                            @foreach ($life_cycle_stages_list as $life_cycle_stage)
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
                                                                            @foreach ($fertilizers_list as $fertilizer)
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
                <button type="button" class="btn btn-light-secondary reset-btn">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block"><span class="fa fa-redo-alt"></span> Reset</span>
                </button>
                <button type="button" id="request-btn" class="btn btn-primary ms-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block"><span class="fa fa-plus-circle"></span> Submit Request</span>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade text-left" data-bs-backdrop="static" id="plantModal" tabindex="-1" role="dialog" aria-labelledby="plantModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="plantModalLabel1"><span class="bi bi-flower3"></span> Harvest <span id="plant-title"></span> <span id="remaining-quantity"></span></h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="harvest-form" class="form-horizontal">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-icon-left">
                                <label for="harvest-date-icon">Harvest Date</label>
                                <div class="position-relative">
                                    <input type="date" class="form-control" name="harvested_date" id="harvest-date-icon">
                                    <div class="form-control-icon">
                                        <i class="fa fa-calendar-alt"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-icon-left">
                                <label for="quantity-icon">Quantity</label>
                                <div class="position-relative">
                                    <input type="number" class="form-control" name="quantity" placeholder="Input Quantity" id="quantity-icon">
                                    <div class="form-control-icon">
                                        <i class="fa fa-sort-amount-up"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-icon-left">
                                <label for="amount-icon">Amount</label>
                                <div class="position-relative">
                                    <input type="number" class="form-control" name="amount" placeholder="Input Amount" id="amount-icon">
                                    <div class="form-control-icon">
                                        <i class="fa fa-baby-carriage"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block"><span class="fa fa-times-circle"></span> Close</span>
                </button>
                <button type="button" class="btn btn-light-secondary" id="reset-btn">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block"><span class="fa fa-redo-alt"></span> Reset</span>
                </button>
                <button type="button" id="harvest-btn" class="btn btn-primary ms-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block"><span class="fa fa-plus-circle"></span> Harvest</span>
                </button>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script type="text/javascript" src="{{ asset('js/harvest.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/vegetable-request.js') }}"></script>
@stop
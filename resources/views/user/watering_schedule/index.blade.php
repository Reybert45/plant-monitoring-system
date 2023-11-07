@extends('layouts/main')

@section('title') Watering Schedules @stop

@section('contents')
<div class="page-heading">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <span class="fa fa-tint"></span> Watering Schedules
                    <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#createWateringSchedule"><span class="fa fa-plus-circle"></span> Add New Schedule</button>
                </h3>
            </div>
            <div class="card-body" id="data-container">
            </div>
        </div>
    </section>
</div>

<!-- create -->
@include('user/watering_schedule/create_modal')
<!-- end -->

<!-- edit -->
@include('user/watering_schedule/edit_modal')
<!-- end -->
@stop
@section('scripts')
<script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/watering_schedule.js') }}"></script>
@stop
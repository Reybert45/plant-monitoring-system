@extends('layouts/main')

@section('title') Vegetable List @stop

@section('contents')
<div class="page-heading">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <span class="bi bi-flower3"></span> Vegetables List
                    <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#createPlant"><span class="fa fa-plus-circle"></span> Add New Plant</button>
                </h3>
            </div>
            <div class="card-body" id="data-container">
            </div>
        </div>
    </section>
</div>

<!-- create -->
@include('plant/create_modal')
<!-- end -->

<!-- edit -->
@include('plant/edit_modal')
<!-- end -->
@stop
@section('scripts')
<script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plant.js') }}"></script>
@stop
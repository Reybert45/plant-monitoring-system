@extends('layouts/main')

@section('title') Provinces List @stop

@section('contents')
<div class="page-heading">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <span class="fa fa-map-marker-alt"></span> Provinces List
                    <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#createProvince"><span class="fa fa-plus-circle"></span> Add New Province</button>
                </h3>
            </div>
            <div class="card-body" id="data-container">
            </div>
        </div>
    </section>
</div>

<!-- create -->
@include('province/create_modal')
<!-- end -->

<!-- edit -->
@include('province/edit_modal')
<!-- end -->
@stop
@section('scripts')
<script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/province.js') }}"></script>
@stop
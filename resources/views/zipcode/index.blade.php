@extends('layouts/main')

@section('title') Zip Code List @stop

@section('contents')
<div class="page-heading">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <span class="fa fa-code-branch"></span> Zip Codes List
                    <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#createZipCode"><span class="fa fa-plus-circle"></span> Add New Zip Code</button>
                </h3>
            </div>
            <div class="card-body" id="data-container">
            </div>
        </div>
    </section>
</div>

<!-- create -->
@include('zipcode/create_modal')
<!-- end -->

<!-- edit -->
@include('zipcode/edit_modal')
<!-- end -->
@stop
@section('scripts')
<script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/zipcode.js') }}"></script>
@stop
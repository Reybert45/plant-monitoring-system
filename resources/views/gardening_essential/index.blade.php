@extends('layouts/main')

@section('title') Gardening Essentials List @stop

@section('contents')
<div class="page-heading">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <span class="fas fa-seedling"></span> Gardening Essentials List
                    <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#createGardeningEssential"><span class="fa fa-plus-circle"></span> Add New Gardening Essential</button>
                </h3>
            </div>
            <div class="card-body" id="data-container">
            </div>
        </div>
    </section>
</div>

<!-- create -->
@include('gardening_essential/create_modal')
<!-- end -->

<!-- edit -->
@include('gardening_essential/edit_modal')
<!-- end -->
@stop
@section('scripts')
<script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/gardening-essential.js') }}"></script>
@stop
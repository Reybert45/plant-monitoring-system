@extends('layouts/main')

@section('title') Harvest Plant @stop

@section('contents')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3><span class="bi bi-flower2"></span> Plants</h3>
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
@stop
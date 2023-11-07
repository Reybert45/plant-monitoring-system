@extends('layouts.main')

@section('title') Dashboard @stop

@section('contents')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3><span class="fa fa-calendar-day"></span> Generate Report</h3>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group has-icon-left">
                            <label for="plant-name-icon">Date From - Date To</label>
                            <div class="position-relative">
                                <input type="date" name="date_from_to" class="form-control flatpickr-range mb-3" placeholder="Select date..">
                                <div class="form-control-icon">
                                    <i class="bi bi-calendar-date-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br><br>

                <div class="row">
                    <div class="col-md-12" id="data-container"></div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
<script>
    $(document).ready(function() {
        fetchHarvestedPlants();

        $("input[name='date_from_to']").change(function() {
            fetchHarvestedPlants();
        });
    });

    function fetchHarvestedPlants()
    {
        $.ajax({
            url: "{{ url('user/report/data') }}",
            type: "GET",
            data: {
                date_from_to: $("input[name='date_from_to']").val()
            }
        }).then(function(data) {
            $("#data-container").html(data);
        });
    }
</script>
@stop

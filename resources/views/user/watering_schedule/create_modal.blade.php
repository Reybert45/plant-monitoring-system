<div class="modal fade text-left" data-bs-backdrop="static" id="createWateringSchedule" tabindex="-1" role="dialog" aria-labelledby="createWateringScheduleLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createWateringScheduleLabel1"><span class="fa fa-plus-circle"></span> Add New Watering Schedule</h5>
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
                                                    <div class="col-12">
                                                        <div class="form-group has-icon-left">
                                                            <label for="plant-icon">Vegetable</label>
                                                            <div class="position-relative">
                                                                <select name="plant_id" id="plant-icon" class="form-control">
                                                                    <option value="">--</option>
                                                                    @foreach ($plants_list as $plant)
                                                                        <option value="{{ $plant->id }}">{{ $plant->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-flower1"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12"><br>
                                                        <div class="form-group has-icon-left">
                                                            <label for="watering-date-icon">Watering Date</label>
                                                            <div class="position-relative">
                                                                <input type="date" class="form-control" name="watering_date" placeholder="Input Watering Date" id="watering-date-icon" value="{{ date('Y-m-d') }}">
                                                                <div class="form-control-icon">
                                                                    <i class="fa fa-calendar-alt"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12"><br>
                                                        <div class="form-group has-icon-left">
                                                            <label for="watering-time-icon">Watering Time</label>
                                                            <div class="position-relative">
                                                                <input type="time" class="form-control" name="watering_time" placeholder="Input Watering Date" id="watering-time-icon" value="{{ date('h:i:s A') }}">
                                                                <div class="form-control-icon">
                                                                    <i class="fas fa-clock"></i>
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
                <button type="button" id="add-btn" class="btn btn-primary ms-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block"><span class="fa fa-plus-circle"></span> Add</span>
                </button>
            </div>
        </div>
    </div>
</div>
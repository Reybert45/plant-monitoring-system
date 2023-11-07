<div class="modal fade text-left" data-bs-backdrop="static" id="createCity" tabindex="-1" role="dialog" aria-labelledby="createCityLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCityLabel1"><span class="fa fa-plus-circle"></span> Add New City</h5>
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
                                                            <label for="region-icon">Region</label>
                                                            <div class="position-relative">
                                                                <select name="region_id" id="region-icon" class="form-control">
                                                                    <option value="">--</option>
                                                                    @foreach ($regions_list as $region)
                                                                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <div class="form-control-icon">
                                                                    <i class="fa fa-location-arrow"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group has-icon-left">
                                                            <label for="city-name-icon">City Name</label>
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control" name="name" placeholder="Input City Name" id="city-name-icon">
                                                                <div class="form-control-icon">
                                                                    <i class="fa fa-map-marked-alt"></i>
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
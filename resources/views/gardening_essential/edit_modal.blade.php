<div class="modal fade text-left" data-bs-backdrop="static" id="editGardeningEssential" tabindex="-1" role="dialog" aria-labelledby="createGardeningEssentialLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createGardeningEssentialLabel1"><span class="fa fa-plus-circle"></span> Add New Gardening Essential</h5>
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
                                        <form id="editForm" class="form form-vertical">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group has-icon-left">
                                                            <label for="plant-icon">Vegetable</label>
                                                            <div class="position-relative mt-1">
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
                                                        <div class="form-group has-icon-left mt-4">
                                                            <label for="essential_type-icon">Essential Type</label>
                                                            <div class="position-relative mt-1">
                                                                <select name="essential_type_id" id="essential_type-icon" class="form-control">
                                                                    <option value="">--</option>
                                                                    @foreach ($essentials_type_list as $essential_type)
                                                                        <option value="{{ $essential_type->id }}">{{ $essential_type->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <div class="form-control-icon">
                                                                    <i class="fa fa-key"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group has-icon-left mt-4">
                                                            <label for="link-icon">Video Link</label>
                                                            <div class="position-relative mt-1">
                                                                <input type="text" class="form-control" name="link" placeholder="Ex: https://www.example.com" id="link-icon">
                                                                <div class="form-control-icon">
                                                                    <i class="fas fa-link"></i>
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
                <button type="button" id="edit-btn" class="btn btn-primary ms-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block"><span class="fa fa-plus-circle"></span> Save Changes</span>
                </button>
            </div>
        </div>
    </div>
</div>
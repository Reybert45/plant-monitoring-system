<div class="modal fade text-left" data-bs-backdrop="static" id="editStreet" tabindex="-1" role="dialog" aria-labelledby="editStreetLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStreetLabel1"><span class="fa fa-user-edit"></span> Edit Street</h5>
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
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group has-icon-left">
                                                            <label for="first-name-icon">Street Name</label>
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control" name="name" placeholder="Input Street Name" id="first-name-icon">
                                                                <div class="form-control-icon">
                                                                    <i class="fa fa-user-tie"></i>
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
                    <span class="d-none d-sm-block"><span class="fa fa-edit"></span> Edit</span>
                </button>
            </div>
        </div>
    </div>
</div>
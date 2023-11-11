
<div class="modal fade show " id="showModall" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content ">
            <div class="modal-header p-3 bg-info-subtle ">
                <h5 class="modal-title" id="exampleModalLabel">Add Language</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <form class="tablelist-form" autocomplete="off">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <label for="leadname-field" class="form-label">Name:</label>
                            <input class="form-control" required="" placeholder="Name" name="name" type="text" id="name">
                        </div>
                        <div class="col-lg-12">
                            <label for="leadname-field" class="form-label">Code:</label>
                            <input class="form-control" required="" placeholder="Code" name="code" type="text" id="code">
                        </div>
                        <div class="col-lg-12">
                            <label for="leadname-field" class="form-label">Image:</label>
                            <input class="form-control" type="file" id="formFile">
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                    <input type="checkbox" class="form-check-input" name="status" id="customSwitchsizelg" value="1">
                                    <label class="form-check-label" for="customSwitchsizelg">Status</label>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        {{-- <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button> --}}
                        <button type="submit" class="btn btn-success" id="add-btn">Save</button>
                        <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>





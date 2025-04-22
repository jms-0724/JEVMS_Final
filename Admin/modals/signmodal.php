
<div class="modal fade" id="updSignatories" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updSignatoriesLabel"  aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="updSignatoriesLabel">Update Signatory ID <i id="sigID"></i></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
            <form method="post" id="updSigForm">
              <div class="row">
                <div class="col">
                <div class="form-group mb-2">
                    <label for="upd_sigfname" class="form-label">Firstname</label>
                    <input type="text" name="add_userfname" id="upd_sigfname" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                    <label for="upd_sigmname" class="form-label">Middlename</label>
                    <input type="text" name="add_usermname" id="upd_sigmname" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                    <label for="add_siglname" class="form-label">Lastname</label>
                    <input type="text" name="add_userlname" id="upd_siglname" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                    <label for="add_position" class="form-label">Postion Name</label>
                    <input type="text" name="add_sigposition" id="upd_sigposition" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn text-white" style="background-color:#0e2238;">Add Signatory</button>
                    <button type="reset" class="btn text-white" style="background-color:#004d68; margin-right: 5px;">Clear</button>
                    <button type="button" class="btn text-white" data-bs-dismiss="modal" style="background-color:#007c85; margin-right: 5px;">Close</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
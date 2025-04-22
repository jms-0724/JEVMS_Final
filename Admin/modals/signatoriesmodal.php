<!-- Add Account Titles -->
<div class="modal fade" id="addSignatories" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Signatories</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
            <form method="post" id="addSigForm">
            <div class="form-group mb-2">
                    <label for="add_sigfname" class="form-label">Firstname</label>
                    <input type="text" name="add_sigfname" id="add_sigfname" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                    <label for="add_sigmname" class="form-label">Middle Initial</label>
                    <input type="text" name="add_sigmname" id="add_sigmname" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                    <label for="add_sigfname" class="form-label">Lastname</label>
                    <input type="text" name="add_siglname" id="add_siglname" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                    <label for="add_sigposition" class="form-label">Position</label>
                    <!-- <input type="text" name="add_sigposition" id="add_sigposition" class="form-control" required> -->
                    <select name="add_sigposition" id="add_sigposition" class="form-select" id="add_sigposition" required>
                      <option value=""></option>
                      <option value="General Manager">General Manager</option>
                    </select>
                </div>
                <!-- <div class="form-group mb-2">
                  <label for="add_status" class="form-label">Account Group</label> <br>
                  <select name="" id="add_journal_category2" class="form-select">

                  </select>
                </div> -->
                <div class="d-flex mt-3">
                <button type="submit" class="btn text-white" style="background-color:#0e2238; margin-right:5px;">Add Signatory</button>
                <button type="reset" class="btn text-white" style="background-color:#004d68; margin-right:5px">Clear</button>
                    <button type="button" class="btn text-white" data-bs-dismiss="modal" style="background-color:#007c85; margin-right: 5px;">Close</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Update Account Titles -->
<div class="modal fade" id="updSignatories" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Signatory ID <i id="sigID"></i></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
            <form method="post" id="updSigForm">
                
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
                

                <div class="d-flex mt-3">
                    <button type="submit" class="btn text-white" style="background-color:#0e2238; margin-right:5px;">Update Signatories</button>
                    <button type="reset" class="btn text-white" style="background-color:#004d68; margin-right:5px;">Clear</button>
                    <button type="button" class="btn text-white" data-bs-dismiss="modal" style="background-color:#007c85; margin-right: 5px;">Close</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Add Account Types -->
<div class="modal fade" id="archiveSignatory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Set Active Signatory</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
            <form method="post" id="archiveFormSig">
                
                <div class="form-group mb-3">
                    <select id="signatories" class="form-select">
                        <option style="display:none" disabled selected value></option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <select name="" id="archivedSig" class="form-select">
                        <option value="Active">Active</option>
                       
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label for="add_sigdate" class="form-label">Start Effectivity Date</label>
                    <input type="date" name="add_sigdate" id="add_sigdate" class="form-control" required>
                </div>
                
                <div class="d-flex mt-3">
                    <button type="submit" class="btn text-white" style="background-color:#0e2238; margin-right:5px;">Update Signatory</button>
                    <button type="button" class="btn text-white" data-bs-dismiss="modal" style="background-color:#007c85; margin-right: 5px;">Close</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>

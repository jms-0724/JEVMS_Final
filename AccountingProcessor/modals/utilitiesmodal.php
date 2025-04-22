<!-- Add Fiscal Year -->
<div class="modal fade" id="addFiscalYear" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New Fiscal Year</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
            <form method="post" id="addFiscalForm">
                <div class="form-group mb-2">
                    <label for="add_username" class="form-label">Fiscal Year Name</label>
                    <input type="text" name="add_code" id="add_fiscal" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                    <label for="account_title" class="form-label">Beggining Date Title</label>
                    <input type="date" name="" id="startDate" class="form-control">
                </div>
                <div class="form-group mb-2">
                   <label for="add_account_type">Ending Date Type</label>
                   <input type="date" name="" id="endDate" class="form-control">
                </div>

                <div class="d-flex mt-3">
                <button type="submit" class="btn text-white" style="background-color:#0e2238;">Add New Fiscal Period</button>
                    <button type="reset" class="btn text-white" style="background-color:#004d68; margin-right: 5px;">Clear</button>
                    <button type="button" class="btn text-white" data-bs-dismiss="modal" style="background-color:#007c85; margin-right: 5px;">Close</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Update Fiscal Year -->
<div class="modal fade" id="updFiscalYear" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New Fiscal Year</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
            <form method="post" id="addFiscalForm">
                <div class="form-group mb-2">
                    <label for="add_username" class="form-label">Fiscal Year Name</label>
                    <input type="text" name="add_code" id="upd_fiscal" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                    <label for="account_title" class="form-label">Beggining Date Title</label>
                    <input type="date" name="" id="UstartDate" class="form-control">
                </div>
                <div class="form-group mb-2">
                   <label for="add_account_type">Ending Date Type</label>
                   <input type="date" name="" id="UendDate" class="form-control">
                </div>
                <!-- <div>
                    <label for="password">Re-enter Password</label>
                    <input type="password" name="password2" id="password2">
                    </div> -->
                <div class="d-flex mt-3">
                <button type="submit" class="btn text-white" style="background-color:#0e2238;">Add Fiscal Year</button>
                    <button type="reset" class="btn text-white" style="background-color:#004d68; margin-right: 5px;">Clear</button>
                    <button type="button" class="btn text-white" data-bs-dismiss="modal" style="background-color:#007c85; margin-right: 5px;">Close</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>

   <!-- Archive Fiscal Year -->
<div class="modal fade" id="archiveFiscal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Fiscal Year <i id="fID"></i> Status</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
            <form method="post" id="fiscalArchive">
                <div class="form-group">
                  <label for="fiscalList" class="form-label">Fiscal Year List</label><br>
                  <select name="fiscalList2" id="fiscalList2" class="form-control" style="width:450px;">

                  </select>
                </div>
                <div class="form-group">
                  <label for="status2" class="form-label">Fiscal Year Status</label>
                  <select name="status2" id="status2" class="form-control">
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                  </select>
                </div>
                <div class="d-flex mt-3">
                <button type="submit" class="btn text-white" style="background-color:#0e2238;"> Update Status</button>
                    <button type="reset" class="btn text-white" style="background-color:#004d68; margin-right: 5px;">Clear</button>
                    <button type="button" class="btn text-white" data-bs-dismiss="modal" style="background-color:#007c85; margin-right: 5px;">Close</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>

  
   <!-- Archive Fiscal Year -->
   <div class="modal fade" id="backupSpecific" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Backup Specific Tables <i id="fID"></i> Status</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
            <form method="post" id="backupTable">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="tables[]" value="tbl_user">
              <label class="form-check-label" for="flexCheckDefault">tbl_user</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="tables[]" value="tbl_user_info">
              <label class="form-check-label" for="flexCheckDefault">tbl_user_info</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="tables[]" value="tbl_journal_entry">
              <label class="form-check-label" for="flexCheckDefault">tbl_journal_entry</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="tables[]" value="tbl_journal_items">
              <label class="form-check-label" for="flexCheckDefault">tbl_journal_items</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="tables[]" value="tbl_general_ledger">
              <label class="form-check-label" for="flexCheckDefault">tbl_general_ledger</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="tables[]" value="tbl_trial_balance">
              <label class="form-check-label" for="flexCheckDefault">tbl_trial_balance</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="tbl_audit_log">
              <label class="form-check-label" for="flexCheckDefault">tbl_audit_log</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="tables[]" value="tbl_account_type">
              <label class="form-check-label" for="flexCheckDefault">tbl_account_type</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="tables[]" value="tbl_account_title">
              <label class="form-check-label" for="flexCheckDefault">tbl_account_title</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="tables[]" value="tbl_account_class">
              <label class="form-check-label" for="flexCheckDefault">tbl_account_class</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="tables[]" value="tbl_main_account_type">
              <label class="form-check-label" for="flexCheckDefault">tbl_main_account_type</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="tables[]" value="tbl_help">
              <label class="form-check-label" for="flexCheckDefault">tbl_help</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="tables[]" value="tbl_help_items">
              <label class="form-check-label" for="flexCheckDefault">tbl_help_items</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="tables[]" value="tbl_fiscal_year">
              <label class="form-check-label" for="flexCheckDefault">tbl_fiscal_year</label>
            </div>
            

                <div class="d-flex mt-3">
                <button type="submit" class="btn text-white" style="background-color:#0e2238;"> Backup Tables</button>
                    <button type="reset" class="btn text-white" style="background-color:#004d68; margin-right: 5px;">Clear</button>
                    <button type="button" class="btn text-white" data-bs-dismiss="modal" style="background-color:#007c85; margin-right: 5px;">Close</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
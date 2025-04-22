<!-- Add Account Titles -->
<div class="modal fade" id="addAccounts" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Account Titles</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
            <form method="post" id="addAccountForm">
                <div class="form-group mb-2">
                    <label for="add_username" class="form-label">Account Code</label>
                    <input type="text" name="add_code" id="add_code" class="form-control" minlength="8" maxlength="8" required>
                </div>
                <div class="form-group mb-2">
                    <label for="account_title" class="form-label">Account Title</label>
                    <input type="text" name="add_title" id="add_title" class="form-control" required autocomplete="off">
                </div>
                <div class="form-group mb-2">
                   <label for="add_account_type">Account Type</label>
                   <select name="add_account_type" id="add_account_type" class="form-select">

                   </select>
                </div>
                <!-- <div class="form-group mb-2">
                  <label for="add_status" class="form-label">Account Group</label> <br>
                  <select name="" id="add_journal_category2" class="form-select">

                  </select>
                </div> -->


                <div class="d-flex mt-3">
                <button type="submit" class="btn text-white" style="background-color:#0e2238; margin-right:5px;">Add Account Titles</button>
                <button type="reset" class="btn text-white" style="background-color:#004d68; margin-right:5px">Clear</button>
                    <button type="button" class="btn text-white" data-bs-dismiss="modal" style="background-color:#007c85; margin-right: 5px;">Close</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Update Account Titles -->
<div class="modal fade" id="updAccounts" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Account Code <i id="accnt"></i></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
            <form method="post" id="updAccountForm">
                
                <div class="form-group mb-2">
                    <label for="account_title" class="form-label">Account Title</label>
                    <input type="text" name="add_title" id="upd_title" class="form-control" required>
                </div>
                <!-- <div>
                    <label for="password">Re-enter Password</label>
                    <input type="password" name="password2" id="password2">
                    </div> -->
                <div class="form-group mb-2">
                    <label for="userlevel" class="form-label">Account Type</label>
                    <select name="account_type" id="upd_account_type" class="form-select" required>
                        
                    </select>
                </div>
                <div class="form-group mb-2">
                  <label for="add_status" class="form-label">Account Group</label> <br>
                  <select name="" id="upd_account_group" class="form-select" style="width:350px;">

                  </select>
                </div>
                

                <div class="d-flex mt-3">
                    <button type="submit" class="btn text-white" style="background-color:#0e2238; margin-right:5px;">Update Account</button>
                    <button type="reset" class="btn text-white" style="background-color:#004d68; margin-right:5px;">Clear</button>
                    <button type="button" class="btn text-white" data-bs-dismiss="modal" style="background-color:#007c85; margin-right: 5px;">Close</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Add Account Types -->
<div class="modal fade" id="addTypes" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Account Titles</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
            <form method="post" id="addTypesForm">
                
                <div class="form-group mb-2">
                    <label for="add_type" class="form-label">Account Type</label>
                    <input type="text" name="add_type" id="add_type" class="form-control" required>
                </div>
                <!-- <div>
                    <label for="password">Re-enter Password</label>
                    <input type="password" name="password2" id="password2">
                    </div> -->
                <div class="form-group mb-2">
                    <label for="add_normal_balance" class="form-label">Normal Balance</label>
                    <select name="add_normal_balance" id="add_normal_balance" class="form-select" required>
                        <option value="" style="display:none;"></option>
                        <option value="Debit">Debit</option>
                        <option value="Credit">Credit</option>
                    </select>
                </div>
                <div class="form-group mb-2">
                <label for="add_main_type" class="form-label">Main Type</label>
                    <select name="add_main_type" id="add_main_type" class="form-select" required>

                    </select>
                </div>
                <div class="form-group mb-2">
                    <label for="add_description" class="form-label">Account Description</label>
                    <textarea rows="2" type="text" name="add_description" id="add_description" class="form-control" required> </textarea>
                </div>
                
                <div class="d-flex mt-3">
                    <button type="submit" class="btn text-white" style="background-color:#0e2238; margin-right:5px;">Add Account Type</button>
                    <button type="reset" class="btn text-white" style="background-color:#004d68; margin-right:5px;">Clear</button>
                    <button type="button" class="btn text-white" data-bs-dismiss="modal" style="background-color:#007c85; margin-right: 5px;">Close</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>

    <!-- Add Account Category -->
<div class="modal fade" id="addCategory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Journal Category</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
            <form method="post" id="addCategoryForm">
                
                <div class="form-group mb-2">
                    <label for="add_type" class="form-label">Journal Category Name</label>
                    <input type="text" name="add_type" id="add_category" class="form-control" required>
                </div>
                <!-- <div>
                    <label for="password">Re-enter Password</label>
                    <input type="password" name="password2" id="password2">
                    </div> -->
                <div class="form-group mb-2">
                    <label for="add_description2" class="form-label">Journal Category Description</label>
                    <textarea rows="2" type="text" name="add_description2" id="add_description" class="form-control" required> </textarea>
                </div>
                <div class="d-flex mt-3">
                    <button type="submit" class="btn text-white" style="background-color:#0e2238; margin-right:5px;">Add Journal Category</button>
                    <button type="reset" class="btn text-white" style="background-color:#004d68; margin-right:5px;">Clear</button>
                    <button type="button" class="btn text-white" data-bs-dismiss="modal" style="background-color:#007c85; margin-right: 5px;">Close</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Update Types -->
  <div class="modal fade" id="updTypes" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Account Types <i id="typeCode"></i></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
            <form method="post" id="updTypesForm">
                
                <div class="form-group mb-2">
                    <label for="add_type" class="form-label">Account Type</label>
                    <input type="text" name="upd_type" id="upd_type" class="form-control" required>
                </div>
                
                <div class="form-group mb-2">
                    <label for="upd_normal_balance" class="form-label">Normal Balance</label>
                    <select name="upd_normal_balance" id="upd_normal_balance" class="form-select" required>
                        <option value="" style="display:none;"></option>
                        <option value="Debit">Debit</option>
                        <option value="Credit">Credit</option>
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label for="upd_description" class="form-label">Type Description</label>
                    <textarea rows="2" type="text" name="upd_description" id="upd_description" class="form-control" required> </textarea>
                </div>
                <div class="d-flex mt-3">
                    <button type="submit" class="btn text-white" style="background-color:#0e2238; margin-right:5px;">Edit Account Type</button>
                    <button type="reset" class="btn text-white" style="background-color:#004d68; margin-right:5px;">Clear</button>
                    <button type="button" class="btn text-white" data-bs-dismiss="modal" style="background-color:#007c85; margin-right: 5px;">Close</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>

      <!-- Update Account Category -->
<div class="modal fade" id="updCategory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Journal Category <i id="cCode"></i></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
            <form method="post" id="updCategoryForm">
                
                <div class="form-group mb-2">
                    <label for="add_type" class="form-label">Journal Categories</label>
                    <input type="text" name="add_type" id="upd_category" class="form-control" required>
                </div>
                <!-- <div>
                    <label for="password">Re-enter Password</label>
                    <input type="password" name="password2" id="password2">
                    </div> -->
                <div class="form-group mb-2">
                    <label for="add_description2" class="form-label">Category Description</label>
                    <textarea rows="2" type="text" name="upd_description2" id="upd_description2" class="form-control" required> </textarea>
                </div>
                <div class="d-flex mt-3">
                    <button type="submit" class="btn text-white" style="background-color:#0e2238; margin-right:5px;">Update Journal Category</button>
                    <button type="reset" class="btn text-white" style="background-color:#004d68; margin-right:5px;">Clear</button>
                    <button type="button" class="btn text-white" data-bs-dismiss="modal" style="background-color:#007c85; margin-right: 5px;">Close</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Add Account Class/Group -->
<div class="modal fade" id="addClass" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Account Group</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
            <form method="post" id="addGroupForm">
                <div class="form-group mb-2">
                    <label for="add_username" class="form-label">Account Group Name</label>
                    <input type="text" name="acct_name" id="acct_name" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                    <label for="add_title" class="form-label">Account Group Description</label>
                    <input type="text" name="acct_description" id="acct_description" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                   <label for="add_accountType">Account Type</label>
                   <select name="" id="add_accountType" class="form-select">

                   </select>
                </div>
                <!-- <div>
                    <label for="password">Re-enter Password</label>
                    <input type="password" name="password2" id="password2">
                    </div> -->
                <div class="d-flex mt-3">
                    <button type="submit" class="btn text-white" style="background-color:#0e2238; margin-right:5px;">Add Account Group</button>
                    <button type="reset" class="btn text-white" style="background-color:#004d68; margin-right:5px;">Clear</button>
                    <button type="button" class="btn text-white" data-bs-dismiss="modal" style="background-color:#007c85; margin-right: 5px;">Close</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>

    <!-- Update Account Groups -->
<div class="modal fade" id="updClass" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Account Group <i id="gID"></i></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
            <form method="post" id="updGroupForm">
                <div class="form-group mb-2">
                    <label for="add_username" class="form-label">Account Group Name</label>
                    <input type="text" name="acct_name" id="acct_name_upd" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                    <label for="add_title" class="form-label">Account Group Description</label>
                    <input type="text" name="acct_description" id="acct_description_upd" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                   <label for="add_accountType">Account Type</label>
                   <select name="" id="upd_account_type2" class="form-select">

                   </select>
                </div>
                <!-- <div class="form-group mb-2">
                   <label for="upd_accountGroup">Account Group</label>
                   <select name="" id="upd_accountGroup" class="form-select">

                   </select>
                </div> -->

                <div class="d-flex mt-3">
                    <button type="submit" class="btn text-white" style="background-color:#0e2238; margin-right:5px;">Update Account Group</button>
                    <button type="reset" class="btn text-white" style="background-color:#004d68; margin-right:5px;">Clear</button>
                    <button type="button" class="btn text-white" data-bs-dismiss="modal" style="background-color:#007c85; margin-right: 5px;">Close</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
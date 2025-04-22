
   <!-- Add Journal Preparation 1 -->
<div class="modal fade" id="createJournals1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Journal Entry</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
            <form method="post" id="addJournalEntryForm">
              <div class="row">
                <div class="col">
                  <div class="form-group mb-2">

                    <label for="add_journal_date" class="form-label">Journal Entry Date</label>
                    <input type="date" name="" id="add_journal_date" class="form-control">
    
                  </div>
                </div>
                <div class="col">
                  <div class="form-group mb-2">

                    <label for="add_journal_number" class="form-label">JEV Number</label>
                    <input type="text" name="add_journal_number" id="add_journal_number" class="form-control" readonly>
    
                  </div>
                </div>
                <div class="col">
                <div class="form-group mb-3">
                    <label for="userlevel" class="form-label">Journal Category</label>
                      <select name="account_category" id="add_journal_category" class="form-select" required>
                               
                      </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group mb-2">
                    <label for="add_journal_description" class="form-label">Journal Particular</label>
                    <input class="form-control"  rows="3" id="add_journal_description" list="J_Desc"></input>
                    <datalist id="J_Desc">
                        
                    </datalist>
                  </div>
                </div>
              </div>
            </form> 
            <form method="post" id="addJournalEntryForm2">
              <div class="row">
                <div class="col">
                    <label for="account_journal_title" class="form-label">Account Titles</label><br>
                    <select name="account_journal_title" id="add_journal_title" class="" style="width:250px" required>
                      
                    </select>  
                </div>
                <div class="col">
                  <label for="add_journal_number" class="form-label">Amount Entered</label>
                  <input type="number" name="add_journal_amount" id="add_journal_amount" class="form-control">
                </div>

              </div> 
              <div class="row">
              <div class="form-group my-3">
                <button type="button" id="addJEntry" class="btn text-white" style="background-color:#0e2238;">Debit Entry</button>
                <button type="button" id="addJEntry2" class="btn text-white" style="background-color:#004d68;">Credit Entry</button>
                </div>
            </form>
                <div class="form-group">
                    <table class="table table-bordered">
                        <thead class="table table-bordered table-primary">
                            <th>Account Code</th>
                            <th>Account Title</th>
                            <th>Debit</th>
                            <th>Credit</th>
                            <th>Actions</th>

                        </thead>
                        <tbody id="journalBody" class="table table-bordered">
                        
                        </tbody>
                        <tfoot class="table table-bordered">
                          <tr class="">
                            <th colspan="2">Total</th>
                            <th id="Dr"></th>
                            <th id="Cr"></th>
                          <td></td>
                          </tr>
                            
                        </tfoot>
                    </table>
                </div>

                </div>
              </div>  
               
                <!-- <div class="form-group">
                    <button type="button" class="btn btn-primary"  id="nextJItems">Next</button>
                </div>

                </div> -->
                
            
                <div class="modal-footer">
                    <div class="d-flex mt-3 mx-3 border">

                    <!-- <button type="submit" class="btn btn-primary">Save Entry</button> -->
                        <button type="button" class="btn mx-2 text-white" style="background-color:#0e2238;" id="saveEntry">Save Entry</button>
                        <button type="reset" class="btn mx-2 text-white" style="background-color:#004d68;">Clear</button>
                        <button type="button" class="btn mx-2 text-white" style="background-color:#007c85;" data-bs-dismiss="modal" id="close1">Close</button>
                    </div>
                </div>
                
           
        </div>
      </div>
    </div>
  </div>

    <!-- Add Journal Modal 2 -->
<div class="modal fade" id="createJournals2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Journal Entry</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
            <!-- <form method="post" id="addJournalEntryForm2">
                <div class="form-group mb-2">
                    <label for="account_journal_title" class="form-label">Account Titles</label>
                    <select name="account_journal_title" id="add_journal_title" class="form-select" required>
                      
                    </select>   
                </div> 

                <div class="form-group mb-3">
                    <label for="add_journal_number" class="form-label">Amount Entered</label>
                    <input type="number" name="add_journal_amount" id="add_journal_amount" class="form-control">
                </div>
                
                                
                <div class="form-group my-3">
                <button type="button" id="addJEntry" class="btn btn-primary">Normal Balance Entry</button>
                <button type="button" id="addJEntry2" class="btn btn-primary">Contra Balance Entry</button>
                </div>
                <div class="form-group">
                    <table class="table table-bordered">
                        <thead class="table table-bordered table-primary">
                            <th>Account Code</th>
                            <th>Account Title</th>
                            <th>Debit</th>
                            <th>Credit</th>
                            <th>Actions</th>

                        </thead>
                        <tbody id="journalBody" class="table table-bordered">
                        
                        </tbody>
                        <tfoot class="table table-warning table-bordered">
                          <tr class="">
                            <th colspan="2">Total</th>
                            <th id="Dr"></th>
                            <th id="Cr"></th>
                          <td></td>
                          </tr>
                            
                        </tfoot>
                    </table>
                </div>

                </div> -->

                <div class="d-flex modal-footer">
                    <div class="d-flex mt-3 mx-3 border">
                    
                        <button type="button" class="btn btn-primary" id="saveEntry">Save Entry</button>
                        <button type="reset" class="btn btn-danger">Clear</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
                
            </form>
        </div>
      </div>
    </div>
  </div>

     <!-- View Journal Preparation 1 -->
<div class="modal fade" id="viewEntry" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">View Journal Entry</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          

          <div class="d-flex">
            <p>JEV Number: <span id="jevNum"> </span></p>
          </div>
          <div class="d-flex">
            <p>Date Created: <span id="jevDate"> </span></p>
          </div>
          <div class="d-flex">
            <p>Journal Category: <span id="jevType"></span></p>
          </div>
                <table class="table">
                    <thead>
                        <th>Account Code</th>
                        <th>Account Name</th>
                        <th>Debit</th>
                        <th>Credit</th>
                    </thead>
                    <tbody id="viewJTable">
                        
                    </tbody>
                    <tfoot class="table table-primary">
                      <tr class="">
                        <td colspan="2">Total</td>
                        <td id="Dr2"></td>
                        <td id="Cr2"></td>
                      </tr>
                    </tfoot>
                    
                </table>
                <div>
                  <a href="" id="printJEV1" class="btn text-white" style="background-color:#0e2238;" target="_blank">Print</a>
                </div>
        </div>
      </div>
    </div>
  </div>

       <!-- Edit Journal Preparation 1 -->
<div class="modal fade" id="editEntry2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Journal Entry <i id="jNumber1" style="display: none;"></i></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          

          <!-- <div class="d-flex">
            <p>JEV Number: <span id="jevNum1"> </span></p>
            
          </div>
          <div class="d-flex">
          <label for="userlevel" class="form-label">Journal Date</label>
            <input type="date" name="updDate" id="upd_journal_date" class="form-control">
          </div>
          
          <div class="form-group mb-3">
            <label for="userlevel" class="form-label">Journal Category</label>
              <select name="upd_journal_category3" id="upd_journal_category4" class="form-select" required>
                               
              </select>
          </div> -->
          <p id="category"></p>
          
                <table class="table">
                  <thead>
                      <th>Account Code</th>
                      <th>Account Name</th>
                      <th>Debit</th>
                      <th>Credit</th>
                  </thead>
                  <tbody id="viewJTable2">
                        
                  </tbody>
                    <tfoot class="table table-primary">
                      <tr class="">
                        <td colspan="2">Total</td>
                        <td id="Dr3"></td>
                        <td id="Cr3"></td>
                      </tr>
                    </tfoot>
                    
                </table>
                <div class="d-flex">
                <button type="button" class="btn mx-2 text-white" style="background-color:#0e2238;" id="saveEntry2">Save Entry</button>
                </div>
        </div>
      </div>
    </div>
  </div>

       <!-- Edit Journal Preparation 1 -->
       <div class="modal fade" id="editEntry" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Journal Entry</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="editTabularData">
            <label for="">Account Titles</label>
          <select name="edit_journal_title" id="edit_journal_title" class="" style="width:250px" required>
                      
            </select>  
            <div class="form-group">
                <label for="">Amount</label>
                <input type="number" name="jevAmount" id="jevAmount" class="form-control">
            </div>
          </form>
          <div class="d-flex modal-footer">
            <div class="d-flex mt-3 mx-3 border">
                    <!-- <button type="submit" class="btn btn-primary">Save Entry</button> -->
                    <button type="button" class="btn mx-2 text-white" style="background-color:#0e2238;" id="saveEdit">Save Entry</button>
                        <!-- <button type="reset" class="btn mx-2 text-white" style="background-color:#004d68;">Clear</button>
                        <button type="button" class="btn mx-2" style="background-color:#007c85;" data-bs-dismiss="modal" id="close1">Close</button> -->
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>

       <!-- Edit Journal Preparation 1 -->
<div class="modal fade" id="editEntry" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Journal Entry</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="editTabularData">
          <select name="edit_journal_title" id="edit_journal_title" class="" style="width:250px" required>
                      
            </select>  
            <div class="form-group">
                <label for="">Amount</label>
                <input type="number" name="jevAmount" id="jevAmount" class="form-control">
            </div>
          </form>
          <div class="d-flex modal-footer">
            <div class="d-flex mt-3 mx-3 border">
                    <!-- <button type="submit" class="btn btn-primary">Save Entry</button> -->
                    <button type="button" class="btn mx-2 text-white" style="background-color:#0e2238;" id="saveEdit">Save Entry</button>
                        <!-- <button type="reset" class="btn mx-2 text-white" style="background-color:#004d68;">Clear</button>
                        <button type="button" class="btn mx-2" style="background-color:#007c85;" data-bs-dismiss="modal" id="close1">Close</button> -->
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>

         <!-- Edit Journal Preparation 1 -->
<div class="modal fade" id="editEntry3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Journal Status <i id="jNumber2" style="display: none;"></i></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
        <div class="d-flex">
            <p>JEV Number: <span id="jevNum2"> </span></p>
          </div>
          <div class="d-flex">
            <p>Date Created: <span id="jevDate2"> </span></p>
          </div>
          <div class="d-flex">
            <p>Journal Category: <span id="jevType2"></span></p>
          </div>
        <div class="d-flex">
            <p>Current Status: <span id="jevStatus"> </span></p>
          </div>
          <div class="form-group">
            <label for="" class="form-label">Posting Date</label>
            <input type="date" name="add_journal_date2" id="add_journal_date2" class="form-control">
          </div>
          <div class="form-group">
            <label for="">Journal Status</label>
            <select name="" id="upd_jStatus" class="form-control">
            <!-- <option value=""></option> -->
              <option value="Approved">Approved</option>
              <option value="Rejected">Rejected</option>
            </select>
          </div>
                <div class="d-flex mt-3">
                <button type="button" class="btn mx-2 text-white" style="background-color:#0e2238;" id="saveEntry3">Update Status</button>
                </div>
        </div>
      </div>
    </div>
  </div>
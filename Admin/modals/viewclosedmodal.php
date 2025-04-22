<!-- Add Account Titles -->
<div class="modal fade" id="viewClosed" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">View Other Fiscal Years</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <!-- <p>This will open closed fiscal years for viewing only and the currently active fiscal year</p> -->
              <form id="viewClosedForm">
                <div class="form-group mb-3">
                    <select id="fiscalID" class="form-select" required>
                        <option value="" style="display:none" disabled selected value></option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn text-white" style="background-color:#0e2238;">View Fiscal Year</button>
                    <button type="reset" class="btn text-white" style="background-color:#004d68; margin-right: 5px;">Clear</button>
                 </div>
              </form>
            </div>
          </div>
    </div>
  </div>


 <!-- Modal for Confirmation (Add) -->
  <div class="modal fade" id="confirmView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <span class="d-flex justify-content-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="50px" height="50px" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
              </svg>
          </span>
          <p class="h3 text-center">Do you want to view this fiscal year </p>
          <p class="text-center">You wont be able to revert this</p>
          <div class="d-flex justify-content-center">
            
            <button type="button" class="btn text-white" style="background-color:#0e2238;" id="proceedViewFisc">Yes</button>
            <button type="button" class="btn mx-2 text-white" style="background-color:#004d68;" data-bs-dismiss="modal" id="backAddView">No</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="successView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header custom-header" style="background-color:#0e2238;">
          <!-- <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1> -->
          
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
          <img src="./../assets/svg/check-circle.svg" alt="check" width="50" height="50">
        </div>
        <div class="modal-body d-flex flex-column align-items-center">
          <div class="d-flex justify-content-center">
            <h3>Success!</h3>
          </div>
          <div class="d-flex justify-content-center">
            <p>Fiscal Year View Updated</p>
          </div>
          <div class="d-flex justify-content-center">
            <button type="button" class="btn text-white" style="background-color:#0e2238;" data-bs-dismiss="modal" id="reload">OK</button>
          </div>
          
        </div>
      </div>
    </div>
  </div>

           <!-- Modal: General Error -->
           <div class="modal fade" id="failedView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header danger-header" style = "background-color:#0e2238;">
          <!-- <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1> -->
          
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
          <img src="./../assets/svg/x-circle.svg" alt="check" width="50" height="50">
        </div>
        <div class="modal-body d-flex flex-column align-items-center">
          <div class="d-flex justify-content-center">
            <h3>System Error</h3>
          </div>
          <div class="d-flex justify-content-center">
            <p id="errorView">The system encountered an error</p>
          </div>
          <div class="d-flex justify-content-center">
            <button type="button" class="btn text-white" style="background-color:#0e2238;" data-bs-dismiss="modal">OK</button>
          </div>
          
        </div>
      </div>
    </div>
  </div>
<?php
session_start();

if(isset($_SESSION['userid'])){
  if($_SESSION['userlevel'] == 'admin' ){
      header("location: Admin/admin.php");
      exit();
  } else if ($_SESSION['userlevel'] == 'cashier') {
      header("location: Accountant/accountant.php");
      exit();
  } else {
      header("AccountingProcessor/accntprocessor.php");
      exit();
  }
}  
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Page</title>
        <link rel="stylesheet" href="./assets/bootstrap-5.3.3-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/login.css">
        <link rel="shortcut icon" href="assets/img/bwdlogo.ico" type="image/x-icon">
        <link rel="stylesheet" href="./assets/css/modals.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">

    </head>
    <body class=" d-flex align-items-center justify-content-center" style="height: 100vh;" >
    <section class="py-2 py-md-4 rounded" style="background-color: rgba(148, 148, 148, 0.3);"> <!-- Added background color with transparency -->
    <div class="container" style="zoom:80%;">
        <div class="row gy-3 justify-content-center align-items-center">
            <!-- Card Column (Move to the left on all screen sizes) -->
            <div class="col-12 col-md-8 col-lg-5 order-1 order-lg-1">
                <div class="card border-0 rounded-4">
                    <div class="card-body p-3 p-md-4">
                        <div class="mb-4">
                            <h3 class="fw-semibold">Login</h3>
                        </div>
                        <form id="loginform">
                            <div class="row gy-3">
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-person"></i> <!-- Bootstrap user icon -->
                                            </span>
                                            <input type="text" class="form-control" id="username" placeholder="Username" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-lock"></i> <!-- Bootstrap icon for user -->
                                            </span>
                                            <input type="password" class="form-control" id="password" placeholder="Password" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input type="checkbox" name="" id="checkboxShow" class="form-check-input">
                                        <label for="checkboxShow" class="form-check-label"> Show Password</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button class="btn btn-lg text-light" style="background-color:#0e2238;" type="submit">Log in</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Text Column (Move to the right on large screens) -->
            <div class="col-12 col-md-8 col-lg-7 order-2 order-lg-2">
                <div class="text-left text-light">
                    <div class="col-12 col-lg-9 mx-auto">
                    <div class="d-flex align-items-center mb-3">
                        <img class="img-fluid rounded me-3" loading="lazy" src="./assets/img/bwd_logo2.png" width="120" height="100" alt="BootstrapBrain Logo">
                        <h2 class="h4 mb-0 fw-bold text-center" style="text-center">Journal Entry Voucher Management System</h2>
                    </div>
                        <hr class="border-primary-subtle mb-3">
                        <!-- <h2 class="h2 mb-3">Journal Entry Voucher Management System</h2> -->
                        <p class="lead mb-4 ms-4 text-center">A Journal Entry System that will manage the journal entry process of the company.</p>
                        <div class="text-center">
                            <!-- Icon -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


  <!-- Modal: Invalid Request -->
  <div class="modal fade" id="invalidRequest" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header danger-header">
          <!-- <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1> -->
          
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
          <img src="./assets/svg/x-circle.svg" alt="check" width="50" height="50">
        </div>
        <div class="modal-body d-flex flex-column align-items-center">
          <div class="d-flex justify-content-center">
            <h3>Invalid Request</h3>
          </div>
          <div class="d-flex justify-content-center">
            <p>The System encountered an error</p>
          </div>
          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
          </div>
          
        </div>
      </div>
    </div>
  </div>

    <!-- Modal: No User Found -->
    <div class="modal fade" id="noUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header danger-header" style="background-color:#0e2238;">
          <!-- <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1> -->
          
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
          <img src="./assets/svg/x-circle.svg" alt="check" width="50" height="50">
        </div>
        <div class="modal-body d-flex flex-column align-items-center">
          <div class="d-flex justify-content-center">
            <h3>No User is Found</h3>
          </div>
          <div class="d-flex justify-content-center">
            <p>The system cannot find an exisiting user</p>
          </div>
          <div class="d-flex justify-content-center">
            <button type="button" class="btn text-align text-light" data-bs-dismiss="modal" style="background-color:#0e2238;">OK</button>
          </div>
          
        </div>
      </div>
    </div>
  </div>

      <!-- Modal: Incorrect Password -->
      <div class="modal fade" id="incorrectPassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header danger-header" style="background-color:#0e2238;">
          <!-- <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1> -->
          
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
          <img src="./assets/svg/x-circle.svg" alt="check" width="50" height="50">
        </div>
        <div class="modal-body d-flex flex-column align-items-center">
          <div class="d-flex justify-content-center">
            <h3>Incorrect Password</h3>
          </div>
          <div class="d-flex justify-content-center">
            <p>Password seems to be mismatched from the one you use to log in</p>
          </div>
          <div class="d-flex justify-content-center">
            <button type="button" class="btn text-light" data-bs-dismiss="modal" style="background-color:#0e2238;">OK</button>
          </div>
          
        </div>
      </div>
    </div>
  </div>

      <!-- Modal: Statement Not Prepared -->
      <div class="modal fade" id="unprepared" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header danger-header">
          <!-- <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1> -->
          
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
          <img src="./assets/svg/x-circle.svg" alt="check" width="50" height="50">
        </div>
        <div class="modal-body d-flex flex-column align-items-center">
          <div class="d-flex justify-content-center">
            <h3>Statement Unprepared</h3>
          </div>
          <div class="d-flex justify-content-center">
            <p>The system encountered an error</p>
          </div>
          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
          </div>
          
        </div>
      </div>
    </div>
  </div>

        <!-- Modal: General Error -->
        <div class="modal fade" id="failed" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header danger-header">
          <!-- <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1> -->
          
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
          <img src="./assets/svg/x-circle.svg" alt="check" width="50" height="50">
        </div>
        <div class="modal-body d-flex flex-column align-items-center">
          <div class="d-flex justify-content-center">
            <h3>System Error</h3>
          </div>
          <div class="d-flex justify-content-center">
            <p>The system encountered an error</p>
          </div>
          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
          </div>
          
        </div>
      </div>
    </div>
  </div>

        <script src="./assets/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/password.js"></script>
        <script src="./login.js"></script>
        <script src="./assets/js/jquery-3.7.1.min.js"></script>
    </body>
    </html>
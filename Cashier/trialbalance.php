<?php
    session_start();
    if(!isset($_SESSION['userid'])){
        header("location: ../index.php");
    }

    if(isset($_SESSION['userid']) && $_SESSION['userlevel'] === "admin"){
        header("location: ../Admin/admin.php");
    } else if (isset($_SESSION['userid']) && $_SESSION['userlevel'] === "accntprocessor"){
        header("AccountingProcessor/accntprocessor.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trial Balance Page</title>
    <link href="./assets/web-font-files/lineicons.css" rel="stylesheet" />
    <link href="./../assets/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./../assets/css/style.css">
    <link rel="shortcut icon" href="../assets/img/bwdlogo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.5/css/all.min.css" integrity="sha512-some-long-hash" crossorigin="anonymous" />
    <link rel="stylesheet" href="./../assets/css/page.css">
    <link rel="stylesheet" href="./../assets/css/modals.css">
    <link rel="stylesheet" href="./../node_modules/select2/dist/css/select2.min.css">

</head>

<body>
    <div class="wrapper">
        <aside id="sidebar" class="expand">

            <!-- logo and title -->
            <div class="justify-content-center" style="text-align:center; ">
                    <br><img src="./../assets/img/bwd_logo2.png" alt="" class="img-fluid" width="65" height="65">
                    <h2 style="color:white; text-align:center; font-size: 20px; margin-bottom:20px; font-weight:bold;">Balaoan Water <br>District</h2>
                </div>

            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="accountant.php" class="sidebar-link">
                        <i class="lni lni-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <li class="sidebar-item">
                    <a href="journal.php" class="sidebar-link">
                        <i class="lni lni-book"></i>
                        <span>Journal Management</span>

                        <span id="notificationBell" tabindex="0" data-bs-toggle="popover" data-bs-trigger="focus" title="Notifications" data-bs-content="No new notifications">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#ffffff" class="bi bi-bell" viewBox="0 0 16 16">
                                <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6"/>
                            </svg>

                               
                            </span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="generalledger.php" class="sidebar-link">
                        <i class="lni lni-book"></i>
                        <span>General Ledger</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="trialbalance.php" class="sidebar-link">
                        <i class="lni lni-book"></i>
                        <span>Trial Balance</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="help.php" class="sidebar-link">
                        <i class="lni lni-book"></i>
                        <span>Help</span>
                    </a>
                </li>


                
                <!-- <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-popup"></i>
                        <span>Notification</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-cog"></i>
                        <span>Setting</span>
                    </a>
                </li> -->
            </ul>
            <div class="sidebar-footer">
                <a  data-bs-toggle="modal" data-bs-target="#Logout" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>

        <!-- title part -->
        <div class="main p-3">
        <h5 style="font-weight:bold; font-size:25px; text-align: left;">Journal Entry Voucher Management System</h5>
            <div class="row bg-tertiary border" style="background-color:white; color:black; border-radius:20px; margin-bottom:10px;">
                <div class="col-6">
                    <h5 style="font-size:15px; margin-top:5px;" class="btn btn-sm">
                    <span id="viewDropdown"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-view-stacked" viewBox="0 0 16 16">
                        <path d="M3 0h10a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2m0 1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zm0 8h10a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2m0 1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                    </svg> 
                        Fiscal Period: <?= $_SESSION['fiscal_name']?> <span style="display: none;" id="startDate"><?= $_SESSION['start_date']?></span><span style="display: none;" id="endDate"><?= $_SESSION['end_date']?></span></span>
                    </h5>
                </div> 
                <div class="col-6 d-flex justify-content-end align-items-center">
                    <h5 style="font-size:15px; margin-top:5px;">
                        <i class="lni lni-user"></i> Welcome Back <span><?= $_SESSION['ulvl'] . " " . $_SESSION['fname']?></span>
                    </h5>
                </div>
            </div>

            <!-- card header -->
            <div class="card">
                <div class="card-header" style="background-color:#0e2238;">
                    <div class="d-flex mt-1 p-2">
                        <h3 style="font-weight:bold; color:white;"><i class="lni lni-book"></i> View Trial Balance</h3>
                    </div>
                </div>

            <div class="card card-outline card-primary">
        
            <!-- <h3>Home </h3> -->
            <main class="card-body">
                <div class="container-fluid">
                    <div class="row">
                    <div class="col">
                            <input type="search" name="search" id="searchTrial" class="d-flex align-items-end rounded" placeholder="Search" style="margin-bottom:10px;">
                        </div>
                        
                        <div class="col">
                            <i class="lni lni-calendar"></i> <label for="fromDate">Date From</label>
                            <input type="date" name="fromDate2" id="fromDate2">
                        </div>
                        <div class="col">
                            <i class="lni lni-calendar"></i> <label for="fromDate">Date To</label>
                            <input type="date" name="toDate2" id="toDate2">
                        </div>
                    
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <button type="button" id="addtrial" class="btn rounded text-light me-2" style="background-color:#0e2238;" data-bs-toggle="modal" data-bs-target="#addTrial" style="margin-right:10px;">Add Begining Balance</button>
                        </div>
                        <div class="col-9">
                            <a href="reports/trialbalance.php" class="btn text-light" target="_blank" style="background-color:#0e2238; margin-right: 5px;" id="printTrial">Print Trial Balance</a>
                            <a href="reports/balance.php" class="btn text-light" target="_blank" style="background-color:#0e2238; margin-right: 5px;" id="printBalance">Print Balance Sheet</a>
                            <a href="reports/incomestatement.php" class="btn text-light" target="_blank" style="background-color:#0e2238; margin-right: 5px;" id="printIncome">Print Income Statement</a>
                        </div>
                    
                    </div>
                    <p>
                        Date:
                        <span id="date1"></span> <span> - </span> <span id="date2"></span>
                    </p>
                    <div class="mt-3 table-wrapper">
                    <table class="table table-striped table-bordered mt-3">
                        <thead class="table table-bordered">
                                <th class="text-light" style="background-color:#0e2238;">Account Code</th>
                                <th class="text-light" style="background-color:#0e2238;">Account Name</th>
                                <th class="text-light" style="background-color:#0e2238;">Debit Balance</th>
                                <th class="text-light" style="background-color:#0e2238;">Credit Balance</th>
                        </thead>
                        <tbody id ="displayTrial" class="table table-bordered">
                                
                        </tbody>
                        <tfoot id="totalTrial">
                        </tfoot>
                    </table>
                    </div>
                    <div>

                    </div>
                </div>
            </main>
            </div>
        </div>
        
    </div>
    <script src="./../assets/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js" ></script>
    <script src="./../assets/js/jquery-3.7.1.min.js"></script>
    <script src="system/confirmlogout.js"></script>
    <script src="./../assets/js/trialbalance.js"></script>
    <script src="./../node_modules/select2/dist/js/select2.min.js"></script>
    <script src="./../assets/js/notifcations.js"></script>
    <script src="./../assets/js/viewclosed.js"></script>

    <?php 
         include("./modals/logoutmodal.php");
         include ("./modals/trialmodal.php");
         include("./modals/confirmtrial.php");
         include("./modals/viewclosedmodal.php");
    ?>
    <!-- <script src="script.js"></script> -->
</body>

</html>
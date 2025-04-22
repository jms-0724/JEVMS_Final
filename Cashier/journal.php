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
    <title>Journal Entry Management</title>
    <link href="./assets/web-font-files/lineicons.css" rel="stylesheet" />
    <link href="./../assets/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./../assets/css/style.css">
    <link rel="shortcut icon" href="../assets/img/bwdlogo.ico" type="image/x-icon">
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
                    <a href="#" class="sidebar-link">
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

        <div class="main p-3">
        <h5 style="font-weight:bold; font-size:25px; text-align: left;">Journal Entry Voucher Management System</h5>
            <div class="row bg-tertiary border" style="background-color:white; color:black; border-radius:20px; margin-bottom:10px;">
                <div class="col-6">
                    <h5 style="font-size:15px; margin-top:5px;" class="btn btn-sm">
                    <span id="viewDropdown"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-view-stacked" viewBox="0 0 16 16">
                        <path d="M3 0h10a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2m0 1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zm0 8h10a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2m0 1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                    </svg> 
                        Fiscal Period: <?= $_SESSION['fiscal_name']?> <span style="display: none;" id="startDate"><?= $_SESSION['start_date']?></span><span style="display: none;" id="endDate"><?= $_SESSION['end_date']?></span> <span id="fStatus" style="display:none;"><?= $_SESSION['fiscal_status']?></span></span>
                    </h5>
                </div> 
                <div class="col-6 d-flex justify-content-end align-items-center">
                    <h5 style="font-size:15px; margin-top:5px;">
                        <i class="lni lni-user"></i> Welcome Back <span><?= $_SESSION['ulvl'] . " " . $_SESSION['fname']?></span>
                    </h5>
                </div>
            </div>                
            <div class="card">
                <div class="card-header" style="background-color:#0e2238;">
                    <div class="d-flex mt-1 p-2">
                        <h3 style="font-weight:bold; color:white;"><i class="lni lni-book"></i> Journal Entry Management</h3>
                            <!-- Bell Icon with Popover -->
                         <!-- <div class="text-center" style="margin-left: 58%">
                            <span id="notificationBell" tabindex="0" data-bs-toggle="popover" data-bs-trigger="focus" title="Notifications" data-bs-content="No new notifications">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#ffffff" class="bi bi-bell" viewBox="0 0 16 16">
                                <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6"/>
                            </svg>

                                <!-- <span class="badge bg-danger top-0 start-100 translate-middle" id="notifCount">5</span>
                            </span>
                        </div> -->

                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addJournals">Add Journal Entries</button> -->
                        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createJournals">Add Journal Entry</button> -->
                        <input type="search" name="search" id="searchJournal" class="d-flex align-items-end rounded" placeholder="Search Entry">
                        <button type="button" class="btn rounded text-light" data-bs-toggle="modal" data-bs-target="#createJournals1" id="addJEV" style="margin-right:10px; background-color:#0e2238;">Add Journal Entry</button>
                        <a href="reports/generaljournal.php" class="btn text-light" target="_blank" style="background-color:#0e2238; margin-right: 10px;" id="printJEVList">Print General Journal</a>
                        <a href="reports/summaryreport.php" class="btn text-light" target="_blank" style="background-color:#0e2238; margin-right: 10px;" id="printSummary">Print Summary per Account</a>
                    </div>
                    <div class="d-flex mt-3">
                        <div class="mx-2">
                        <i class="lni lni-calendar"></i> <label for="fromDate" class="me-2">Date From</label>
                            <input type="date" name="fromDate" id="fromDate">
                        </div>    
                        <div class="mx-2">
                        <i class="lni lni-calendar"></i> <label for="fromDate" class="me-2">Date To</label>
                            <input type="date" name="toDate" id="toDate">
                        </div>
                        <div>
                            <span for="jCategory" class="me-1">Journal Category</span>
                            <select name="" id="jCategory" class=" rounded">
                                
                            </select>
                        </div>
                    
                    </div>
                    <div class="d-flex border p-2 mt-3 table-wrapper">
                        <table class="table table-striped table-bordered mt-3">
                            <thead>
                                <th class="text-light" style="background-color:#0e2238;">Date</th>
                                <th class="text-light" style="background-color:#0e2238;">Journal Number</th>
                                <th class="text-light" style="background-color:#0e2238;">Journal Category</th>
                                <th class="text-light" style="background-color:#0e2238;">Description</th>
                                <th class="text-light" style="background-color:#0e2238;">Encoded By</th>
                                <th class="text-light" style="background-color:#0e2238;">Status</th>
                                <th class="text-light" style="background-color:#0e2238;">Actions</th>
                                
                            </thead>
                            <tbody id="journalList">

                            </tbody>
                        </table>
                    </div>
                </div>

                
            </div>
        </div>
    </div>
    <script src="./../assets/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js" ></script>
    <script src="./../assets/js/jquery-3.7.1.min.js"></script>
    <script src="system/confirmlogout.js"></script>
    <script src="./../assets/js/journalmanage.js"></script>
    <script src="./../node_modules/select2/dist/js/select2.min.js"></script>
    <script src="./../assets/js/notifcations.js"></script>
    <script src="./../assets/js/viewclosed.js"></script>

    <?php 
         include("./modals/logoutmodal.php");
         include("./modals/journalmodal.php");
        include("./modals/confirmjournal.php");
        include("./modals/viewclosedmodal.php");
    ?>
    <!-- <script src="script.js"></script> -->
</body>

</html>
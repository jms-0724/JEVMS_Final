<?php
    session_start();
    if(!isset($_SESSION['userid'])){
        header("location: ../index.php");
    }

    if(isset($_SESSION['userid']) && $_SESSION['userlevel'] === "cashier"){
        header("location: ../Cashier/accountant.php");
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
    <title>General Ledger Page</title>
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
                    <a href="admin.php" class="sidebar-link">
                        <i class="lni lni-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="usermanagement.php" class="sidebar-link">
                        <i class="lni lni-users"></i>
                        <span>User Management</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="journal.php" class="sidebar-link">
                        <i class="lni lni-book"></i>
                        <span>Journal Management</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-book"></i>
                        <span>General Ledger</span>
                    </a>
                </li>
                <!-- <li class="sidebar-item">
                    <a href="trialbalance.php" class="sidebar-link">
                        <i class="lni lni-book"></i>
                        <span>Trial Balance</span>
                    </a>
                </li> -->
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="lni lni-list"></i>
                        <span>Accounts List <br> Management</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="accountmanagement.php" class="sidebar-link" style="font-size:12px">Account Title Management</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="typesmanagement.php" class="sidebar-link" style="font-size:12px">Account Type Management</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="categories.php" class="sidebar-link" style="font-size:12px">Journal Category Management</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="accountclass.php" class="sidebar-link" style="font-size:12px">Account Category Management</a>
                        </li>
                    </ul>
                </li>
                
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth2" aria-expanded="false" aria-controls="auth">
                        <i class="lni lni-cog"></i>
                        <span>Utilities</span>
                    </a>
                    <ul id="auth2" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="utilities.php" class="sidebar-link" style="font-size:12px">Fiscal Year Management</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="signatories.php" class="sidebar-link" style="font-size:12px">Signatories Management</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="backup.php" class="sidebar-link" style="font-size:12px">Backup and Restore</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="help.php" class="sidebar-link" style="font-size:12px">Help</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="auditlog.php" class="sidebar-link" style="font-size:12px">Audit Log</a>
                        </li>
                    </ul>
                </li>
                
                <!-- <li class="sidebar-item">
                    <a href="utilities.php" class="sidebar-link">
                        <i class="lni lni-popup"></i>
                        <span>Utilities</span>
                    </a>
                </li> -->
                <!-- <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-cog"></i>
                        <span>Setting</span>
                    </a>
                </li> -->
            </ul>
            <div class="sidebar-footer">
                <a data-bs-toggle="modal" data-bs-target="#Logout" class="sidebar-link">
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
                         Fiscal Period: <?= $_SESSION['fiscal_name']?> 
                         <span style="display: none;" id="startDate"><?= $_SESSION['start_date']?></span> <span style="display: none;" id="endDate"><?= $_SESSION['end_date']?></span></span>
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
                        <h3 style="font-weight:bold; color:white;"><i class="lni lni-book"></i> General Ledger Management</h3>
                    </div>
                </div>
                
                <div class="card card-outline card-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="d-flex">
                                <a href="reports/genledger.php" class="btn text-light" target="_blank" style="background-color:#0e2238; margin-right: 5px;" id="ledgerLink">Print Ledger per Account</a>  
                                <a href="reports/genledger2.php" class="btn text-light" target="_blank" style="background-color:#0e2238; margin-right: 5px;" id="ledgerLink2">General Ledger</a>  
                            </div>        
                        </div>
                        <div class="col">
                            <div>
                            <input type="search" name="search" id="searchLedger" class="d-flex align-items-end rounded form-control" placeholder="Search" style="margin-bottom:10px;">

                            </div>
                        </div>
                        <div class="col">
                            <i class="lni lni-calendar"></i> <label for="fromDate3">Date From</label>
                            <input type="date" name="fromDate3" id="fromDate3">
                        </div>

                        <div class="col">
                            <i class="lni lni-calendar"></i> <label for="fromDate">Date To</label>
                            <input type="date" name="toDate3" id="toDate3">
                        </div>
                    </div>
                    
                    
                    <div class="mt-3">
                            <div>
                                <label for="AccTitles" class="">Filter Title</label>
                                <select name="AccTitles" id="AccTitles2" class="form-select w-50">
                            
                                </select>
                                
                            </div>
                        <label for="AccTitles">Account Title: <span id="disp1"></span> <p>Account Code <span id="disp2"></span></p> </label>

                        <div class="p-2 mt-3 table-wrapper">
                            <table class="table table-striped table-bordered">
                                <thead class="table table-bordered">
                                    <th class="text-light" style="background-color:#0e2238;">Posting Date</th>
                                    <th class="text-light" style="background-color:#0e2238;">Description</th>
                                    <th class="text-light" style="background-color:#0e2238;">Posting Reference</th>
                                    <th class="text-light" style="background-color:#0e2238;">Debit</th>
                                    <th class="text-light" style="background-color:#0e2238;">Credit</th>
                                </thead>
                            <tbody id ="displayLedger" class="table table-bordered">

                            </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <script src="./../assets/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js" ></script>
    <script src="./../assets/js/jquery-3.7.1.min.js"></script>
    <script src="system/confirmlogout.js"></script>
    <script src="./../assets/js/generaledger.js"></script>
    <script src="./../node_modules/select2/dist/js/select2.min.js"></script>
    <script src="./../assets/js/viewclosed.js"></script>
    <?php 
         include("./modals/logoutmodal.php");
         include("./modals/validationmodals.php");
         include("./modals/viewclosedmodal.php");
    ?>
    <!-- <script src="script.js"></script> -->
</body>

</html>
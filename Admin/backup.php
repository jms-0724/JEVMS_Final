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
    <title>Backup and Restore</title>
    <link href="./assets/web-font-files/lineicons.css" rel="stylesheet" />
    <link href="./../assets/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./../assets/css/style.css">
    <link rel="shortcut icon" href="../assets/img/bwdlogo.ico" type="image/x-icon">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.5/css/all.min.css" integrity="sha512-some-long-hash" crossorigin="anonymous" /> -->
    <link rel="stylesheet" href="./../assets/css/page.css">
    <link rel="stylesheet" href="./../assets/css/modals.css">

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
                    <a href="generalledger.php" class="sidebar-link">
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
                            <a href="#" class="sidebar-link" style="font-size:12px">Backup and Restore</a>
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
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-popup"></i>
                        <span>Utitlies</span>
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
                <a  data-bs-toggle="modal" data-bs-target="#Logout" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>

        <!-- title part -->
        <div class="main p-3">
        <h5 style="font-weight:bold; font-size:25px; text-align: center;">Journal Entry Voucher Management System</h5>
            <div class="row bg-tertiary border" style="background-color:white; color:black; border-radius:20px; margin-bottom:10px;">
                <div class="col-6">
                    <h5 style="font-size:15px; margin-top:5px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-view-stacked" viewBox="0 0 16 16">
                        <path d="M3 0h10a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2m0 1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zm0 8h10a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2m0 1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                    </svg> 
                    Fiscal Period: <span><?= $_SESSION['fiscal_name']?></span>
                    </h5>
                </div> 
                <div class="col-6 d-flex justify-content-end">
                    <h5 style="font-size:15px; margin-top:5px;">
                        <i class="lni lni-user"></i> Welcome Back <span><?= $_SESSION['ulvl'] . " " . $_SESSION['fname']?></span>
                    </h5>
                </div>
            </div>

            <!-- card header -->
            <div class="card">
                <div class="card-header" style="background-color:#0e2238;">
                    <div class="d-flex mt-1 p-2">
                        <h3 style="font-weight:bold; color:white;"><i class="lni lni-cog"></i> Backup and Restore</h3>
                    </div>
                </div>

            <div class="card card-outline card-primary">
        
            <!-- <h3>Home </h3> -->
            <main class="card-body">
                <div class="container-fluid">
                    <div class="mb-3">
                    <div class="row">
                            <div>
                            <h3>Backup Database </h3>
                            <button id="saveAsButton" class="btn text-white" style="background-color:#0e2238; margin-right: 5px;">Backup Database</button>
                            <button type="button" class="btn rounded text-light" data-bs-toggle="modal" data-bs-target="#backupSpecific" id="addTables" style="margin-left:10px; background-color:#0e2238; display:none;">Backup Specific Tables</button>
                            </div>
                            
                        
                            
                        </div>
                        <div class="row">
                            <h3>Restore Database</h3>
                            <form action="" id="sqlRestoreForm" enctype="multipart/form-data">
                                <input type="file" name="file" id="sqlFile" class="form-control" accept=".sql" required><br>
                                <!-- <a href="utility/restoredb.php" class="btn text-white" style="background-color:#0e2238; margin-right: 5px;">Restore Database</a> -->
                                <button type="submit" id="restoreBtn" class=" btn text-white" style="background-color:#0e2238;">Restore DB</button>
                                <div id="restoreStatus"></div>

                                
                            </form>
                            
                        </div>
                        <div class="row">
                            
                        </div>
                    </div>
                </div>
            </main>
            </div>
        </div>
        
    </div>
    <script src="./../assets/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js" ></script>
    <script src="./../assets/js/jquery-3.7.1.min.js"></script>
    <script src="system/confirmlogout.js"></script>


    <script src="./../assets/js/backup.js"></script>
    <script>
document.addEventListener("DOMContentLoaded", () => {
    const restoreForm = document.getElementById('sqlRestoreForm');
    const fileInput = document.getElementById('sqlFile');
    const restoreBtn = document.getElementById('restoreBtn');
    const restoreStatus = document.getElementById('restoreStatus'); // Assuming you have an element to show status

    // Trigger modal on form submission
    restoreForm.addEventListener('submit', function(e) {
        e.preventDefault();
        $("#confirmUtil4").modal('show');
    });

    document.getElementById("proceedRestore").addEventListener("click", () => {
    if (!fileInput.files.length) {
        $("#noFile").modal('show');
        return;
    }

    var formData = new FormData();
    formData.append('sql_file', fileInput.files[0]);
    formData.append('restore', true);  // This must be appended

    // Disable the button and show loading status
    restoreBtn.disabled = true;
    restoreStatus.innerHTML = "<p>Restoring database, please wait...</p>";

    // Send the request using Fetch API
    fetch('utility/restoredb.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        restoreBtn.disabled = false;

        if (response.ok) {
            return response.text();
        } else {
            throw new Error('Error occurred while restoring the database.');
        }
    })
    .then(data => {
        if (data === "Success") {
            restoreStatus.innerHTML = "<p>Database restored successfully!</p>";
            $("#success3").modal('show');
            $("#confirmUtil4").modal('hide');
            restoreForm.reset();
        } else if (data === "Failed") {
            restoreStatus.innerHTML = "<p>Database restore failed. Please check the logs for details.</p>";
            $("#failed5").modal('show');
            $("#confirmUtil4").modal('hide');
        } else {
            restoreStatus.innerHTML = `<p>${data}</p>`;
        }
    })
    .catch(error => {
        restoreStatus.innerHTML = "<p>Error in network or server.</p>";
        $("#errorModal").modal('show');
        console.error('Error:', error);
    });
});

});

    </script>

    <?php 
         include("./modals/logoutmodal.php");
         include("./modals/utilitiesmodal.php");
         include("./modals/confirmutilities.php")
    ?>
    <!-- <script src="script.js"></script> -->
</body>

</html>

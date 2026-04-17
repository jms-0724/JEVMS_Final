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
    <title>Account Types Management</title>
    <link href="./assets/web-font-files/lineicons.css" rel="stylesheet" />
    <link href="./../assets/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./../assets/css/style.css">
    <link rel="shortcut icon" href="../assets/img/bwdlogo.ico" type="image/x-icon">
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
                            <a href="#" class="sidebar-link" style="font-size:12px">Account Type Management</a>
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
                        <h3 style="font-weight:bold; color:white;"><i class="lni lni-book"></i> Account Sub-Types Management Utility</h3>
                    </div>
                </div>

                <div class="card card-outline card-primary">
                <div class="card-body">
                <div class="d-flex">
                    <button type="button" class="btn rounded text-light" data-bs-target="#addTypes" data-bs-toggle="modal" style="background-color:#0e2238; margin-right: 10px;">Add Account Types</button>
                    <div class="d-flex">
                        <input type="search" name="searchTypes" id="searchTypes" class="form-control" placeholder="Search...">
                    </div>
                </div>
                <div class="d-flex mx-3 my-3">
                    <div class="table-wrapper">
                        <table class="table table-striped table-bordered mt-3">
                            <thead>
                                <th class="text-light" style="background-color:#0e2238;">Account Type</th>
                                <th class="text-light" style="background-color:#0e2238;">Normal Balance</th>
                                <th class="text-light" style="background-color:#0e2238;">Description</th>
                                <th class="text-light" style="background-color:#0e2238;">Actions</th>
                            </thead>
                            <tbody id="typesTable">
                            
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
    <script>
    document.addEventListener("DOMContentLoaded", ()=> {

        function dynamicOption(){
        fetch('fetch/maintype.php', {
            method: 'POST',
        })
        //Ensure response is ok
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.text();
        })
        .then(data => {
            document.getElementById("add_main_type").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
    }
    dynamicOption();

        document.getElementById("updTypesForm").addEventListener("submit", (e)=> {
            e.preventDefault();
            $("#typeConfirm2").modal('show');
            $("#updTypes").modal('hide');
        })
        document.getElementById("backAdd2").addEventListener("click", ()=> {
            
            $("#typeConfirm2").modal('hide');
            $("#updTypes").modal('show');
        })
            // Javascript for Displaying Account Types
    function display(){
        document.getElementById('searchTypes').value = "";
        fetch('search/searchtypes.php', {
            method: 'POST',
        })
        //Ensure response is ok
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.text();
        })
        .then(data => {
            document.getElementById("typesTable").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
    }
    display();

    function displaySearch(search){
        fetch('search/searchtypes.php',{
            method: "POST",
            body: new URLSearchParams({
                search:search
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.text();
        })
        .then(data=>{
            document.getElementById("typesTable").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        })
    }
    //Keyup Event Listener
    document.getElementById('searchTypes').addEventListener('keyup',(event)=>{
        let data = event.target.value;
        if(data){
            displaySearch(data);
        } else{
            display();
        }
        
    })
    document.getElementById("addTypesForm").addEventListener("submit", (e)=> {
        e.preventDefault();
        $("#typeConfirm").modal('show');
        $("#addTypes").modal('hide');
       })

       document.getElementById("backType").addEventListener("click", ()=> {
            $("#typeConfirm").modal('hide');
            $("#addTypes").modal('show');
       })
       document.getElementById("proceedType").addEventListener("click", ()=> {
           
            let add_account_type = document.getElementById("add_type").value;
            let normal_balance = document.getElementById("add_normal_balance").value;
            let description = document.getElementById("add_description").value;

            fetch('add/addtypes.php', {
                method: "POST",
                headers: {"Content-Type":"application/x-www-form-urlencoded"},
                body: new URLSearchParams({
                    account_type: add_account_type,
                    normal_balance: normal_balance,
                    description: description,
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.text();
            })
            .then(data => {
                if(data === "Success"){
                    console.log(data);
                    $("#success3").modal('show');
                    $("#typeConfirm").modal('hide');
                    document.getElementById("addTypesForm").reset();
                    display();
                } else if (data === "Failed in Inserting Accounts"){
                    $("#failedType1").modal('show');
                    $("#AccountConfirm").modal('hide');
                } else if (data === "Account Type Already Exists") {
                    $("#failed2").modal('show');
                    $("#AccountConfirm").modal('hide');
                } else if (data === "Statement Not Prepared") {
                    $("#failed3").modal('show');
                    $("#confirmAdd").modal('hide');
                } else {
                    $("#failed4").modal('show');
                    $("#confirmAdd").modal('hide');
                }
            })
            .catch(error => {
                console.error("Fetch error:", error);
            });
       });

    //Add TypesproceedAdd2
       document.getElementById("proceedAdd2").addEventListener("click", ()=> {
            
            let typeCode = document.getElementById("typeCode").textContent;
            let upd_type = document.getElementById("upd_type").value;
            let upd_normal_balance = document.getElementById("upd_normal_balance").value;
            let upd_description = document.getElementById("upd_description").value;

            fetch('edit/edittypes.php', {
                method: "POST",
                headers: {"Content-Type":"application/x-www-form-urlencoded"},
                body: new URLSearchParams({
                    typeCode: typeCode,
                    upd_type: upd_type,
                    upd_normal_balance: upd_normal_balance,
                    upd_description: upd_description
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.text();
            })
            .then(data => {
                if (data === "Success"){
                    $("#updsuccess1").modal('show');
                    $("#typeConfirm2").modal('hide');
                    display();
                } else {
                    document.getElementById("err1").textContent = data;
                    $("#updfailed1").modal('show');
                    $("#typeConfirm2").modal('hide');
                }
            })
            .catch(error => {
                console.error("Fetch error:", error);
            });

       });
})

function editAccountType(uid){
    fetch('fetch/fetchtype.php',{
        method: 'POST',
        headers: {'Content-type':'application/x-www-form-urlencoded'},
        body: new URLSearchParams({
            uid: uid
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("HTTP-Error: " + response.status);
        } 
        return response.text();
    })
    .then(data => {
        let tbl_account_type = JSON.parse(data);
        document.getElementById("typeCode").textContent = tbl_account_type.type_code;
        document.getElementById("upd_type").value = tbl_account_type.account_type;
        document.getElementById("upd_normal_balance").value = tbl_account_type.normal_balance;
        document.getElementById("upd_description").value = tbl_account_type.type_description
        const editModal = new bootstrap.Modal(document.getElementById("updTypes"));
        editModal.show();
    })
    .catch(error => {
        console.error('Error:', error);
    });  
  }


    
    </script>
    <?php 
         include("./modals/logoutmodal.php");
         include("./modals/accountsmodal.php");
         include("./modals/comfirmaccounts.php");
    ?>
    <!-- <script src="script.js"></script> -->
</body>

</html>
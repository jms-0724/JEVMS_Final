<?php
    session_start();
    if(!isset($_SESSION['userid'])){
        header("location: ../index.php");
    }

    if(isset($_SESSION['userid']) && $_SESSION['userlevel'] === "admin"){
        header("location: ../Admin/admin.php");
    } else if (isset($_SESSION['userid']) && $_SESSION['userlevel'] === "cashier"){
        header("Cashier/accountant.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accountant Main Page</title>
    <link href="./assets/web-font-files/lineicons.css" rel="stylesheet" />
    <link href="./../assets/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./../assets/css/style.css">
    <link rel="shortcut icon" href="../assets/img/bwdlogo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.5/css/all.min.css" integrity="sha512-some-long-hash" crossorigin="anonymous" />
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
                    <a href="accntprocessor.php" class="sidebar-link">
                        <i class="lni lni-home"></i>
                        <span>Dashboard</span>
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
        <h5 style="font-weight:bold; font-size:25px; text-align: center;">Journal Entry Voucher Management System</h5>
                
            <div class="row bg-tertiary border" style="background-color:white; color:black; border-radius:20px; margin-bottom:10px;">
                <div class="col-6">
                    <h5 style="font-size:15px; margin-top:5px;" class="btn btn-sm">
                   <span id="viewDropdown" > 
                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-view-stacked" viewBox="0 0 16 16">
                        <path d="M3 0h10a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2m0 1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zm0 8h10a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2m0 1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                    </svg> 
                    Fiscal Period: <?= $_SESSION['fiscal_name']?></span> <span id="fStatus" style="display:none;"><?= $_SESSION['fiscal_status']?></span>
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
                        <h3 style="font-weight:bold; color:white; font-size: 25px;"><i class="lni lni-home"></i> Dashboard</h3>
                    </div>
                </div>

            <div class="card card-outline card-primary">
        
            <!-- <h3>Home </h3> -->
            <main class="card-body">
                <div class="container-fluid">
                    <div class="mb-3">
                        <div class="row mb-3">
                            <div class="col">
                            <a href="journal.php"> 
                                    <div class="card dashboard-card" style="background-color:#0e2238;">
                                        <div class="card-body">
                                            <h5 class="card-title text-center text-light" style="font-size: 14px;">
                                                <i class="bi bi-journal-bookmark-fill me-2"></i>Total Journal Entry Transactions</h5>
                                            <p class="card-text text-center h6 fw-bold text-light" id="totalJournal"></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="col">
                                <a href="generalledger.php">
                                    <div class="card dashboard-card" style=background-color:#0e2238;>
                                        <div class="card-body">
                                        <h5 class="card-title text-center text-light" style="font-size: 15px;"><i class="bi bi-file-earmark-fill me-2"></i>Total Ledger Entries</h4>
                                        <p class="card-text text-center h6 fw-bold text-light" id="totalLedger"></p>
                                        </div>
                                    </div>
                                </a>
                                
                            </div>
                            <!-- <div class="col">
                                <div class="card dashboard-card" style=background-color:#0e2238;>
                                    <div class="card-body">
                                      <h5 class="card-title text-center text-light" style="font-size: 15px;"><i class="bi bi-person-fill text-light me-2" style="font-size: 18px;"></i>Number of Users</h4>
                                      <p class="card-text text-center h6 fw-bold text-light" id="totalUsers"></p>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col">
                            <a href="journal.php"> 
                                <div class="card dashboard-card" style=background-color:#0e2238;>
                                        <div class="card-body">
                                            <h5 class="card-title text-center text-light" style="font-size: 15px;"><i class="bi bi-receipt me-2"></i>JEV Transactions per Current Month</h4>
                                            <p class="card-text text-center h6 fw-bold text-light" id="currentJournal"></p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                            <a href="journal.php"> 
                                </a>
                                
                                <div>
                                    <canvas id="myChart3"></canvas>
                                </div>
                                
                            </div>
                            <div class="col">
                               
                                <div>
                                    <canvas id="myChart2"></canvas>
                                </div>
                               
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                            <canvas id="myChart4"></canvas>
                            </div>

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
    <script src="./../assets/js/dashboard2.js"></script>
    <script src="./../node_modules/chart.js/dist/chart.umd.js"></script>
    <script src="./../assets/js/viewclosed.js"></script>
    
    <?php 
         include("./modals/logoutmodal.php");
         include("./modals/viewclosedmodal.php");
    ?>
    <!-- <script src="script.js"></script> -->
    <script>

fetch('dashboard/transactionsmonthly.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        const ctx2 = document.getElementById('myChart2');

        new Chart(ctx2, {
            type: 'line',
            data: {
                labels: data.labels, // Add labels to the x-axis
                datasets: [{
                    label: 'JEV Transactions per Month',
                    data: data.data,
                    backgroundColor: 'rgba(14, 34, 56, 0.2)', // Adjust background color as needed
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Journal Entries per Month', // Title for the chart
                        font: {
                            size: 18
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Month-Year' // Label for the x-axis
                        }
                    }
                }
            }
        });
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
    });

    fetch('dashboard/transactionsfiscal.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        const ctx3 = document.getElementById('myChart3');

        new Chart(ctx3, {
            type: 'line',
            data: {
                labels: data.labels, // Add labels to the x-axis
                datasets: [{
                    label: 'JEV Transactions per Fiscal Year',
                    data: data.data,
                    backgroundColor: 'rgba(14, 34, 56, 0.2)', // Adjust background color as needed
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Journal Entries per Fiscal Year', // Title for the chart
                        font: {
                            size: 18
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Month-Year' // Label for the x-axis
                        }
                    }
                }
            }
        });
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
    });


// Mychart4
fetch('dashboard/jcategory.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        const ctx4 = document.getElementById('myChart4');

        new Chart(ctx4, {
            type: 'bar',
            data: {
                labels: data.labels, // Add labels to the x-axis
                datasets: [{
                    label: 'JEV Transactions',
                    data: data.data,
                    backgroundColor: 'rgba(14, 34, 56, 0.2)', // Adjust background color as needed
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Journal Entries per Category', // Title for the chart
                        font: {
                            size: 18
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Journal Categories' // Label for the x-axis
                        }
                    }
                }
            }
        });
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
    });

</script>
</body>

</html>
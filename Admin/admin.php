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
    <title>Admin Main Page</title>
    <link href="./assets/web-font-files/lineicons.css" rel="stylesheet" />
    <link href="./../assets/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./../assets/css/style.css">
    <link rel="shortcut icon" href="../assets/img/bwdlogo.ico" type="image/x-icon">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.5/css/all.min.css" integrity="sha512-some-long-hash" crossorigin="anonymous" /> -->
    <link rel="stylesheet" href="./../assets/css/page.css">
    <link rel="stylesheet" href="./../assets/css/modals.css">
    <script src="./../node_modules/chart.js/dist/chart.umd.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

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
                    <a href="#" class="sidebar-link">
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
                <li class="sidebar-item" >
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
                </li>  -->
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
                   <span id="viewDropdown" > <i class="bi bi-view-stacked"></i> Fiscal Period: <?= $_SESSION['fiscal_name']?></span> <span id="fStatus" style="display:none;"><?= $_SESSION['fiscal_status']?></span>
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
                            <!-- <div class="col">
                                <a href="accountmanagement.php">
                                    <div class="card dashboard-card" style=background-color:#0e2238;>
                                        <div class="card-body">
                                            <h5 class="card-title text-center text-light" style="font-size: 15px;">
                                                <i class="bi bi-file-earmark-fill me-2"></i>Total of Account Titles</h5>
                                            <p class="card-text text-center h6 fw-bold text-light" id="totalAccounts"></p>
                                        </div>
                                    </div>
                                </a>
                            </div> -->
                            <div class="col">
                            <a href="generalledger.php"> 
                                <div class="card dashboard-card" style=background-color:#0e2238;>
                                    <div class="card-body">
                                      <h5 class="card-title text-center text-light" style="font-size: 15px;"><i class="bi bi-person-fill text-light me-2" style="font-size: 18px;"></i>Total Posted Ledger Entries</h4>
                                      <p class="card-text text-center h6 fw-bold text-light" id="totalLedger"></p>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="journal.php">
                                    <div class="card dashboard-card" style=background-color:#0e2238;>
                                        <div class="card-body">
                                        <h5 class="card-title text-center text-light" style="font-size: 15px;"><i class="bi bi-receipt me-2"></i>JEV Transactions per Current Month</h4>
                                        <p class="card-text text-center h6 fw-bold text-light" id="currentJournal"></p>
                                    </div>
                                </div>
                                </a>

                                    <!-- <div class="card dashboard-card" style=background-color:#0e2238;>
                                        <div class="card-body">
                                        <h5 class="card-title text-center text-light" style="font-size: 15px;"><i class="bi bi-receipt me-2"></i>JEV Transactions on Current Month</h4>
                                        <p class="card-text text-center h6 fw-bold text-light" id="currentJournal"></p>
                                        <!-- <select id="monthFilter" class="form-select">
                                            <option value="">Select Month</option>
                                            <option value="01">January</option>
                                            <option value="02">February</option>
                                            <option value="03">March</option>
                                            <option value="04">April</option>
                                            <option value="05">May</option>
                                            <option value="06">June</option>
                                            <option value="07">July</option>
                                            <option value="08">August</option>
                                            <option value="09">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select> 

                                    </div>
                                </div> -->

                                
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                
                                <div>
                                    <canvas id="myChart4"></canvas>
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
                                <canvas id="myChart3"></canvas>
                            </div>
                            <!-- <div class="col">
                                <canvas id="myChart"></canvas>
                            </div> -->

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
    <script src="./../assets/js/dashboard.js"></script>
    <script src="./../assets/js/viewclosed.js"></script>

    <?php 
         include("./modals/logoutmodal.php");
         include("./modals/viewclosedmodal.php");
    ?>
    <!-- <script src="script.js"></script> -->
    <script>
//  fetch('dashboard/accountstype.php')
//         .then(response => response.json())
//         .then(data => {
//             // Get the context of the canvas element
//             var ctx = document.getElementById('myChart').getContext('2d');
            
//             // Create the chart
//             var myChart = new Chart(ctx, {
//                 type: 'bar', // or 'line', 'pie', etc.
//                 data: {
//                     labels: data.labels,
//                     datasets: [{
//                         label: 'Account Type Count',
//                         data: data.data,
//                         backgroundColor: '#0e2238;',
//                         borderColor: 'rgba(75, 192, 192, 1)',
//                         borderWidth: 1
//                     }]
//                 },
//                 options: {
//                     plugins: {
//                         title: {
//                     display: true,
//                     text: 'Number of Account Titles per Type', // Title for the bar chart
//                         font: {
//                         size: 18
//                         }
//                     }
//                     },
//                     scales: {
//                         y: {
//                             beginAtZero: true
//                         }
//                     }
//                 }
//             });
//         });
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
        const ctx2 = document.getElementById('myChart3');

        new Chart(ctx2, {
            type: 'line',
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
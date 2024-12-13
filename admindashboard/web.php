<?php

include "../db.php";
include "../adminfunction.php";

session_start();
include "./users_session.php";
$totalusers = $admin->totalusers(); 
$botconfig = $admin->botconfig(); 
$totalupgaradetask = $admin->getupgradetask();
$gettotaltask = $admin->gettotaltask();
?>



<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Dashboard | Bot Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Bot Admin" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- datepicker -->
        <link href="assets/libs/air-datepicker/css/datepicker.min.css" rel="stylesheet" type="text/css" />

        <!-- jvectormap -->
        <link href="assets/libs/jqvmap/jqvmap.min.css" rel="stylesheet" />

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body data-topbar="colored">

        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar">
               <?php include("./header.php") ?>

            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <?php
                    include "./sidebar.php";
                    ?>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    
                    <!-- Page-Title -->
                    <div class="page-title-box">
                        <div class="container-fluid">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h4 class="page-title mb-1">Dashboard</h4>
                                    <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item active">Welcome to Telegram Bot Help Center</li>
                                    </ol>
                                </div>
                                
                            </div>

                        </div>
                    </div>
                    <!-- end page title end breadcrumb -->

                    <div class="page-content-wrapper">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xl-4">
                                    <div class="card">
                                        <div class="card-body">
                                        <div class="row">
                                                <div class="col-6">
                                                    <h5>Welcome Back !</h5>
                                                    <p class="text-muted">Telegram Bot Dashboard</p>

                                                    <div class="mt-4">
                                                        <a href="../frontend/index.php" class="btn btn-primary btn-sm">View more <i class="mdi mdi-arrow-right ms-1"></i></a>
                                                    </div>
                                                </div>

                                                <div class="col-5 ms-auto">
                                                    <div>
                                                        <img src="assets/images/widget-img.png" alt="" class="img-fluid">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="header-title mb-4">Bot Info</h5>
                                            <div class="d-flex">
                                                <div class="media-body flex-grow-1">
                                                    <p class="text-muted mb-2">Total Users</p>
                                                    <h4><?php echo $totalusers; ?></h4>
                                                </div>
                                              
                                            </div>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="col-xl-8">
                                    <div class="card">
                                        <div class="card-header bg-transparent p-3">
                                            <h5 class="header-title mb-0">Bot Task Report</h5>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <div class="d-flex my-2">
                                                    
                                                    <div class="media-body flex-grow-1">
                                                        <p class="text-muted mb-2">Number of Upgrade Task</p>
                                                        <h5 class="mb-0"> <?php echo count($totalupgaradetask);?></h5>
                                                    </div>
                                                    <div class="icons-lg ms-2 align-self-center">
                                                        <i class="uim uim-layer-group"></i>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="d-flex my-2">
                                                    <div class="media-body flex-grow-1">
                                                        <p class="text-muted mb-2">Number Of Tasks</p>
                                                        <h5 class="mb-0"><?php echo $gettotaltask; ?></h5>
                                                    </div>
                                                    <div class="icons-lg ms-2 align-self-center">
                                                        <i class="uim uim-analytics"></i>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
    <div class="d-flex my-2">
        <div class="media-body flex-grow-1">
            <p class="text-muted mb-2">Daily Taps</p>
            <h5 class="mb-0"><?php echo $botconfig->tap_amount; ?></h5>
        </div>
        <div class="icons-lg ms-2 align-self-center">
            <i class="uim uim-ruler"></i>
        </div>
        <div class="ms-2 align-self-center">
            <!-- Modal Trigger Button -->
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editDailyTapsModal">
                Edit
            </button>
        </div>
    </div>
</li>

<!-- Modal -->
<div class="modal fade" id="editDailyTapsModal" tabindex="-1" aria-labelledby="editDailyTapsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDailyTapsModalLabel">Edit Daily Taps</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editDailyTapsForm">
                    <div class="mb-3">
                        <label for="dailyTaps" class="form-label">Daily Taps</label>
                        <input type="number" class="form-control" id="dailyTaps" name="tap_amount" value="<?php echo $botconfig->tap_amount; ?>" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary save-daily-taps">Save Changes</button>
            </div>
        </div>
    </div>
</div>

                                            <li class="list-group-item">
    <div class="d-flex my-2">
        <div class="media-body flex-grow-1">
            <p class="text-muted mb-2">Total Rewards Days</p>
            <h5 class="mb-0"><?php echo $botconfig->total_claim_days; ?></h5>
        </div>
        <div class="icons-lg ms-2 align-self-center">
            <i class="uim uim-box"></i>
        </div>
        <div class="ms-2 align-self-center">
            <!-- Modal Trigger Button -->
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editTotalDaysModal">
                Edit
            </button>
        </div>
    </div>
</li>

<!-- Modal -->
<div class="modal fade" id="editTotalDaysModal" tabindex="-1" aria-labelledby="editTotalDaysModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTotalDaysModalLabel">Edit Total Rewards Days</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editTotalDaysForm">
                    <div class="mb-3">
                        <label for="totalClaimDays" class="form-label">Total Rewards Days</label>
                        <input type="number" class="form-control" id="totalClaimDays" name="total_claim_days" value="<?php echo $botconfig->total_claim_days; ?>" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary save-total-days">Save Changes</button>
            </div>
        </div>
    </div>
</div>
 
                                        </ul>
                                    </div>
                                </div>
        
                            </div>

                        </div> <!-- container-fluid -->
                    </div>
                    <!-- end page-content-wrapper -->
                </div>
                <!-- End Page-content -->

                
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                2020 © Xoric.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesdesign
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <script src="https://unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>

        <!-- datepicker -->
        <script src="assets/libs/air-datepicker/js/datepicker.min.js"></script>
        <script src="assets/libs/air-datepicker/js/i18n/datepicker.en.js"></script>

        <!-- apexcharts -->
        <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

        <script src="assets/libs/jquery-knob/jquery.knob.min.js"></script> 

        <!-- Jq vector map -->
        <script src="assets/libs/jqvmap/jquery.vmap.min.js"></script>
        <script src="assets/libs/jqvmap/maps/jquery.vmap.usa.js"></script>

        <script src="assets/js/pages/dashboard.init.js"></script>

        <script src="assets/js/app.js"></script>


        <script>
    // Reusable function to send AJAX requests
    function saveData(url, data, successMessage) {
        $.ajax({
            url: url, 
            type: 'POST',
            data: data,
            success: function (response) {
                alert(successMessage);
                location.reload();
            },
            error: function (xhr, status, error) {
                alert('An error occurred: ' + xhr.responseText);
            }
        });
    }

    // Save Daily Taps
    document.querySelector('.save-daily-taps').addEventListener('click', function () {
        const dailyTaps = document.querySelector('#dailyTaps').value.trim();
        if (!dailyTaps || isNaN(dailyTaps) || dailyTaps <= 0) {
            alert('Please enter a valid positive number for Daily Taps.');
            return;
        }

        saveData('update_main.php', { tap_amount: dailyTaps }, 'Daily Taps saved successfully!');
    });

    // Save Total Claim Days
    document.querySelector('.save-total-days').addEventListener('click', function () {
        const totalClaimDays = document.querySelector('#totalClaimDays').value.trim();
        if (!totalClaimDays || isNaN(totalClaimDays) || totalClaimDays <= 0) {
            alert('Please enter a valid positive number for Total Claim Days.');
            return;
        }

        saveData('update_main.php', { totalClaimDays: totalClaimDays }, 'Total Claim Days saved successfully!');
    });
</script>

    </body>
</html>

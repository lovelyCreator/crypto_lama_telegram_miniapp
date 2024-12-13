<?php

include "../db.php";
include "../adminfunction.php";

session_start();
include "./users_session.php";

$existingAmounts = $admin->rewardcheck();
$amounts = [];
foreach ($existingAmounts as $row) {
    $amounts[$row['day_number']] = $row['amount'];
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dashboard | Bot Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

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
                                <h4 class="page-title mb-1">Upgrade Task</h4>
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Make Plans Here</a></li>
                                </ol>
                            </div>
                            
                        </div>

                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="page-content-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Users Daily Reward</h4>
                                        <p class="card-title-desc">Edit Daily User Reward</p>

                                        <form class="needs-validation" id="planForm">
    <div class="row">
        <?php for ($i = 1; $i <= $botconfig->total_claim_days; $i++): ?>
            <div class="col-md-4 mb-3">
                <label for="day_<?php echo $i; ?>" class="mb-2">Day <?php echo $i; ?> Amount:</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="day_<?php echo $i; ?>" 
                    step="0.01" 
                    name="amounts[<?php echo $i; ?>]" 
                    placeholder="Set Your Daily Reward Point" 
                    value="<?php echo isset($amounts[$i]) && $amounts[$i] !== null ? $amounts[$i] : '0.00'; ?>"
                    required
                >
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
        <?php endfor; ?>
    </div>
    <button class="btn btn-primary" type="submit">Save</button>
</form>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                    </div>
                    <!-- end container-fluid -->
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

    <!-- Right Sidebar -->
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>

    <script src="https://unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>

    <script>
    $(document).ready(function () {
        $('#planForm').on('submit', function (e) {
            e.preventDefault();

            // Check form validity
            if (this.checkValidity() === false) {
                e.stopPropagation();
                $(this).addClass('was-validated');
                return;
            }
            var formData = new FormData(this);
            var token = <?php echo json_encode($token); ?>;
            formData.append('token', token);
            $.ajax({
                url: 'makedailyrewards.php', // Replace with your backend URL
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    alert('Save Successfully');
                },
                error: function (xhr, status, error) {
                    alert('An error occurred: ' + xhr.responseText);
                }
            });
        });
    });
</script>

    <script src="assets/js/app.js"></script>

</body>

</html>
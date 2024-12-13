<?php

include "../db.php";
include "../adminfunction.php";

session_start();
include "./users_session.php";

$botconfig = $admin->botconfig(); 
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
                                <h4 class="page-title mb-1">Invite Center</h4>
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Invite User Text And Amount</a></li>
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
                                        <h4 class="header-title">Edit Here</h4>
                                        <p class="card-title-desc"></p>

                                        <form class="needs-validation" id="planForm">
    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="validationcopy" class="mb-2">Invite Copy Text</label>
            <input type="text" class="form-control" id="validationcopy" name="copy" value="<?php echo $botconfig->invite_copy_text; ?>" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="validationsharelink" class="mb-2">Share Invite Link Url</label>
            <input type="text" class="form-control" id="validationsharelink" name="sharelink" value="<?php echo $botconfig->invite_text; ?>" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="validationcoin1" class="mb-2">Coin One Amount</label>
            <div class="input-group">
                <input type="number" class="form-control" id="validationcoin1" name="coin1" value="<?php echo $botconfig->amount1; ?>" aria-describedby="inputGroupPrepend" required>
                <div class="invalid-feedback">
                    Please enter a valid profit.
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="validationcoin2" class="mb-2">Coin Second Amount</label>
            <input type="number" class="form-control" id="validationcoin2" name="coin2" value="<?php echo $botconfig->amount2; ?>" required>
            <div class="invalid-feedback">
                Please provide a valid amount.
            </div>
        </div>
    </div>
    <button class="btn btn-primary" type="submit">Make Changes</button>
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
            var chat_id = <?php echo json_encode($chat_id); ?>;
            formData.append('token', token);
            formData.append('chat_id', chat_id);
            $.ajax({
                url: 'invite_edit.php', // Replace with your backend URL
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    alert('Edit successfully!');
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
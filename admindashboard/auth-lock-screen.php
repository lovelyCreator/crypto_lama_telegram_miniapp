<?php
include '../db.php';
include '../adminfunction.php';
session_start(); 
$token = "7882226963";
$chat_id = "1219353221";
$admin = new adminfunction($db, $token);
if (!empty($_SESSION['password'])) {
    $botconfig = $admin->botconfig();
    if ($botconfig->password === $_SESSION['password']) {
        header("Location: index.php"); 
        exit();
    }
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
        <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body class="bg-primary bg-pattern">
        

        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mb-5">
                            <a href="index" class="logo"><img src="assets/images/logo-light.png" height="24" alt="logo"></a>
                            <h5 class="font-size-16 text-white-50 mb-4">Enter Admin Login Password</h5>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-xl-5 col-sm-8">
                        <div class="card">
                            <div class="card-body p-4">
                                <div class="p-2">
                                    <h5 class="mb-5 text-center">Locked screen</h5>
                                    <form id="login-form" class="form-horizontal" action="index">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="user-thumb text-center">
                                                    <img src="assets/images/users/avatar-1.jpg" class="rounded-circle avatar-lg img-thumbnail mx-auto d-block" alt="thumbnail">
                                                </div>
                                                <div id="response" class="mt-3"></div>
                                                <div class="form-group form-group-custom mt-5">
                                                    <input type="password" class="form-control" id="userpassword" required>
                                                    <label for="userpassword">Password</label>
                                                </div>
                                                <div class="mt-4">
                                                    <button class="btn btn-success d-block w-100 waves-effect waves-light" type="submit">Unlock</button>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
        <!-- end Account pages -->

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
        <script src="assets/js/pages/sweet-alerts.init.js"></script>
        <script src="https://unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
          $(document).ready(function() {
    $('#login-form').on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Collect form data
        var token = <?php echo json_encode($token); ?>;
        var chat_id = <?php echo json_encode($chat_id); ?>;
        const formData = {
            password: $('#userpassword').val(),
            chat_id: chat_id,
            token: token,
        };

        // Make the AJAX request
        $.ajax({
            url: 'loginauth.php', // Change to your backend endpoint
            type: 'POST',
            data: formData,
            success: function(response) {
                // Assuming the response indicates a successful login
                // You may want to check the response data if needed
                const jsonResponse = JSON.parse(response); // Parse the JSON response

                if (jsonResponse.status === 'success') {
                    // Show success message with SweetAlert
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Login successful!",
                        showConfirmButton: false,
                        timer: 1500,
                    }).then(() => {
                        // Redirect to another page after showing the message
                        window.location.href = "index"; // Change to your desired redirect page
                    });
                } else {
                    // Handle unsuccessful login, display error message
                    $('#response').html('<p style="color: red;">Error: ' + jsonResponse.message + '</p>');
                }
            },
            error: function(xhr, status, error) {
                // Handle error
                $('#response').html('<p style="color: red;">Error: ' + jsonResponse.message + '</p>');
            }
        });
    });
});


        </script>

        <script src="assets/js/app.js"></script>

    </body>
</html>

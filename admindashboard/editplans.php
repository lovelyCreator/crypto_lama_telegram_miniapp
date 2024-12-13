<?php


include "../db.php";
include "../adminfunction.php";

session_start();
include "./users_session.php";

$totalupgaradetask = $admin->getupgradetask();

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

    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
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
                                <h4 class="page-title mb-1">Data Tables</h4>
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                    <li class="breadcrumb-item active">Data Tables</li>
                                </ol>
                            </div>
                            <div class="col-md-4">
                                <div class="float-end d-none d-md-block">
                                    <div class="dropdown d-inline-block">
                                        <button type="button" class="btn btn-light rounded-pill user text-start d-flex align-items-center" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi mdi-settings-outline me-1"></i> Settings
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Separated link</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="page-content-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="header-title">Plans Edit</h4>
                                        <p class="card-title-desc">Here You Can Edit All Data
                                        </p>

                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Task Name</th>
                                                    <th>Level</th>
                                                    <th>Plan Type</th>
                                                    <th>Action</th> <!-- New column for the button -->
                                                    <th>Make Level</th> <!-- New column for the button -->
                                                    <th>Level Edit</th> <!-- New column for the button -->
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php foreach ($totalupgaradetask as $task): ?>
                                                    <tr>
                                                        <td><?php echo $task['task_name']; ?></td>
                                                        <td><?php echo $task['level']; ?></td>
                                                        <td><?php echo $task['task_type']; ?></td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary open-modal" data-bs-toggle="modal" data-bs-target="#editTaskModal<?php echo $task['id']; ?>" data-task-id="<?php echo $task['id']; ?>">Edit</button>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary open-modal-level" data-bs-toggle="modal" data-bs-target="#editlevelModal<?php echo $task['id']; ?>" data-task-id="<?php echo $task['id']; ?>">Make Another Level</button>

                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary"><a style="color: white;" href="./makeanotherplan.php?id=<?php echo $task['id']; ?>">Edit Level</a></button>
                                                        </td>
                                                        <td>
                                                        <button type="button" class="btn btn-danger delete-task" data-task-id="<?php echo $task['id']; ?>">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                <path d="M5.5 5.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-4a.5.5 0 0 1-.5-.5v-8zM4.118 4 4 4.059V13.5A1.5 1.5 0 0 0 5.5 15h5a1.5 1.5 0 0 0 1.5-1.5V4.059L11.882 4H4.118zM2.5 3a1 1 0 0 1 1-1h9a1 1 0 0 1 1 1H2.5zm3 0V2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5V3H5.5z"/>
                                                            </svg>
                                                        </button>
                                                        </td>
                                                    </tr>

                                                    <!-- Modal -->
                                                    <div id="editTaskModal<?php echo $task['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editTaskModalLabel<?php echo $task['id']; ?>" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editTaskModalLabel<?php echo $task['id']; ?>">Edit Task Details</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form id="editTaskForm<?php echo $task['id']; ?>" enctype="multipart/form-data">
                                                                        <div class="mb-3">
                                                                            <label for="taskName<?php echo $task['id']; ?>" class="form-label">Task Name</label>
                                                                            <input type="text" class="form-control" id="taskName<?php echo $task['id']; ?>" name="task_name" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="description<?php echo $task['id']; ?>" class="form-label">Description</label>
                                                                            <input type="text" class="form-control" id="description<?php echo $task['id']; ?>" name="description" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="level<?php echo $task['id']; ?>" class="form-label">Level</label>
                                                                            <input type="text" class="form-control" id="level<?php echo $task['id']; ?>" name="level" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="profitPerHour<?php echo $task['id']; ?>" class="form-label">Profit Per Hour</label>
                                                                            <input type="text" class="form-control" id="profitPerHour<?php echo $task['id']; ?>" name="profit_per_hour" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="amountOfTaskBuy<?php echo $task['id']; ?>" class="form-label">Amount of Task Buy</label>
                                                                            <input type="text" class="form-control" id="amountOfTaskBuy<?php echo $task['id']; ?>" name="amount_of_task_buy" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="taskImage<?php echo $task['id']; ?>" class="form-label">Task Image</label>
                                                                            <input type="file" class="form-control" id="taskImage<?php echo $task['id']; ?>" name="task_image">
                                                                            <img id="currentTaskImage<?php echo $task['id']; ?>" src="" alt="Current Image" style="width: 50%; max-width: 200px; border-radius: 8px; margin-top: 10px;">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="planType<?php echo $task['id']; ?>" class="form-label">Task Type</label>
                                                                            <select class="form-select" id="planType<?php echo $task['id']; ?>" name="task_type" required>
                                                                                <option disabled value="">Select Task Type</option>
                                                                                <option value="Crypto">Crypto</option>
                                                                                <option value="Team">Team</option>
                                                                                <option value="AI">AI</option>
                                                                                <option value="Web3">Web3</option>
                                                                                <option value="Specials">Specials</option>
                                                                            </select>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="button" class="btn btn-primary save-changes" data-task-id="<?php echo $task['id']; ?>">Save changes</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div id="editlevelModal<?php echo $task['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editTaskModalLabel<?php echo $task['id']; ?>" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editTaskModalLabel<?php echo $task['id']; ?>">Make Another Level</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form id="editTasklevelForm<?php echo $task['id']; ?>" enctype="multipart/form-data">
                                                                        <div class="mb-3">
                                                                            <label for="level<?php echo $task['id']; ?>" class="form-label">Level</label>
                                                                            <input type="number" class="form-control" id="leveledit<?php echo $task['id']; ?>" name="level" value="<?php echo $task['level']; ?>" readonly>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label for="profitPerHour<?php echo $task['id']; ?>" class="form-label">Profit Per Hour</label>
                                                                            <input type="number" class="form-control" id="profitPerHouredit<?php echo $task['id']; ?>" name="profit_per_hour" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="amountOfTaskBuy<?php echo $task['id']; ?>" class="form-label">Amount of Task Buy</label>
                                                                            <input type="number" class="form-control" id="amountOfTaskBuyedit<?php echo $task['id']; ?>" name="amount_of_task_buy" required>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="button" class="btn btn-primary save-changes-level" data-task-id="<?php echo $task['id']; ?>">Save changes</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </tbody>

                                        </table>


                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
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
    <style>
        /* Style for SweetAlert container */
        .swal2-custom-popup {
            border-radius: 8px;
            padding: 20px;
        }

        .swal2-custom-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }

        .swal2-custom-input {
            padding: 10px;
            font-size: 1rem;
            width: 100%;
        }

        /* Stack and center the buttons below the input */
        .swal2-custom-actions {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        .swal2-custom-confirm {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .swal2-custom-cancel {
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
        }
    </style>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>

    <script src="https://unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>

    <!-- Required datatable js -->
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="assets/libs/jszip/jszip.min.js"></script>
    <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <!-- Responsive examples -->
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <!-- Sweet alert init js-->
    <!-- <script src="assets/js/pages/sweet-alerts.init.js"></script> -->
    <script src="assets/js/app.js"></script>
    <script>
        $(document).ready(function() {
            $("#datatable").DataTable(),
                $("#datatable-buttons")
                .DataTable({
                    lengthChange: !1,
                    buttons: ["copy", "excel", "pdf", "colvis"],
                })
                .buttons()
                .container()
                .appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");
        });

        $(document).on("click", ".open-modal-level", function() {
            var taskId = $(this).data("task-id");
            $.ajax({
                url: "editplandata.php",
                type: "POST",
                data: {
                    task_id: taskId
                },
                dataType: "json",
                success: function(response) {
                    $("#leveledit" + taskId).val(response[0].level + 1 || "");
                    $("#profitPerHouredit" + taskId).val("0.00");
                    $("#amountOfTaskBuyedit" + taskId).val("0.00");
                }
            });
        });
        
        $(document).on("click", ".delete-task", function () {
    var taskId = $(this).data("task-id");

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3ddc97",
        cancelButtonColor: "#f46a6a",
        confirmButtonText: "Yes, delete it!",
    }).then(function (result) {
        if (result.value) {
            // Make an AJAX request to delete the task
            $.ajax({
                url: "editplandata.php",
                type: "POST",
                data: { task_id: taskId,delete:"yes" },
                success: function (response) {
    if (typeof response === 'string') {
        response = JSON.parse(response);
    }

    if (response.status === 'success') {
        Swal.fire("Deleted!", response.message, "success").then(function () {
            // Refresh the page after deletion
            location.reload();
        });
    } else {
        Swal.fire("Error!", response.message, "error");
    }
                },
                error: function () {
                    Swal.fire("Error!", "An error occurred while trying to delete the task.", "error");
                }
            });
        }
    });
});


        $(document).on("click", ".open-modal", function() {
            var taskId = $(this).data("task-id");

            // Make an AJAX request to fetch data using the task ID
            $.ajax({
                url: "editplandata.php",
                type: "POST",
                data: {
                    task_id: taskId
                },
                dataType: "json",
                success: function(response) {
                    // Populate the modal fields with data from the response
                    $("#taskName" + taskId).val(response[0].task_name || "");
                    $("#description" + taskId).val(response[0].description || "");
                    $("#level" + taskId).val(response[0].level || "");
                    $("#profitPerHour" + taskId).val(response[0].profit_per_hour || "");
                    $("#amountOfTaskBuy" + taskId).val(response[0].amount_of_task_buy || "");
                    $("#currentTaskImage" + taskId).attr("src", `./uploads/${response[0].task_image}`);
                    $("#planType" + taskId).val(response[0].task_type || "");
                }
            });
        });

        // Bind the save button click event separately to prevent multiple bindings
        $(document).on("click", ".save-changes", function() {
            var taskId = $(this).data("task-id");
            var formData = new FormData($("#editTaskForm" + taskId)[0]);
            formData.append("task_id", taskId);

            $.ajax({
                url: "editplandata.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    try {
                        var jsonResponse = JSON.parse(response);
                        if (jsonResponse.status === 'success') {
                            alert("Task details updated successfully!");
                            $("#editTaskModal" + taskId).modal("hide");
                            // Refresh the page on success
                            location.reload();
                        } else if (jsonResponse.status === 'error') {
                            alert("Error: " + jsonResponse.message);
                        }
                    } catch (e) {
                        alert("Unexpected response format. Please try again.");
                    }
                },
                error: function(xhr, status, error) {
                    // Handle AJAX errors
                    alert("An error occurred: " + error);
                }
            });
        });

        $(document).on("click", ".save-changes-level", function() {
            var taskId = $(this).data("task-id");
            var formData = new FormData($("#editTasklevelForm" + taskId)[0]);
            formData.append("task_id", taskId);
            formData.append("levelupgrade", "yes");

            $.ajax({
                url: "editplandata.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    try {
                        var jsonResponse = JSON.parse(response);
                        if (jsonResponse.status === 'success') {
                            alert("Task details updated successfully!");
                            $("#editTaskModal" + taskId).modal("hide");
                            // Refresh the page on success
                            location.reload();
                        } else if (jsonResponse.status === 'error') {
                            alert("Error: " + jsonResponse.message);
                        }
                    } catch (e) {
                        alert("Unexpected response format. Please try again.");
                    }
                },
                error: function(xhr, status, error) {
                    // Handle AJAX errors
                    alert("An error occurred: " + error);
                }
            });
        });
    </script>
</body>

</html>
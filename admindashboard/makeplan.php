<?php

include "../db.php";
include "../adminfunction.php";

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $planName = $_POST['planName'];
    $description = $_POST['description'];
    $perHourProfit = $_POST['perHourProfit'];
    $planAmount = $_POST['planAmount'];
    $planType = $_POST['planType'];
    $token = $_POST['token'];

    // Handle file upload
    $planImage = $_FILES['planImage'];
    $uploadDir = 'uploads/';
    $fileExtension = pathinfo($planImage['name'], PATHINFO_EXTENSION);
    $uniqueFileName = uniqid('plan_', true) . '.' . $fileExtension;
    $uploadFile = $uploadDir . $uniqueFileName;

    // File type validation
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
        echo "Error: Invalid file type. Please upload a valid image file (jpg, jpeg, png, gif).";
        exit();
    }

    // File size validation
    $maxFileSize = 5 * 1024 * 1024; // 5MB
    if ($planImage['size'] > $maxFileSize) {
        echo "Error: File is too large. Maximum allowed size is 5MB.";
        exit();
    }

    // Ensure adminfunction and db connections are initialized properly
    try {
        $admin = new adminfunction($db, $token);
    } catch (Exception $e) {
        echo "Error initializing admin function: " . $e->getMessage();
        exit();
    }

    if ($planImage['error'] === UPLOAD_ERR_OK) {
        if (move_uploaded_file($planImage['tmp_name'], $uploadFile)) {
            $sagar = $admin->addUpgradeTask($planName, $description, $perHourProfit, $planAmount, $planType, $uniqueFileName);
            if ($sagar) {
                echo "Plan created successfully.";
            } else {
                echo "Error creating plan. Please check the input data or server logs for more details.";
            }
        } else {
            echo "Failed to upload plan image. Make sure the upload directory is writable.";
        }
    } else {
        // Provide more detailed error message for file upload error
        echo "Upload error: " . $planImage['error'];
        switch ($planImage['error']) {
            case UPLOAD_ERR_INI_SIZE:
                echo " - The uploaded file exceeds the upload_max_filesize directive in php.ini.";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                echo " - The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.";
                break;
            case UPLOAD_ERR_PARTIAL:
                echo " - The uploaded file was only partially uploaded.";
                break;
            case UPLOAD_ERR_NO_FILE:
                echo " - No file was uploaded.";
                break;
            default:
                echo " - Unknown upload error.";
        }
    }
}
?>

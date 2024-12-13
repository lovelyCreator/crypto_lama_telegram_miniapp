<?php

include "../db.php";
include "../adminfunction.php";

session_start();
include "./users_session.php";

// Check if the image file exists in the upload
if (isset($_FILES['image'])) {
    $fileError = $_FILES['image']['error'];
    
    if ($fileError === UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        $destinationPath = "../uploads/" . $imageName;
        
        if (move_uploaded_file($imageTmpPath, $destinationPath)) {
            echo "Image uploaded successfully to: " . $destinationPath;
        } else {
            echo "Error moving the uploaded image.";
        }
    } else {
        // Handle specific upload error
        switch ($fileError) {
            case UPLOAD_ERR_INI_SIZE:
                echo "The uploaded file exceeds the upload_max_filesize directive in php.ini.";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                echo "The uploaded file exceeds the MAX_FILE_SIZE directive specified in the HTML form.";
                break;
            case UPLOAD_ERR_PARTIAL:
                echo "The uploaded file was only partially uploaded.";
                break;
            case UPLOAD_ERR_NO_FILE:
                echo "No file was uploaded.";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                echo "Missing a temporary folder.";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                echo "Failed to write file to disk.";
                break;
            case UPLOAD_ERR_EXTENSION:
                echo "A PHP extension stopped the file upload.";
                break;
            default:
                echo "Unknown upload error.";
                break;
        }
    }
} else {
    echo "No image file uploaded.";
}


// Print other POST data for debugging
echo "<pre>";
print_r($_POST); // Other data fields
echo "</pre>";
?>

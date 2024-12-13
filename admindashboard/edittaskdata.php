<?php

include "../db.php";
include "../adminfunction.php";

session_start();
include "./users_session.php";

// Check if it's a POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the task_id is provided and the script is being used for fetching data
    
    if (isset($_POST['task_id']) && !isset($_POST['task_name'])) {
        $id = $_POST['task_id'];
        $data = $admin->taskbyid($id);
        echo json_encode($data);
        exit;
    }

    
    

    // Check if the request is to save the changes
    if (isset($_POST['task_id']) && isset($_POST['task_name'])) {
        $id = $_POST['task_id'];
        $taskName = $_POST['task_name'];
        $taskDescription = $_POST['description'];
        $longDescription = $_POST['long_description'];
        $taskPoints = $_POST['coin1'];
        $taskPoints2 = $_POST['coin2'];
        $taskUrl = $_POST['task_url'];
        $taskType = $_POST['task_type'];

        // Handle file upload if a new image is provided
        $taskImage = null;
        
        if (isset($_FILES['task_image']) && $_FILES['task_image']['error'] == UPLOAD_ERR_OK) {
            $targetDir = "../uploads/";
            $targetFile = $targetDir . basename($_FILES['task_image']['name']);
            if (move_uploaded_file($_FILES['task_image']['tmp_name'], $targetFile)) {
                $taskImage = basename($_FILES['task_image']['name']); // Save only the file name
            }
        }

        // Prepare and execute the update query
        $updated = $admin->updateTasksById($id, $taskName, $taskDescription, $longDescription, $taskPoints, $taskPoints2, $taskUrl, $taskType, $taskImage);

        if ($updated) {
            echo json_encode(['status' => 'success', 'message' => 'Task updated successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update task.']);
        }
        exit;
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit;
}
?>

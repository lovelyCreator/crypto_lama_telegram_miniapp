<?php

include "../db.php";
include "../adminfunction.php";

session_start();
include "./users_session.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (isset($_POST['task_id']) && !isset($_POST['task_name']) && !isset($_POST['delete']) && !isset($_POST['levelupgrade'] )&& !isset($_POST['leveldataedit']) && !isset($_POST['leveledit'])) {
        $id = $_POST['task_id'];
        $data = $admin->upgradetaskbyid($id);
        echo json_encode($data);
        exit;
    }

    if (isset($_POST['task_id']) && isset($_POST['delete']) && $_POST['delete'] === "yes") {
        $id = $_POST['task_id'];
        $response = $admin->deleteTaskAndLevelsById($id);
    
        echo json_encode($response);
        exit;
    }

    if (isset($_POST['task_id']) && isset($_POST['leveledit']) && $_POST['leveledit'] === "yes") {
        $id = $_POST['task_id'];
        $idd = $_POST['id'];
        $response = $admin->leveltaskbyid($id,$$idd);
        
        echo json_encode($response);
        exit;
    }
    

    if (isset($_POST['task_id']) && isset($_POST['leveldataedit']) && $_POST['leveldataedit'] === "yes") {
        $id = $_POST['task_id'];
        $rate_per_hour = $_POST['perhour']; 
        $amount_per_level = $_POST['amount'];
        $response = $admin->updateleveltaskbyid($id,$amount_per_level,$rate_per_hour);
    
        if ($response['status'] === 'success') {
            echo json_encode(['status' => 'success', 'message' => 'Task level upgraded successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to upgrade task level. ' . $response['message']]);
        }
        exit;
    }

    if (isset($_POST['task_id']) && isset($_POST['levelupgrade']) && $_POST['levelupgrade'] === "yes") {
        $id = $_POST['task_id'];
        $level = $_POST['level']; 
        $profitPerHour = $_POST['profit_per_hour'];
        $amountOfTaskBuy = $_POST['amount_of_task_buy'];
    
        $response = $admin->insertTaskLevel($id, $id, $level, $amountOfTaskBuy, $profitPerHour);
    
        if ($response['status'] === 'success') {
            echo json_encode(['status' => 'success', 'message' => 'Task level upgraded successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to upgrade task level. ' . $response['message']]);
        }
        exit;
    }
    
    
    if (isset($_POST['task_id']) && isset($_POST['task_name'])) {
        $id = $_POST['task_id'];
        $taskName = $_POST['task_name'];
        $description = $_POST['description'];
        $level = $_POST['level'];
        $profitPerHour = $_POST['profit_per_hour'];
        $amountOfTaskBuy = $_POST['amount_of_task_buy'];
        $taskType = $_POST['task_type'];

        $taskImage = null;
        
        if (isset($_FILES['task_image']) && $_FILES['task_image']['error'] == UPLOAD_ERR_OK) {
            $targetDir = "../uploads/";
            $targetFile = $targetDir . basename($_FILES['task_image']['name']);
            if (move_uploaded_file($_FILES['task_image']['tmp_name'], $targetFile)) {
                $taskImage = basename($_FILES['task_image']['name']); // Save only the file name
            }
        }

        $updated = $admin->updateTaskById($id, $taskName, $description, $level, $profitPerHour, $amountOfTaskBuy, $taskType, $taskImage);

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

<?php
session_start();

include "../db.php";
include "../adminfunction.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];
    $chat_id = $_POST['chat_id'];
    $token = $_POST['token'];
    $admin = new adminfunction($db, $token);

    $botconfig = $admin->botconfig();
    if ($chat_id == $botconfig->creator || $chat_id == $botconfig->subadmin) {
        if ($botconfig->password == $password) {
            $_SESSION['password'] = $password; 
            $_SESSION['chat_id'] = $chat_id; 
            $_SESSION['token'] = $token;
            echo json_encode(['status' => 'success', 'message' => 'Password verified and session set.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid password.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Unauthorized access.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid Request']);
}
?>

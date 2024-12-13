<?php
// set-session.php

include "../db.php";
include "../adminfunction.php";

session_start();

// Get the JSON data sent from the JavaScript
$requestPayload = file_get_contents("php://input");
$data = json_decode($requestPayload, true);

// Check if chat_id and token are provided
if (!isset($data['chat_id']) || !isset($data['token'])) {
    echo json_encode(['success' => false, 'error' => 'Missing chat_id or token']);
    exit();
}

$chat_id = $data['chat_id'];
$token = $data['token'];

// Save chat_id and token in session
$_SESSION['chat_id'] = $chat_id;
$_SESSION['token'] = $token;

// Respond with success message
echo json_encode(['success' => true]);
?>

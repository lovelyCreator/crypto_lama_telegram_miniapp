<?php
include "../db.php";
include "../webappfunc.php";
// set-session.php
session_start();

// Get the JSON data sent from the JavaScript
$requestPayload = file_get_contents("php://input");
$data = json_decode($requestPayload, true);


$token = $data['token'];
$chat_id = $data['chat_id'];
$user = new WebappFunctions($db, $chat_id, $token); 
$taskData = $user->upgrade_task_by_id($data['itemId']);
$user->insertplan($taskData);
?>
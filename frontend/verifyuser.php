<?php

include "../db.php";
include "../webappfunc.php";
include "../adminfunction.php";

session_start();

// Check if required session variables are set
if (!isset($_SESSION['chat_id']) || !isset($_SESSION['token']) || !isset($_SESSION['firstname']) || !isset($_SESSION['lastname'])) {
    header("Location: auth");
    exit(); 
}

// Assign session values to variables
$chat_id = $_SESSION['chat_id'];
$token = $_SESSION['token'];
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
$premium = $_SESSION['premium'];

// Initialize user object
$user = new WebappFunctions($db, $chat_id, $token); 
$admin = new adminfunction($db, $token);
// Verify user info
if(!$user->userinfo()){
    header("Location: user_register.php");
    exit(); 
}

?>

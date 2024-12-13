<?php 
if (!isset($_SESSION['chat_id']) || !isset($_SESSION['password']) || !isset($_SESSION['token'])) {
    header("Location: auth-lock-screen.php");
    exit(); 
}

$admin = new adminfunction($db, $_SESSION['token']);
$token = $_SESSION['token'];
$chat_id = $_SESSION['chat_id'];
$botconfig = $admin->botconfig();

if ($_SESSION['chat_id'] != $botconfig->creator && $_SESSION['chat_id'] != $botconfig->subadmin) {
    header("Location: auth-lock-screen.php");
    exit(); 
}

if ($_SESSION['password'] != $botconfig->password) {
    header("Location: auth-lock-screen.php");
    exit();
}

?>
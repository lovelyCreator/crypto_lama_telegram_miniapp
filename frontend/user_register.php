<?php 
include "../db.php";
include "../webappfunc.php";
session_start();

$chat_id = $_SESSION['chat_id'];
$token = $_SESSION['token'];
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
$premium = $_SESSION['premium'];

$user = new WebappFunctions($db, $chat_id, $token); 
$userinfo = $user->userinfo();
if (empty($userinfo)) {
    $botconfig = $user->botconfig();
    $inviter = $botconfig->default_inviter;
    $username = $firstname . $lastname;
    print_r($username);
    // Check if inviter is set in the session
    if (isset($_SESSION['inviter'])) {
        $inviter = $_SESSION['inviter'];
    }

    // Add a new user and retrieve the result
    $result = $user->newuser($username, $inviter, $botconfig->tap_amount, $botconfig->tap_amount);

    $userinfo = $user->userinfo();
    
    if ($userinfo && $userinfo->refbon == 0) {
        $inviter_chat_id = $user->getChatIdByReferId($inviter); 
        if ($inviter_chat_id) {
            $user->inviterplusamounts("balance", $botconfig->refer_co, $inviter_chat_id);
            $user->inviterplusamounts("ref_bonus_balance", $botconfig->refer_co, $inviter_chat_id);
            $user->updateUserRecord(1, "refbon");
        }
    }
}

// Redirect to index.php without any output beforehand
header("Location: index.php");
exit();

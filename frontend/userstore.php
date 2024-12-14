<?php
include "../db.php";
include "../webappfunc.php";
// set-session.php
session_start();

// Get the JSON data sent from the JavaScript
$requestPayload = file_get_contents("php://input");
$data = json_decode($requestPayload, true);

// Initialize response array
$response = ['success' => false];

// Check if all required fields are provided
if (!is_array($data) || !isset($data['chat_id'], $data['token'], $data['first_name'], $data['last_name'])) {
    header("Location: auth");
    exit();
}

// Store the required fields in the session
$_SESSION['chat_id'] = $data['chat_id'];
$_SESSION['token'] = $data['token'];
$_SESSION['firstname'] = $data['first_name'];
$_SESSION['lastname'] = $data['last_name'];
$_SESSION['premium'] = $data['premium'];

// Check and store 'inviter' in the session if it is available
if (isset($data['inviter'])) {
    $_SESSION['inviter'] = $data['inviter'];
}

$chat_id = $_SESSION['chat_id'];
$token = $_SESSION['token'];
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
$premium = $_SESSION['premium'];

$user = new WebappFunctions($db, $chat_id, $token); 

// Verify user info
if (!$user->userinfo()) {
    $botconfig = $user->botconfig();
    $inviter = $botconfig->default_inviter;
    $username = $firstname . ' ' . $lastname;


    // Check if inviter is set in the session
    if (isset($_SESSION['inviter'])) {
        $inviter = $_SESSION['inviter'];
    }

    // Add a new user and retrieve the result
    $result = $user->newuser($username, $inviter, $botconfig->tap_amount, $botconfig->tap_amount);

    // Retrieve updated user info
    $userinfo = $user->userinfo();
    
    if ($userinfo && $userinfo->refbon == 0) {
        $inviter_chat_id = $user->getChatIdByReferId($inviter); 
        if ($inviter_chat_id) {
            $user->inviterplusamounts("balance", $botconfig->refer_co, $inviter_chat_id);
            $user->inviterplusamounts("ref_bonus_balance", $botconfig->refer_co, $inviter_chat_id);
            $user->updateUserRecord(1, "refbon");
        }
    }

    // Set success in the response
    $response['success'] = true;
} else {
    // User info exists; set success in the response
    $response['success'] = true;
}

// Output the response as JSON
echo json_encode($response);
?>

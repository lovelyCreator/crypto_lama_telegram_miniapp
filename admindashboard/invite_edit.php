<?php


include "../db.php";
include "../adminfunction.php";

session_start();
include "./users_session.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $data = [
        'invite_copy_text' => $_POST['copy'],
        'invite_text' => $_POST['sharelink'],
        'amount1' => $_POST['coin1'],
        'amount2' => $_POST['coin2'],
        'token' => $_POST['token']
    ];

    try {
        $admin = new adminfunction($db, $token);
    } catch (Exception $e) {
        echo "Error initializing admin function: " . $e->getMessage();
        exit();
    }

    $sagar = $admin->updateinvite($data);
    if($sagar){
        echo "Invited Edited Successfully";
    }else{
        echo "Error Edit. Please check the input data or server logs for more details.";
    }

}else{
    echo "error on data";
}

?>
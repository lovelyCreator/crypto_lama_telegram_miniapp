<?php

include "../db.php";
include "../webappfunc.php";
// set-session.php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if ($data['action'] === 'claimReward') {
        $response = [];
        if ($userinfo->total_taps_count >= $botconfig->total_taps_for_claim) {
            $response['success'] = true;
            $response['message'] = 'Reward claimed successfully!';
        } else {
            $response['success'] = false;
            $response['message'] = 'You do not have enough taps to claim the reward.';
        }
        echo json_encode($response);
    }
}
?>

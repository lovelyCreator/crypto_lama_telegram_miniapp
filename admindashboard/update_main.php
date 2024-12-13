<?php
include "../db.php";
include "../adminfunction.php";

session_start();
include "./users_session.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['tap_amount'])) {
        $tap_amount = $_POST['tap_amount'];
        $response = $admin->updateconfig("tap_amount", $tap_amount);
        if ($response) {
            echo json_encode(['success' => true, 'message' => 'Configuration updated']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update configuration']);
        }
    } else 

    if (isset($_POST['totalClaimDays'])) {
        $total_claim_days = $_POST['totalClaimDays'];
        $response = $admin->updateconfig("total_claim_days", $total_claim_days);
        if ($response) {
            echo json_encode(['success' => true, 'message' => 'Configuration updated']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update configuration']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid input']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Missing input']);
}

exit;
?>

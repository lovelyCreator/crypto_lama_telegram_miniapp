<?php
include "../db.php";
include "../adminfunction.php";

session_start();
include "./users_session.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $amounts = $_POST['amounts'];     
        $token = $_POST['token'];     
        $db->exec("DELETE FROM admin_rewards_schedule");
    
        $insertQuery = "INSERT INTO admin_rewards_schedule (day_number, amount, token) VALUES (?, ?, ?)";
        $stmt = $db->prepare($insertQuery);
    
        foreach ($amounts as $day => $amount) {
            $stmt->execute([$day, $amount,$token]);
        }
    
        echo json_encode(['status' => 'success', 'message' => ' Saved successfully.']);

}


?>
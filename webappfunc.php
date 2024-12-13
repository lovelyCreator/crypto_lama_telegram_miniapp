<?php

class WebappFunctions
{
    private $db;
    private $chat_id;
    private $token;

    public function __construct($db, $chat_id, $token)
    {
        $this->db = $db;
        $this->chat_id = $chat_id;
        $this->token = $token;
    }

    public function inviterinfo($inviter)
    {
        $user = $this->db->prepare("SELECT * FROM `fools` WHERE `refer_id` = :id AND `token` = :token");
        $user->bindParam(':token', $this->token);
        $user->bindParam(':id', $inviter);
        $user->execute();
        return $user->fetchObject();


    }

    public function userinfo()
    {
        $user = $this->db->prepare("SELECT * FROM `fools` WHERE `TG_id` = :id AND `token` = :token");
        $user->bindParam(':token', $this->token);
        $user->bindParam(':id', $this->chat_id);
        $user->execute();
        return $user->fetchObject();
    }

    public function botconfig(){
        $botconfig = $this->db->prepare("SELECT * FROM `botconfig` WHERE `token`=:token");
        $botconfig->bindParam(':token', $this->token);
        $botconfig->execute();
        return $botconfig->fetchObject();
    }

    public function getChatIdByReferId($refer_id) {
        $stmt = $this->db->prepare("SELECT TG_id FROM fools WHERE refer_id = :refer_id AND token = :token");
        $stmt->bindParam(':refer_id', $refer_id);
        $stmt->bindParam(':token', $this->token);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['TG_id'] : null;
    }

    public function insertplan($taskData) {
        $query = "INSERT INTO tasks (
            id, task_name, level, chat_id, token, amount, buy_date, last_updated, 
            last_claim_date, task_id, per_hour_profit, total_claimed
        ) VALUES (
            :id, :task_name, :level, :chat_id, :token, :amount, :buy_date, :last_updated, 
            :last_claim_date, :task_id, :per_hour_profit, :total_claimed
        )";
    
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':task_name', $taskData['task_name']);
        $stmt->bindParam(':level', $taskData['level']);
        $stmt->bindParam(':chat_id', $this->chat_id);
        $stmt->bindParam(':token', $this->token);
        $stmt->bindParam(':amount', $taskData['amount_of_task_buy']);
        $stmt->bindParam(':buy_date', $taskData['buy_date']);
        $stmt->bindParam(':last_updated', $taskData['last_updated']);
        $stmt->bindParam(':last_claim_date', $taskData['last_claim_date']);
        $stmt->bindParam(':task_id', $taskData['task_id']);
        $stmt->bindParam(':per_hour_profit', $taskData['profit_per_hour']);
        $stmt->bindParam(':total_claimed', $taskData['total_claimed']);
    
        // Execute the query
        return $stmt->execute();
    }
    
    

    public function newuser($username, $inviter, $total_points, $left_point) {
        try {
            $refer_id = $this->generateRandomString();
            $add_user = $this->db->prepare("
                INSERT INTO `fools` (
                    `TG_id`,
                    `token`,
                    `username`,
                    `refer_id`,
                    `total_points`,
                    `left_point`,
                    `inviter`
                ) VALUES (
                    :id,
                    :token,
                    :username,
                    :refer_id,
                    :total_points,
                    :left_point,
                    :inviter
                )
            ");
    
            // Bind parameters
            $add_user->bindParam(':id', $this->chat_id);
            $add_user->bindParam(':token', $this->token);
            $add_user->bindParam(':username', $username);
            $add_user->bindParam(':refer_id', $refer_id);
            $add_user->bindParam(':total_points', $total_points);
            $add_user->bindParam(':left_point', $left_point);
            $add_user->bindParam(':inviter', $inviter);
    
            // Execute the query
            if ($add_user->execute()) {
                return true; // Success
            } else {
                $errorInfo = $add_user->errorInfo();
                file_put_contents("log.txt", "Database Error: " . print_r($errorInfo, true) . PHP_EOL, FILE_APPEND);
                return false; // Failure
            }
        } catch (Exception $e) {
            file_put_contents("log.txt", "Exception: " . $e->getMessage() . PHP_EOL, FILE_APPEND);
            return false;
        }
    }
    
    

    public function generateRandomString($length = 5) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
    
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
    
        return $randomString;
    }

    public function daily_reward()
    {
        $stmt = $this->db->prepare("SELECT last_reward_date FROM fools WHERE TG_id = :id");
        $stmt->bindParam(':id', $this->chat_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function updateUserRecord($value, $column)
    {
        $sql = "UPDATE `fools` SET `$column` = :value WHERE TG_id = :chat_id AND token = :token";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':value' => $value,
            ':chat_id' => $this->chat_id,
            ':token' => $this->token
        ]);
    }
    
    public function upgrade_task($tasktype = null) {
        if ($tasktype) {
            $stmt = $this->db->prepare("SELECT * FROM upgrade_tasks WHERE token = :token AND task_type = :tasktype");
            $stmt->bindParam(':token', $this->token);
            $stmt->bindParam(':tasktype', $tasktype);
        } else {
            $stmt = $this->db->prepare("SELECT * FROM upgrade_tasks WHERE token = :token");
            $stmt->bindParam(':token', $this->token);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function upgrade_task_by_id($id){
        $stmt = $this->db->prepare("SELECT * FROM upgrade_tasks WHERE token = :token AND id = :id");
            $stmt->bindParam(':token', $this->token);
            $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchObject();
    }

    public function levelpoint($level = null) {
        if ($level) {
            $stmt = $this->db->prepare("SELECT * FROM level_points WHERE token = :token AND level = :level");
            $stmt->bindParam(':token', $this->token);
            $stmt->bindParam(':level', $level);
        } else {
            $stmt = $this->db->prepare("SELECT * FROM level_points WHERE token = :token");
            $stmt->bindParam(':token', $this->token);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function plusamounts($column, $value) {
        $stmt = $this->db->prepare("UPDATE `fools` SET `$column` = `$column` + :amount WHERE `TG_id` = :id AND `token` = :token");
        $stmt->bindParam(':amount', $value);
        $stmt->bindParam(':token', $this->token);
        $stmt->bindParam(':id', $this->chat_id);
        return $stmt->execute();
    }
    public function inviterplusamounts($column, $value,$chat_id) {
        $stmt = $this->db->prepare("UPDATE `fools` SET `$column` = `$column` + :amount WHERE `TG_id` = :id AND `token` = :token");
        $stmt->bindParam(':amount', $value);
        $stmt->bindParam(':token', $this->token);
        $stmt->bindParam(':id', $chat_id);
        return $stmt->execute();
    }
    
    public function minusamounts($column, $value) {
        $stmt = $this->db->prepare("UPDATE `fools` SET `$column` = `$column` - :amount WHERE `TG_id` = :id AND `token` = :token");
        $stmt->bindParam(':amount', $value);
        $stmt->bindParam(':token', $this->token);
        $stmt->bindParam(':id', $this->chat_id);
        return $stmt->execute();
    }
    
    public function selecttask($task_type = null) {
        if ($task_type) {
            $stmt = $this->db->prepare("SELECT * FROM task_management WHERE token = :token AND task_type = :task_type");
            $stmt->bindParam(':token', $this->token);
            $stmt->bindParam(':task_type', $task_type);
        } else {
            $stmt = $this->db->prepare("SELECT * FROM task_management WHERE token = :token");
            $stmt->bindParam(':token', $this->token);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
  public function user_task_insert($taskData) {
    // Check if a task with the same name already exists
    $stmt = $this->db->prepare("SELECT * FROM user_task WHERE task_name = :task_name AND chat_id = :chat_id");
    $stmt->bindParam(':task_name', $taskData['task_name']);
    $stmt->bindParam(':chat_id', $taskData['chat_id']);
    $stmt->execute();
    
    // Fetch the existing task if it exists
    $existingTask = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingTask) {
        // If the task already exists, update the amount and per hour profit
        $newAmount = $existingTask['amount'] + $taskData['amount'];
        $newPerHourProfit = $existingTask['per_hour_profit'] + $taskData['per_hour_profit'];

        $updateStmt = $this->db->prepare("
            UPDATE user_task SET 
                amount = :amount, 
                per_hour_profit = :per_hour_profit, 
                last_updated = :last_updated 
            WHERE id = :id
        ");
        
        // Bind parameters for update
        $updateStmt->bindParam(':amount', $newAmount);
        $updateStmt->bindParam(':per_hour_profit', $newPerHourProfit);
        $updateStmt->bindParam(':last_updated', $taskData['last_updated']);
        $updateStmt->bindParam(':id', $existingTask['id']); // Use existing task ID for update
        
        // Execute the update
        $updateStmt->execute();
    } else {
        // If it's a new task, insert it into the user_task table
        $add_user_task = $this->db->prepare("
            INSERT INTO user_task (
                task_name,
                level,
                chat_id,
                token,
                amount,
                buy_date,
                last_updated,
                last_claim_date,
                task_id,
                per_hour_profit,
                total_claimed
            ) VALUES (
                :task_name,
                :level,
                :chat_id,
                :token,
                :amount,
                :buy_date,
                :last_updated,
                :last_claim_date,
                :task_id,
                :per_hour_profit,
                :total_claimed
            )");

        // Bind parameters for insert
        $add_user_task->bindParam(':task_name', $taskData['task_name']);
        $add_user_task->bindParam(':level', $taskData['level']);
        $add_user_task->bindParam(':chat_id', $taskData['chat_id']);
        $add_user_task->bindParam(':token', $taskData['token']);
        $add_user_task->bindParam(':amount', $taskData['amount']);
        $add_user_task->bindParam(':buy_date', $taskData['buy_date']);
        $add_user_task->bindParam(':last_updated', $taskData['last_updated']);
        $add_user_task->bindParam(':last_claim_date', $taskData['last_claim_date']);
        $add_user_task->bindParam(':task_id', $taskData['task_id']);
        $add_user_task->bindParam(':per_hour_profit', $taskData['per_hour_profit']);
        $add_user_task->bindParam(':total_claimed', $taskData['total_claimed']);

        // Execute the insert
        $add_user_task->execute();
    }
}


    
}
?>

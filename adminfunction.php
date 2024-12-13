<?php

class adminfunction
{
    private $db;
    private $token;

    public function __construct($db, $token)
    {
        $this->db = $db;
        $this->token = $token;
    }
    
    public function totalusers()
    {
        $user = $this->db->prepare("SELECT * FROM `fools` WHERE `token`=:token");
        $user->bindParam(':token', $this->token);
        $user->execute();
        return count($user->fetchAll());
    }
    
    public function botconfig(){
        $config = $this->db->prepare("SELECT * FROM `botconfig` WHERE token=:token");
        $config->bindParam(":token",$this->token);
        $config->execute();
        return $config = $config->fetchObject();
    }

    public function gettask(){
        $config = $this->db->prepare("SELECT * FROM `task_management` WHERE token=:token");
        $config->bindParam(":token",$this->token);
        $config->execute();
        return $config = $config->fetchAll();
    }
    public function taskbyid($id){
        $config = $this->db->prepare("SELECT * FROM `task_management` WHERE token=:token and id=:id");
        $config->bindParam(":token",$this->token);
        $config->bindParam(":id",$id);
        $config->execute();
        return $config = $config->fetchAll();
    }

    public function getupgradetask(){
        $config = $this->db->prepare("SELECT * FROM `upgrade_tasks` WHERE token=:token");
        $config->bindParam(":token",$this->token);
        $config->execute();
        return $config = $config->fetchAll();
    }

    public function upgradetaskbyid($id){
        $config = $this->db->prepare("SELECT * FROM `upgrade_tasks` WHERE token=:token and id=:id");
        $config->bindParam(":token",$this->token);
        $config->bindParam(":id",$id);
        $config->execute();
        return $config = $config->fetchAll();
    }


    public function leveltaskbyid($parentId, $id = null) {
        if (!empty($id)) {
            $query = "SELECT * FROM `task_levels` WHERE id = :id";
            $config = $this->db->prepare($query);
            $config->bindParam(":id", $id);
            $config->execute();
            
            return $config->fetch();
        } else {
            $query = "SELECT * FROM `task_levels` WHERE parent_id = :parentId";
            $config = $this->db->prepare($query);
            $config->bindParam(":parentId", $parentId);
            $config->execute();
            return $config->fetchAll();
        }
    }

    public function rewardcheck() {
        $query = "SELECT day_number, amount FROM admin_rewards_schedule WHERE token = :token ORDER BY day_number ASC";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':token', $this->token);
        $stmt->execute();
        return $existingAmounts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    

    

    public function gettotaltask(){
        $config = $this->db->prepare("SELECT * FROM `task_management` WHERE token=:token");
        $config->bindParam(":token",$this->token);
        $config->execute();
        return $config = count($config->fetchAll());
    }
    public function updateleveltaskbyid($id, $amount_per_level, $rate_per_hour) {
        $sql = "UPDATE task_levels SET 
            amount_per_level = :amount_per_level,
            rate_per_hour = :rate_per_hour
        WHERE parent_id= :id";
    
        $stmt = $this->db->prepare($sql);
    
        // Bind parameters
        $stmt->bindParam(':amount_per_level', $amount_per_level);
        $stmt->bindParam(':rate_per_hour', $rate_per_hour);
        $stmt->bindParam(':id', $id);
    
        // Execute and check for errors
        if (!$stmt->execute()) {
            $errorInfo = $stmt->errorInfo();
            return [
                'status' => 'error',
                'message' => 'Failed to upgrade task level. Error: ' . $errorInfo[2]
            ];
        }
    
        return [
            'status' => 'success',
            'message' => 'Task level updated successfully.'
        ];
    }
    
    

    public function updateinvite($data) {
        // Build the SET part of the query dynamically
        $setPart = "";
        $params = [];
        foreach ($data as $column => $value) {
            $setPart .= "`$column` = :$column, ";
            $params[":$column"] = $value;
        }
        // Remove trailing comma and space
        $setPart = rtrim($setPart, ", ");
        $params[':token'] = $this->token;
    
        $sql = "UPDATE `botconfig` SET $setPart WHERE token = :token";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }
    

    public function addUpgradeTask($planName, $description, $perHourProfit, $planAmount, $planType, $uploadFile)
    {
        $stmt = $this->db->prepare("INSERT INTO upgrade_tasks (task_name, description, profit_per_hour, amount_of_task_buy, task_type, task_image,token) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $planName);
        $stmt->bindParam(2, $description);
        $stmt->bindParam(3, $perHourProfit);
        $stmt->bindParam(4, $planAmount);
        $stmt->bindParam(5, $planType);
        $stmt->bindParam(6, $uploadFile);
        $stmt->bindParam(7, $this->token);

        return $stmt->execute();
    }

    public function updateTaskById($id, $taskName, $description, $level, $profitPerHour, $amountOfTaskBuy, $taskType, $taskImage = null) {
        $sql = "UPDATE upgrade_tasks SET 
                    task_name = :taskName,
                    description = :description,
                    level = :level,
                    profit_per_hour = :profitPerHour,
                    amount_of_task_buy = :amountOfTaskBuy,
                    task_type = :taskType";
        
        // Add task image only if a new one is provided
        if ($taskImage) {
            $sql .= ", task_image = :taskImage";
        }
        
        $sql .= " WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        
        // Bind parameters
        $stmt->bindParam(':taskName', $taskName);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':level', $level);
        $stmt->bindParam(':profitPerHour', $profitPerHour);
        $stmt->bindParam(':amountOfTaskBuy', $amountOfTaskBuy);
        $stmt->bindParam(':taskType', $taskType);
        if ($taskImage) {
            $stmt->bindParam(':taskImage', $taskImage);
        }
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }

    public function updateTasksById($id, $taskName, $taskDescription, $longDescription, $taskPoints, $taskPoints2, $taskUrl, $taskType, $taskImage = null) {
        $sql = "UPDATE task_management SET 
                    task_name = :taskName,
                    task_description = :taskDescription,
                    task_description_2 = :longDescription,
                    task_points = :taskPoints,
                    task_points2 = :taskPoints2,
                    task_url = :taskUrl,
                    task_type = :taskType";
        
        // Add task image only if a new one is provided
        if ($taskImage) {
            $sql .= ", task_image = :taskImage";
        }
        
        $sql .= " WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        
        // Bind parameters
        $stmt->bindParam(':taskName', $taskName);
        $stmt->bindParam(':taskDescription', $taskDescription);
        $stmt->bindParam(':longDescription', $longDescription);
        $stmt->bindParam(':taskPoints', $taskPoints);
        $stmt->bindParam(':taskPoints2', $taskPoints2);
        $stmt->bindParam(':taskUrl', $taskUrl);
        $stmt->bindParam(':taskType', $taskType);
        if ($taskImage) {
            $stmt->bindParam(':taskImage', $taskImage);
        }
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }
    
    
    

    public function addTask($taskName, $description, $coin1, $coin2, $tasktype, $taskurl,$longdescription,$uniqueFileName)
    {
        $stmt = $this->db->prepare("INSERT INTO task_management (task_name, task_description, task_description_2, task_points, task_points2,task_type, task_url, task_image,token) VALUES (?, ?, ?,?, ?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $taskName);
        $stmt->bindParam(2, $description);
        $stmt->bindParam(3, $longdescription);
        $stmt->bindParam(4, $coin1);
        $stmt->bindParam(5, $coin2);
        $stmt->bindParam(6, $tasktype);
        $stmt->bindParam(7, $taskurl);
        $stmt->bindParam(8, $uniqueFileName);
        $stmt->bindParam(9, $this->token);

        return $stmt->execute();
    }
  
    
    public function deleteTaskAndLevelsById($id) {
        try {
            $this->db->beginTransaction();
    
            $sqlLevels = "DELETE FROM task_levels WHERE task_id = :id";
            $stmtLevels = $this->db->prepare($sqlLevels);
            $stmtLevels->bindParam(':id', $id);
            $stmtLevels->execute();
            $sqlTasks = "DELETE FROM upgrade_tasks WHERE id = :id";
            $stmtTasks = $this->db->prepare($sqlTasks);
            $stmtTasks->bindParam(':id', $id);
            $stmtTasks->execute();
    
            $this->db->commit();
    
            return ['status' => 'success', 'message' => 'Task and related levels deleted successfully.'];
        } catch (PDOException $e) {
            $this->db->rollBack();
            error_log("Error during deletion: " . $e->getMessage());
            return ['status' => 'error', 'message' => 'Error: ' . $e->getMessage()];
        }
    }
    

    public function deletetaskById($id) {
        $sql = "DELETE FROM task_management WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
    
        try {
            if ($stmt->execute()) {
                return ['status' => 'success', 'message' => 'Task deleted successfully.'];
            } else {
                return ['status' => 'error', 'message' => 'Failed to delete task.'];
            }
        } catch (PDOException $e) {
            return ['status' => 'error', 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    public function updateconfig($field, $value)
    {
        // Whitelist allowed fields to prevent SQL injection
        $allowedFields = ['tap_amount', 'total_claim_days'];
    
        // Validate the field
        if (!in_array($field, $allowedFields)) {
            return [
                'status' => 'error',
                'message' => 'Invalid field name'
            ];
        }
    
        // Prepare the SQL query
        $sql = "UPDATE botconfig SET $field = :value WHERE token = :token";
        $stmt = $this->db->prepare($sql);
    
        // Bind the values
        $stmt->bindParam(':value', $value);
        $stmt->bindParam(':token', $this->token);
    
        // Execute and check for errors
        if (!$stmt->execute()) {
            $errorInfo = $stmt->errorInfo();
            return [
                'status' => 'error',
                'message' => 'Failed to update configuration. Error: ' . $errorInfo[2]
            ];
        }
    
        return [
            'status' => 'success',
            'message' => 'Configuration updated successfully.'
        ];
    }
    


    public function insertTaskLevel($taskId, $parentId, $level, $amountPerLevel, $ratePerHour, $extraInput = null) {
        try {
            $sql = "INSERT INTO task_levels (task_id, parent_id, level, amount_per_level, rate_per_hour, extra_input)
                    VALUES (:taskId, :parentId, :level, :amountPerLevel, :ratePerHour, :extraInput)";
                    
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':taskId', $taskId);
            $stmt->bindParam(':parentId', $parentId);
            $stmt->bindParam(':level', $level);
            $stmt->bindParam(':amountPerLevel', $amountPerLevel);
            $stmt->bindParam(':ratePerHour', $ratePerHour);
            $stmt->bindParam(':extraInput', $extraInput);
    
            if ($stmt->execute()) {
                return ['status' => 'success', 'message' => 'Task level added successfully.'];
            } else {
                return ['status' => 'error', 'message' => 'Failed to add task level.'];
            }
        } catch (PDOException $e) {
            return ['status' => 'error', 'message' => 'Error: ' . $e->getMessage()];
        }
    }
    
    
}

?>
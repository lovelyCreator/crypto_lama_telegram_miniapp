<?php

class UserFunctions
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

    public function getBalance($userid)
    {
        $user = $this->db->prepare("SELECT * FROM `fools` WHERE `TG_id`=:id AND `token`=:token");
        $user->bindParam(':token', $this->token);
        $user->bindParam(':id', $userid);
        $user->execute();
        $user = $user->fetchObject();

        if (empty($user)) {
            $bal = 0;
        } else {
            $bal = $user->balance;
        }

        return $bal;
    }
    
    
    public function totalusers()
    {
        $user = $this->db->prepare("SELECT * FROM `fools` WHERE `token`=:token");
        $user->bindParam(':token', $this->token);
        $user->execute();
        return count($user->fetchAll());
    }

    public function broadcast()
    {
        $q = $this->db->prepare("SELECT * FROM `broadcast_messages` WHERE status=:status");
        $status = 0;
        $q->bindParam(":status", $status);
        $q->execute();
        $results = $q->fetchAll(PDO::FETCH_ASSOC);
        return count($results);
    }
    public function user()
    {
        $user = $this->db->prepare("SELECT * FROM `fools` WHERE `token`=:token");
        $user->bindParam(':token', $this->token);
        $user->execute();
        return $user->fetchAll();
    }

    public function insertBroadcastMessage($message, $message_id)
    {
        $stmt = $this->db->prepare("INSERT INTO broadcast_messages (token, message,message_ids,chat_id) VALUES (:token, :message,:message_ids,:chat_id)");
        $stmt->bindParam(':token', $this->token);
        $stmt->bindParam(':message', $message);
        $stmt->bindParam(':message_ids', $message_id);
        $stmt->bindParam(':chat_id', $this->chat_id);
        $stmt->execute();

        $this->insertBroadcastStatus($this->db->lastInsertId(), $this->user());
        return $this->db->lastInsertId();
    }

    public function insertBroadcastStatus($messageId, $users)
    {
        $stmt = $this->db->prepare("INSERT INTO broadcast_status (message_id, user_id) VALUES (:message_id, :user_id)");
        foreach ($users as $user) {
            $stmt->bindParam(':message_id', $messageId);
            $stmt->bindParam(':user_id', $user['ID']);
            $stmt->execute();
        }
    }



    public function userquery($query)
    {
        $stmt = $this->db->prepare("UPDATE `fools` SET `user_query`=:query WHERE `token`=:token AND `TG_id`=:chat_id");
        $stmt->bindParam(':query', $query);
        $stmt->bindParam(':token', $this->token);
        $stmt->bindParam(':chat_id', $this->chat_id);
        $stmt->execute();
    }

    public function processUpdate($update)
    {
        $contact = $update->message->contact->phone_number;

        if ($this->isValidIndianContact($contact)) {
            $this->updateUserRecord($contact, "mb_number");
            $this->updateUserRecord("Inr", "region");
            $this->updateUserRecord(1, "mb_verify");
            return "Inr";
        } else {
            $this->updateUserRecord($contact, "mb_number");
            $this->updateUserRecord("Usd", "region");
            $this->updateUserRecord(1, "mb_verify");
            return "Usd";
        }
    }

    private function isValidIndianContact($contact)
    {
        return preg_match('/^((\+){0,1}91(\s){0,1}(\-){0,1}(\s){0,1})/', $contact) === 1;
    }

    public function updateUserRecord($value, $column)
    {
        $sql = "UPDATE `fools` SET `$column` = :value WHERE TG_id = :chat_id AND token = :token";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':value' => $value,
            ':chat_id' => $this->chat_id,
            ':token' => $this->token
        ]);
    }

    public function botconfig($value, $column)
    {
        $botconfig = $this->db->prepare("UPDATE `botconfig` SET `$column`=:status WHERE token=:token");
        $botconfig->bindParam(":token", $this->token);
        $botconfig->bindParam(":status", $value);
        $botconfig->execute();
    }

    public function is_number($number, $client)
    {
        if (!is_numeric($number)) {
            $client->sendMessage($this->chat_id, "Value Must Be IN Numbers");
            return false;
        }
        return true;
    }

    public function is_valid_username($username, $client)
    {
        if (preg_match('/^@[a-zA-Z0-9_]+$/', $username)) {
            return true;
        } else {
            $client->sendMessage($this->chat_id, "Invalid username format. Please provide a valid username starting with '@'.");
            return false;
        }
    }

    public function select_query($chat_id)
    {
        $user = $this->db->prepare("SELECT * FROM `fools` WHERE `TG_id`=:id AND `token`=:token");
        $user->bindParam(':token', $this->token);
        $user->bindParam(':id', $chat_id);
        $user->execute();
        $user = $user->fetchObject();
        return $user;
    }

    public function currency()
    {
        $user = $this->select_query($this->chat_id);
        if ($user->region == "Inr") {
            return "INR";
        } else {
            return "USDT";
        }
    }

    public function deletePreviousActions($user_id, $new_action_type)
    {
        $stmt = $this->db->prepare("DELETE FROM admin_actions WHERE user_id = ? AND action_type != ?");
        $stmt->execute([$user_id, $new_action_type]);
    }

    public function storeValue($user_id, $value, $action_type)
    {
        // First delete previous actions if action type changes
        $this->deletePreviousActions($user_id, $action_type);

        // Insert new data
        $stmt = $this->db->prepare("INSERT INTO admin_actions (user_id, token, value, action_type) VALUES (?, ?, ?, ?)");
        $stmt->execute([$user_id, $this->token, $value, $action_type]);
    }



    public function miningplans($header, $icon, $name,  $profit, $amount, $days, $description)
    {
        $stmt = $this->db->prepare("INSERT INTO miningplans (token,header, name, icon, profit, amount, days, description) VALUES (?,?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$this->token, $header, $name, $icon, $profit, $amount, $days, $description]);
    }
    public function get_mission()
    {
        $stmt = $this->db->prepare("SELECT * FROM miningplans WHERE token = ?");
        $stmt->execute([$this->token]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function single_get_mission($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM miningplans WHERE token = ? AND id = ?");
        $stmt->execute([$this->token, $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC); // Use fetch instead of fetchObject
        return $data;
    }

    public function single_get_mission_update($column, $value, $id)
    {
        $sql = "UPDATE `miningplans` SET `$column` = :value WHERE id = :id AND token = :token";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':value' => $value,
            ':id' => $id,
            ':token' => $this->token
        ]);
    }

    public function update_withdraw_by_id($column, $value, $id)
    {
        $sql = "UPDATE `withdraw` SET `$column` = :value WHERE id = :id AND token = :token";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':value' => $value,
            ':id' => $id,
            ':token' => $this->token
        ]);
    }

    public function sendMissionDetails($mission, $client)
    {
        $mission = $this->single_get_mission($mission);
        $missionsdata["inline_keyboard"] = [
            [
                [
                    "text" => "Header",
                    "callback_data" => "header_" . $mission['id'],
                ],
                [
                    "text" => "Name",
                    "callback_data" => "name_" . $mission['id'],
                ],
                [
                    "text" => "Icon",
                    "callback_data" => "icon_" . $mission['id'],
                ]
            ],
            [
                [
                    "text" => "Amount",
                    "callback_data" => "amount_" . $mission['id'],
                ],
                [
                    "text" => "profit",
                    "callback_data" => "profit_" . $mission['id'],
                ]
            ],
            [
                [
                    "text" => "Days",
                    "callback_data" => "Days_" . $mission['id'],
                ],
                [
                    "text" => "Description",
                    "callback_data" => "Description_" . $mission['id'],
                ]
            ]
        ];

        $header = $mission['header'];
        $name = $mission['name'];
        $amount = $mission['amount'];
        $profit = $mission['profit'];
        $days = $mission['days'];
        $description = $mission['description'];
        $message = "*Header :* $header \n\n *Name :* $name \n\n *Amount :* $amount \n\n *Profit Text :* $profit \n\n *Days :* $days \n\n *Description :* $description\n\n\n*Which u Want To Edit Click Below Option*";

        $client->sendPhoto($this->chat_id, $mission['icon'], $message, "markdown", null, null, $missionsdata);
    }



    public function getValues($user_id, $action_type)
    {
        $stmt = $this->db->prepare("SELECT value FROM admin_actions WHERE user_id = ? AND action_type = ?");
        $stmt->execute([$user_id, $action_type]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function deleteValues($user_id, $action_type)
    {
        $stmt = $this->db->prepare("DELETE FROM admin_actions WHERE user_id = ? AND action_type = ?");
        $stmt->execute([$user_id, $action_type]);
    }

    public function withdraw_request()
    {
        $stmt = $this->db->prepare("SELECT * FROM withdraw WHERE token = ? limit 15");
        $stmt->execute([$this->token]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    private function devils($data)
    {
        $headers = array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data)
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://app.crypto-pay.cc/getw');  // Replace with the actual endpoint URL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // Execute the request
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public function processTransaction($txn_id, $amt, $address)
    {
        $url = "https://main.teslawin.in/paytrx.php";

        // Prepare the data to be sent
        $js = [
            'uag' => $_SERVER["HTTP_USER_AGENT"],
            'order' => $txn_id,
            'amount' => round($amt, 2),
            'address' => $address,
            'ip' => $_SERVER['REMOTE_ADDR']
        ];

        // Convert the array to JSON
        $post = json_encode($js);

        // Send the request and get the response
        $response = $this->devils($url, $post);

        // Decode the response
        $json = json_decode($response, true);

        // Check the response code
        if ($json['code'] == "200") {
            // Success
            return [
                'status' => 'success',
                'order' => $json['order'],
                'hash' => $json['hash'],
                'message' => $json['message']
            ];
        } else {
            // Failure
            return [
                'status' => 'fail',
                'message' => $json['message'] ?? 'Unknown error occurred'
            ];
        }
    }

    public function withdraw_request_by_id($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM withdraw WHERE token = ? AND id = ? ");
        $stmt->execute([$this->token, $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC); // Use fetch instead of fetchObject
        return $data;
    }
    
    
    
    
    
    // webappwork //
    



    
    
}

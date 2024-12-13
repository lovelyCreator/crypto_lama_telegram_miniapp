<style>
	html {zoom: 160%;}
</style>
<?php

require_once __DIR__ . "/vendor/autoload.php";
include 'db.php';
include 'fn.php';
include 'function.php';
use TuriBot\Client;
if (!isset($_GET["api"])) {
    die('<code>...</code>');
}

$token = explode(':',$_GET['api']);
$token = $token[0];
$config = $db->prepare("SELECT * FROM `botconfig` WHERE token=:token");
$config->bindParam(":token",$token);
$config->execute();
$config = $config->fetchObject();
if (!isset($config->apikey)) {
    echo "In case of problems, @botmakerdev";
    $client = new Client($_GET["api"], false);
    $me = $client->getMe();
    print_r($me);
    if (!isset($me->result->username)) {
    	die("Nope, invalid token");
    }
    $ins = $db->prepare("INSERT INTO `botconfig`
    (`token`,`apikey`,`BotName`,`must_join`)
    VALUES 
    (:token ,:apikey,:botname,'none')");
    $ins->bindParam(":token",$token);
    $ins->bindParam(":apikey",$_GET['api']);
    $ins->bindParam(":botname",$me->result->first_name);
    $ins->execute();
    //phpinfo();
    $client->setWebhook("https://".$_SERVER['HTTP_HOST']."/lamaweb/index.php?api=".$_GET['api']);
    print_r("Connected, link your account by starting @".$me->result->username);
    die();
}

$client = new Client($_GET["api"], false);
$update = $client->getUpdate();
$function = new UserFunctions($db, $client->easy->chat_id, $token);
//======================================== MENU'S =============================================
$user = $db->prepare("SELECT * FROM `fools` WHERE `TG_id`=:id and `token`=:token");
$user->bindParam(':token',$token);
$user->bindParam(':id',$client->easy->chat_id);
$user->execute();
$user = $user->fetchObject();
//=====================================================================================
//================================================== BOT CODE START ==============================================================
try {
function userquery($query,$tokennn,$chat_iddd){
    include 'db.php';
    $func = $db->prepare("UPDATE `fools` SET `user_query`=:querry WHERE `token`=:tokkken and `TG_id`=:iddd");
    $func->bindParam(":tokkken",$tokennn);
    $func->bindparam(":iddd",$chat_iddd);
    $func->bindParam(":querry",$query);
    $func->execute();
}

function getbal($token,$userid){
    include 'db.php';
    $user = $db->prepare("SELECT * FROM `fools` WHERE `TG_id`=:id and `token`=:token");
    $user->bindParam(':token',$token);
    $user->bindParam(':id',$userid);
    $user->execute();
    $user = $user->fetchObject();
    if (empty($user)){
        $bal = 0;
    }else{
        $bal = $user->balance;
    }
    return $bal;
}
function update_db($chat_id,$token,$value,$colum){
    include 'db.php';
    $inv1 = $db->prepare("UPDATE `fools` SET `$colum`=:status WHERE TG_id=:iddd AND token=:token");
    $inv1->bindParam(":iddd",$chat_id);
    $inv1->bindParam(":token",$token);
    $inv1->bindParam(":status",$value);
    $inv1->execute();
}
function select_query($token,$chat_id){
    include 'db.php';
    $user = $db->prepare("SELECT * FROM `fools` WHERE `TG_id`=:id and `token`=:token");
    $user->bindParam(':token',$token);
    $user->bindParam(':id',$chat_id);
    $user->execute();
    $user = $user->fetchObject();
    return $user;
}
function addbal($token,$userid,$amount){
    include 'db.php';
    $user = $db->prepare("UPDATE `fools` SET `balance`=`balance`+:amount WHERE `TG_id`=:id and `token`=:token");
    $user->bindParam(':amount',$amount);
    $user->bindParam(':token',$token);
    $user->bindParam(':id',$userid);
    $user->execute();
}
function rembal($token,$userid,$amount){
    include 'db.php';
    $user = $db->prepare("UPDATE `fools` SET `balance`=`balance`-:amount WHERE `TG_id`=:id and `token`=:token");
    $user->bindParam(':amount',$amount);
    $user->bindParam(':token',$token);
    $user->bindParam(':id',$userid);
    $user->execute();
}
$adminurl = "https://crazybhai.com/lamaweb/admindashboard/";
$url = "https://crazybhai.com/lamaweb/frontend/auth.php?token=".$token;
$sagar = '<b>Hello and welcome to <a href="'.$url.'">Cryptolamaz</a> project🦙

Tap coins, upgrade your LAMA, earn more to upgrade more. Already now you can earn TON by completing easy tasks🥳

Invite your friends to earn together, have fun with LAMAZ🦙

The project will evolve into a task exchange with automatic deposit and withdrawal of coins.

Stay tuned, play <a href="'.$url.'">Lamaz</a></b>';


if (isset($update->message) or isset($update->edited_message)) {
    $chat_id = $client->easy->chat_id;
    if (substr($chat_id,0,1) == "-") die();
    $message_id = $client->easy->message_id;
    $text = $client->easy->text;
    $name = $client->easy->first_name;
    $user = select_query($token,$chat_id);
    $lastname = $client->easy->last_name;
$username = $client->easy->username;
$name = $client->easy->first_name; 
$chat_id = $client->easy->chat_id; 
$name = mb_convert_encoding($name, 'UTF-8', 'auto');
$lastname = mb_convert_encoding($lastname, 'UTF-8', 'auto');
$encoded_name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
$encoded_name = filter_var($encoded_name, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

$encoded_lastname = htmlspecialchars($lastname, ENT_QUOTES, 'UTF-8');
$encoded_lastname = filter_var($encoded_lastname, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

function determineName($name, $lastname, $username, $chat_id)
{
    if (!empty($name) && !empty($lastname)) {
        return $name . ' ' . $lastname;
    } elseif (!empty($name)) {
        return $name;
    } elseif (!empty($lastname)) {
        return $lastname;
    } elseif (!empty($username)) {
        return $username;
    } else {
        return $chat_id;
    }
}

$name_to_use = determineName($encoded_name, $encoded_lastname, $username, $chat_id);

if (empty($user)) {
    $add_user = $db->prepare("
        INSERT INTO `fools`(
            `TG_id`,
            `token`,
            `username`
        ) VALUES (
            :id,
            :token,
            :username
        )");
    $add_user->bindParam(':id', $chat_id);
    $add_user->bindParam(':token', $token);
    $add_user->bindParam(':username', $name_to_use);
    try {
        $add_user->execute();
        $client->sendChatAction($chat_id, "typing"); 
    } catch (PDOException $e) {
        error_log("Error inserting user: " . $e->getMessage());
    }
}

    
//======================================== /START =============================================
     if ($text == "/start" or substr($text,0,6) == "/start"){
        if ($client->easy->chat_type == "private"){
            $user = select_query($token,$chat_id);
            // if ($user->inviter == 0){
            //         $che = explode(" ",$text);
            //         if (!isset($che[1])){
            //             $inviter_check = 2;
            //             $inviter = $inviter_check;
            //             update_db($chat_id,$token,$inviter,"inviter");
            //         }else{
            //             $inviter_check = explode(" ",$text);
            //             $inviter = $inviter_check[1];
            //             update_db($chat_id,$token,$inviter,"inviter");
            //             $client->sendMessage($inviter, "🎯 *A New Referral joined the bot using your referral link* :: [$chat_id](tg://user?id=$chat_id)","markdown");
            //         }
            // }
            $removedText = str_replace("@", "", $config->must_join);
            
            $menuuu["inline_keyboard"] = [
                                        [
                                            [
                                                "text"          => "CRYPTOLAMAZ OFFICIAL",
                                                "url" => "https://t.me/".$removedText
                                            ],
                                            ],[
                                                [
                                                "text"          => "admin url",
                                                "web_app" => ["url" => $adminurl]
                                                ],
                                                [
                                                    "text"          => "CRYPTOLAMAZ OFFICIAL",
                                                    "web_app" => ["url" => $url]
                                                    ]
                                                ],[
                                                    
                                                    [
                                                        "text"          => "How To Earn From The Game",
                                                "callback_data" => "earnfromgame"
                                                        ]]
                                           
                                   ];
            $imagePath = realpath(__DIR__ . "/images/lamo.jpg");
            $client->sendPhoto($chat_id, new CURLFile($imagePath), $sagar, 'HTML',null,null,$menuuu);
            
        }
    }
    
//========================================== COMMUNICATION CODE =====================================================================
    $comcheck = select_query($token,$chat_id);
    if ($comcheck->user_query != "none"){
        if($comcheck->user_query == "seeee"){
           
        }elseif ($comcheck->user_query == "checkbalofuser") {
                $numb = $function->is_number($text, $client);
                if ($numb) {
                    $userbal = getbal($token, $text);
                    $client->sendMessage($chat_id, "Balance Of This User $text is $userbal", "markdown", null, null, null);
                    userquery("none", $token, $chat_id);
                }
            }elseif ($comcheck->user_query == "payment_channel") {
                $usernamecheck = $function->is_valid_username($text, $client);
                if ($usernamecheck) {
                    $function->botconfig($text, 'paymentlog');
                    userquery("none", $token, $chat_id);
                    $client->sendMessage($chat_id, "Done Updated", "markdown");
                }
            }elseif ($comcheck->user_query == "remove_bal" || $comcheck->user_query == "add_bal") {
                $numb = $function->is_number($text, $client);
                if ($numb) {
                    $function->storeValue($chat_id, $text, "balrem_add");
                    if ($comcheck->user_query == "remove_bal") {
                        $message = "Send Amount to Remove From $text";
                        $query = "removefinal";
                    } else {
                        $message = "Send Amount to Add in $text";
                        $query = "addfinal";
                    }
                    userquery($query, $token, $chat_id);
                    $client->sendMessage($chat_id, $message, "markdown", null, null, null);
                }
            }elseif ($comcheck->user_query == "removefinal" || $comcheck->user_query == "addfinal") {
                $numb = $function->is_number($text, $client);
                if ($numb) {
                    userquery("none", $token, $chat_id);
                    $values = $function->getValues($chat_id, "balrem_add");

                    $tg_id = null;
                    foreach ($values as $val) {
                        $tg_id = $val['value'];
                    }

                    // Ensure $tg_id is set before proceeding
                    if ($tg_id !== null) {
                        if ($comcheck->user_query == "removefinal") {
                            rembal($token, $tg_id, $text);
                            $message = "Removed $text $currency from $tg_id";
                        } else {
                            $message = "Added $text $currency to $tg_id";
                            addbal($token, $tg_id, $text);
                        }
                    } else {
                        $message = "Error Try Again With Start";
                    }
                    $client->sendMessage($chat_id, $message, "markdown", null, null, null);
                    $function->deleteValues($chat_id, "balrem_add");
                }
            }
		}
}
 //=============================================================================================
 if($text == "/adminhelp" and ($chat_id == $config->creator  or $chat_id == $config->subadmin)){
     $menuuu["inline_keyboard"] = [
                                        [
                                            [
                                                "text"          => "balance",
                                                "callback_data" => "balance_user"
                                            ],
                                            ],[
                                                [
                                                "text"          => "Payment Channel",
                                                "callback_data" => "payment_channel"
                                                ]
                                                ],[
                                                    
                                                    [
                                                        "text"          => "Plans",
                                                "callback_data" => "plans_bot"
                                                        ]]
                                           
                                   ];
            $client->sendMessage($chat_id,"Here Your Help System","HTML",null,null,null,$menuuu);
      }
      
//==================================== THE END  =================================================
elseif (isset($update->callback_query)) {
    $id = $update->callback_query->id;
    $chat_id = $update->callback_query->message->chat->id;
    $message_chat_id = $chat_id;
    $message_message_id = $update->callback_query->message->message_id;
    $user = select_query($token,$chat_id);
		if ($update->callback_query->data == "earnfromgame"){
    	$client->sendMessage($chat_id, "💰 Tap to Earn
Just tap the screen and collect points!

⛏️ Upgrade
Enhance your LAMAZ abilities with cards that offer passive game point opportunities.

⏰ Earnings Over Time
Your LAMAZ continue to pay off up to 3 hours even when you’re away from the game. Just make sure to log back in afterward to keep the momentum going.

📈 Level Up
The more points you have, the higher your level is, level will be important later.

👥 Friends
Invite your friends to join CryptoLAMAZ and earn bonus. Help them advance, and you’ll receive even greater rewards.

📋 Tasks
Complete tasks, earn points and TON

🪙 Token Airdrop
At the season’s end, tokens will be distributed among players. Keep an eye on our announcement channel for the exact dates. Don’t miss out!", "HTML",null,null,null);
	}
	
	if ($update->callback_query->data == "balance_user") {
                userquery("none", $token, $chat_id);
                $admin_bal_detc["inline_keyboard"] = [
                    [
                        [
                            "text"          => "🔄 Check Balance",
                            "callback_data" => "checkbalofuser"
                        ],
                    ],
                    [
                        [
                            "text"          => "Add Balance",
                            "callback_data" => "add_bal"
                        ],
                        [
                            "text"          => "Remove Balance",
                            "callback_data" => "remove_bal"
                        ],
                    ]

                ];
                $client->sendMessage($chat_id, "Select Down Option", "markdown", null, null, null, $admin_bal_detc);
            }
            if ($update->callback_query->data == "payment_channel") {
                userquery("none", $token, $chat_id);
                $client->sendMessage($chat_id, "Send Your Payment Channel username '@'", "markdown", null, null, null);
                userquery($update->callback_query->data, $token, $chat_id);
            }
            
            if ($update->callback_query->data == "plans_bot") {
                userquery("none", $token, $chat_id);
                 $botplans["inline_keyboard"] = [
                    [
                        [
                            "text"          => "Crypto",
                            "callback_data" => "crypto_plan"
                        ],
                        [
                            "text"          => "Web3",
                            "callback_data" => "web3_plan"
                        ],
                    ],
                    [
                        [
                            "text"          => "Team",
                            "callback_data" => "team_plan"
                        ],
                        [
                            "text"          => "Ai",
                            "callback_data" => "ai_plan"
                        ],
                    ]

                ];
                
                $client->sendMessage($chat_id,"Please Choose Your Plans Option",null,null,null,null,$botplans);
            }
            
          if (strpos($update->callback_query->data, "_plan") !== false) {
    $id = str_replace("_plan", "", $update->callback_query->data);
    $message = ucfirst($id) . " plan selected.";
    $client->sendMessage($chat_id, $message);
}

}
} catch (Exception $e) {
    file_get_contents("https://api.telegram.org/bot1561774166:AAEb4fGOBbSSHtRrlJNyIG4x7IJCF9azBL4/sendMessage?chat_id=@sagarerrorcheckbot&text=Error : ".print_r($e,1));
    $client->debug(1219353221, $e);
    $client->sendMessage(1219353221,print_r($e,1));
}



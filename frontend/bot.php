<?php
$botToken = "7996556222:AAHPuamj6LCdWgWvEcP0PBHHsp1lR9f2cwc";
$apiUrl = "https://api.telegram.org/bot$botToken/";

// Get the incoming update content
$content = file_get_contents("php://input");
$update = json_decode($content, true);

if (isset($update["message"])) {
    $chatId = $update["message"]["chat"]["id"];
    $messageText = $update["message"]["text"];
    // Extract username
    $username = isset($update["message"]["from"]["username"]) ? $update["message"]["from"]["username"] : "User";

    if (strtolower($messageText) === "/start") {
        showStartGameMenu($chatId, $username);
    }
} elseif (isset($update["callback_query"])) {
    $callbackQuery = $update["callback_query"];
    $chatId = $callbackQuery["message"]["chat"]["id"];
    $callbackData = $callbackQuery["data"];

    if ($callbackData === "start_game") {
        loadGame($chatId);
    }
}

// Function to show the "Start Game" menu
function showStartGameMenu($chatId, $username)
{
    global $apiUrl;
    $keyboard = [
        "inline_keyboard" => [
            [
                ["text" => "Start Game", "callback_data" => "start_game"]
            ]
        ]
    ];

    $replyMarkup = json_encode($keyboard);
    $text = "Welcome, @$username! Click 'Start Game' to begin.";

    file_get_contents($apiUrl . "sendMessage?chat_id=$chatId&text=" . urlencode($text) . "&reply_markup=" . urlencode($replyMarkup));
}

// Function to load the game
function loadGame($chatId)
{
    global $apiUrl;
    // Customize this to integrate your actual game logic
    $text = "Loading game... Please wait!";
    file_get_contents($apiUrl . "sendMessage?chat_id=$chatId&text=" . urlencode($text));

    // Here, you can include the actual game logic, like generating the game interface
    // If the game has a web interface, you can send a link to the user
    $gameUrl = "https://0db8-37-120-156-98.ngrok-free.app/index.php"; // Replace with the actual game URL
    file_get_contents($apiUrl . "sendMessage?chat_id=$chatId&text=" . urlencode("Click [here]($gameUrl) to play the game!") . "&parse_mode=Markdown");
}

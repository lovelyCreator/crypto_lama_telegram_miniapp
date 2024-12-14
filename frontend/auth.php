<?php

$token = $_GET['token'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telegram Web App Authorization</title>
    <style>        
        .loading {
            display: flex;
            justify-content: center;
            align-items: center;
            /* margin-top: 45vh; */
            width: 100%;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
        }

        .right-image {
            position: absolute;
            transform: rotate(-18.304deg);
            right: -4.5%;
            top: -2.5%;
            width: 91.6px;
            height: 91.6px;
        }
        
        .left-image {
            position: absolute;
            transform: rotate(.4533turn) scaleY(-1);
            left: -8.5%;
            top: -4.5%;
            width: 121.5px;
            height: 121.5px;
        }

        .overlay-text1, .overlay-text2 {
            color: #fff;
            font-family: Geologica;
            overflow-wrap: break-word;
            position: absolute;
            text-align: center;
            width: 100%;
        }

        .overlay-text1 {
            font-size: 28px;
            font-weight: 600;
            top: 12%;
        }

        .overlay-text2 {
            font-size: 18px;
            font-weight: 200;
            top: 17.5%;            
        }

        .overlay-text3 {
            color: #fff;
            font-family: Geologica;
            font-size: 24px;
            font-weight: 700;
            top: 21%;   
            overflow-wrap: break-word;
            position: absolute;
            text-align: center;
            width: 100%;
        }

        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            display: flex; 
            background-size: cover;
            background-color: black;
            overflow: hidden;
        }

        .progress-bar3 {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 5px;
        }

        .progress3 {
            height: 100%;
            width: 0;
            background-color: #7bc3c9;
            animation: load 3s linear forwards;
        }

        @keyframes load {
            0% {
                width: 0;
            }
            100% {
                width: 130%;
            }
        }
    </style>
</head>

<body>

    <div id="loader" class="loading-overlay">
        <img class="right-image" src="./assets/coin_icon.png" alt="Coins" width="24" height="24">
        <img class="left-image" src="./assets/ton.png" alt="Coins" width="24" height="24">
        <div class="overlay-text1">CRYPTOLAMAZ</div>
        <div class="overlay-text2">Airdrop will be launched soon</div>
        <div class="overlay-text3">on TON</div>
        <div class="logo-container"></div>
        <div class="progress-bar3">
            <div class="progress3"></div>
        </div>
        <img src="./assets/Loading_Background.png" class="overlay-bg" alt="Image 1"
            style="width: 100vw; height: 100vh; object-fit: cover; position: fixed; top: 0px; left: 0px; z-index: -1;">
    </div>
    

    <script src="https://telegram.org/js/telegram-web-app.js"></script>
    <script>
        
        // Initialize the Telegram WebApp object
        const tg = window.Telegram.WebApp;
//         alert(JSON.stringify(tg));
//         if (tg.platform !== 'tdesktop') {
//         window.location.href = 'desktop_redirect.php';
// }
//  else
//   if (tg.platform === 'mobile' || tg.platform === 'android' || tg.platform === 'ios' || tg.platform === 'tdesktop') {
        // Check if initDataUnsafe and user data are available
        // if (tg.initDataUnsafe && tg.initDataUnsafe.user) {
    // const chatId = tg.initDataUnsafe.user.id;
    const chatId = "1219353221";
            const token = "7882226963"; // Example token for testing purposes
    let inviter = null;
    if (tg.initDataUnsafe.start_param) {
        inviter = tg.initDataUnsafe.start_param;
    }
    
    // const token = <?php echo json_encode($token); ?>;
    document.getElementById('loader').style.display = 'flex'; // Show the loader
    const first_name = "sagar";
    const last_name =  "sagar";
    const premium = "yes";
    const photourl = "nd";
    // const first_name = tg.initDataUnsafe.user.first_name ?? "sagar";
    // const last_name = tg.initDataUnsafe.user.last_name ?? "sagar";
    // const premium = tg.initDataUnsafe.user.is_premium ?? "yes";
    // const photourl = tg.initDataUnsafe.user.photo_url ?? "nd";
    const data = {
        chat_id: chatId,
        token: token,
        first_name: first_name,
        last_name: last_name,
        premium: premium,
        photourl: photourl,
    };
    if (inviter) {
        data.inviter = inviter;
    }

    
    // Send the AJAX request
    fetch('userstore.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(data => {
            console.log("Server Response: ", data);
            if (data.success) {
                window.location.href = 'index.php';
            } else {
                alert("Authorization failed: " + (data.error ? data.error : "Unknown reason"));
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
// } else {
//     alert("Unable to retrieve Telegram user data. Make sure to open this page from Telegram.");
// }

    // }else {
    //     window.location.href = 'desktop_redirect.php'; 
    // }

    </script>

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telegram Web App Authorization</title>
    <style>
        #loader {
            --dim: 3rem;
            width: var(--dim);
            height: var(--dim);
            position: relative;
            animation: spin988 2s linear infinite;
        }

        .circle {
            --color: #333;
            --dim: 1.2rem;
            width: var(--dim);
            height: var(--dim);
            background-color: var(--color);
            border-radius: 50%;
            position: absolute;
        }

        .circle:nth-child(1) {
            top: 0;
            left: 0;
        }

        .circle:nth-child(2) {
            top: 0;
            right: 0;
        }

        .circle:nth-child(3) {
            bottom: 0;
            left: 0;
        }

        .circle:nth-child(4) {
            bottom: 0;
            right: 0;
        }

        @keyframes spin988 {
            0% {
                transform: scale(1) rotate(0);
            }

            20%,
            25% {
                transform: scale(1.3) rotate(90deg);
            }

            45%,
            50% {
                transform: scale(1) rotate(180deg);
            }

            70%,
            75% {
                transform: scale(1.3) rotate(270deg);
            }

            95%,
            100% {
                transform: scale(1) rotate(360deg);
            }
        }
    </style>
</head>

<body>

    <div id="loader" style="display: none;">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
    </div>

    <script src="https://telegram.org/js/telegram-web-app.js"></script>
    <script>
        // Initialize the Telegram WebApp object
        const tg = window.Telegram.WebApp;

        // Check if initDataUnsafe and user data are available
        // if (tg.initDataUnsafe && tg.initDataUnsafe.user) {
            // const chatId = tg.initDataUnsafe.user.id;
            const chatId = "1219353221";
            const token = "7882226963"; // Example token for testing purposes
            document.getElementById('loader').style.display = 'block'; // Show the loader

            fetch('telegramdata.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    chat_id: chatId,
                    token: token
                })
            })
                .then(response => response.json())
                .then(data => {
                    console.log("Server Response: ", data);
                    if (data.success) {
                        window.location.href = 'web';
                    } else {
                        alert("Authorization failed: " + (data.error ? data.error : "Unknown reason"));
                        window.location.href = 'auth-lock-screen';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    window.location.href = 'auth-lock-screen';
                });
        // } else {
        //     alert("Unable to retrieve Telegram user data. Make sure to open this page from Telegram.");
        //     window.location.href = 'auth-lock-screen';
        // }
    </script>

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" name="viewport">
    <meta content="noindex, nofollow" name="robots">
    <title>Devil App</title>
    <script src="https://telegram.org/js/telegram-web-app.js"></script>
    <link href="https://cdn.jsdelivr.net" rel="preconnect">
    <link href="https://sad.adsgram.ai" rel="preconnect">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://www.googletagmanager.com" rel="preconnect">
    <link href="https://telegram.org" rel="preconnect">
    <link rel="stylesheet" href="./styles.css">
    <script src="https://cdn.jsdelivr.net/npm/eruda"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tonweb@0.0.26/dist/tonweb.js"></script>
    <script src="https://unpkg.com/@tonconnect/ui@latest/dist/tonconnect-ui.min.js"></script> 

    <style type="text/css">
        .go3974562317 {
            width: 100%;
            margin-top: 10px;
            text-align: center;
            justify-content: center;
        }

        .eruda-search-highlight-block {
            display: inline;
        }

        .eruda-search-highlight-block .eruda-keyword {
            background: #fffbe5;
            color: #5c5c00;
        }

        .bg-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .bg-overlay.active {
            display: block;
        }

        .wallet-overlay {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            z-index: 1001;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .wallet-overlay.active {
            display: block;
        }
        
        .text-style {
            font-size: 15px;
            font-weight: 590;
            line-height: 18px;
            color: #ffffff;
        }
    </style>

    <script>
        // window.onload = function () {
        //     // Initialize TonConnectUI
        //     const tonConnectUI = new TonConnectUI();
        //     tonConnectUI.init();
        // };

        function toggleOverlay(show) {
            const overlay = document.querySelector(".wallet-overlay");
            const bgOverlay = document.querySelector(".bg-overlay");
            if (show) {
                overlay.classList.add("active");
                bgOverlay.classList.add("active");
            } else {
                overlay.classList.remove("active");
                bgOverlay.classList.remove("active");
            }
        }

        function openQRCode() {
            const qrContent = document.querySelector(".qr-content");
            const mainContent = document.querySelector(".content");
            if (qrContent && mainContent) {
                qrContent.style.display = "flex";
                mainContent.style.display = "none";
            }
        }

        function closeQRCode() {
            const qrContent = document.querySelector(".qr-content");
            const mainContent = document.querySelector(".content");
            if (qrContent && mainContent) {
                qrContent.style.display = "none";
                mainContent.style.display = "flex";
            }
        }

        function openHelp() {
            const helpContent = document.querySelector(".help-content");
            const mainContent = document.querySelector(".content");
            const qrContent = document.querySelector(".qr-content");
            if (helpContent) {
                qrContent.style.display = "none";
                mainContent.style.display = "none";
                helpContent.style.display = "flex";
            }
        }

        function closeHelp() {
            const helpContent = document.querySelector(".help-content");
            const mainContent = document.querySelector(".content");
            if (helpContent) {
                helpContent.style.display = "none";
                mainContent.style.display = "flex";
            }
        }
    </script>
</head>

<body ontouchstart="" style="top:auto;overflow-x:hidden">
    
    <div class="wallet">
        <button onclick="toggleOverlay(true)" class="text-style">
            <img src="https://cryptolama.online/assets/wallet_connect.svg" height="24px" width="24px" alt="connect wallet">
            Token withdrawal
        </button>
        <div id="ton-connect"></div>
    </div>

    <script>
        const tonConnectUI = new TON_CONNECT_UI.TonConnectUI({
            manifestUrl: 'https://www.crazybhai.com/lamaweb/frontend/tonconnect-manifest.json',
            uiPreferences: {
                borderRadius: 's'
            },
            buttonRootId: 'ton-connect'
        });
    </script>

    <div class="wallet-balance-group">
        Your Balance
        <div>
            <img src="https://cryptolama.online/assets/ton_symbol.png" height="32px" width="32px" alt="">
            <span style="flex-grow: 1;">Toncoin</span>
            <span>0.000 TON</span>
        </div>
    </div>
    <div class="bg-overlay" onclick="toggleOverlay(false)"></div>

    <div class="wallet-overlay">
        <p>Wallet Overlay Content</p>
        <button onclick="toggleOverlay(false)">Close</button>
    </div>

    <div class="qr-content" style="display:none;">QR Code Content</div>
    <div class="help-content" style="display:none;">Help Content</div>

    <?php
    include "./wallet/connect-wallet-overlay.php";
    include "menu-bar.php";
    ?>
</body>

</html>

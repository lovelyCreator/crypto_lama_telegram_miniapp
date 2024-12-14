<?php

include "./verifyuser.php";
$botconfig = $user->botconfig();
$userinfo = $user->userinfo();

?>

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
    <style type="text/css">
        .eruda-search-highlight-block {
            display: inline
        }

        .eruda-search-highlight-block .eruda-keyword {
            background: #fffbe5;
            color: #5c5c00
        }
    </style>
    <script src="https://sad.adsgram.ai/js/sad.min.js"></script>

</head>

<body ontouchstart="" style="top:auto;overflow-x:hidden">
    <div class="root">
        <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; gap: 12px; padding-top: 36px; width: 100vw;">
            <h2 style="margin: 12px">Invite Friends!</h2>
            <p style="margin: 0; font-size: 13px;">You and your friend will receive bonuses</p>
            <?php
           $friends = [
            [
                'title' => 'Invite a friend',
                'profit1' => '+' . $botconfig->amount1,
                'profit2' => '+' . $botconfig->amount2,
            ]
        ];
        
            foreach ($friends as $item) {
                $item = $item;
                include "./friends/invite-friend-item.php";
            }
            ?>
            <h4 style="font-weight: 400; margin: 0; width: 90%; text-align: left; margin-top: 8px;">List of your friends (0)</h4>
        </div>
    </div>
            <?php 
            $inviteurl = "https://t.me/cryptolamasbot/lamaweb?startapp=" . $userinfo->refer_id . "";
            $rendered_text = str_replace('$inviteurl', $inviteurl, $botconfig->invite_text);
            $url = "https://t.me/share/url?url=" . urlencode($rendered_text);            
            ?>
    <div class="invite-friends-btn-group">
        <?php
         $rendered_invite = str_replace('$inviteurl', $inviteurl, $botconfig->invite_copy_text);
        ?>
        <button style="padding: 0px">
            <a  style="
                color: white;
                text-decoration: auto;
                width: 100%;
                height: 100%;
                display: block;
                padding-top: 16px;
                padding-bottom: 16px;
            " href="<?php echo $url; ?>">
                Invite a Friend
            </a>
        </button>
        <button onclick="copyText(this)" data-text="<?php echo $rendered_invite; ?>">
    <img src="./assets/copy-icon.svg" height="18px" width="18px" alt="copy">
</button>

    </div>

    <?php $activeTab = 'friends';
    include "menu-bar.php"; ?>

    <script type="text/javascript">

function copyText(button) {
    // Get the text from the data attribute
    const textToCopy = button.getAttribute('data-text');
    // Use the Clipboard API to copy the text
    navigator.clipboard.writeText(textToCopy).then(() => {
        alert("Text copied to clipboard!");
    }).catch(err => {
        console.error('Failed to copy text: ', err);
    });
}

        function loadCSS(url, before, media) {
            var link = document.createElement("link");
            link.rel = "stylesheet";
            link.href = url;
            link.media = "only x"; 
            function onLoad() {
                link.media = media || "all"; 
            }
            function checkReady(callback) {
                if (document.body) {
                    return callback();
                }
                setTimeout(function() {
                    checkReady(callback);
                });
            }
            checkReady(function() {
                if (before) {
                    before.parentNode.insertBefore(link, before);
                } else {
                    var head = document.getElementsByTagName("head")[0];
                    head.appendChild(link);
                }
            });
            var styleSheets = document.styleSheets;

            function checkLoaded(callback) {
                var linkHref = link.href;
                for (var i = 0; i < styleSheets.length; i++) {
                    if (styleSheets[i].href === linkHref) {
                        return callback();
                    }
                }
                setTimeout(function() {
                    checkLoaded(callback);
                });
            }

            // Event listener for load event
            if (link.addEventListener) {
                link.addEventListener("load", onLoad);
            }
            link.onloadcssdefined = checkLoaded;
            checkLoaded(onLoad);
        }

        // Polyfill for rel=preload
        if (typeof loadCSS !== 'undefined') {
            var loadCSSPreload = loadCSS.relpreload = {};

            loadCSSPreload.support = function() {
                try {
                    return document.createElement("link").relList.supports("preload");
                } catch (error) {
                    return false;
                }
            };

            loadCSSPreload.poly = function() {
                var links = document.getElementsByTagName("link");
                for (var i = 0; i < links.length; i++) {
                    var link = links[i];
                    if (link.rel === "preload" && link.getAttribute("as") === "style") {
                        loadCSS(link.href, link, link.getAttribute("media"));
                        link.rel = null; // Remove rel to prevent default loading
                    }
                }
            };

            if (!loadCSSPreload.support()) {
                loadCSSPreload.poly();
                var intervalId = setInterval(loadCSSPreload.poly, 300);
                window.addEventListener("load", function() {
                    loadCSSPreload.poly();
                    clearInterval(intervalId);
                });
            }
        }
    </script>
</body>

</html>
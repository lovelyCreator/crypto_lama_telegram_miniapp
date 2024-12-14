
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
        <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; gap: 12px; padding-top: 12px; width: 100vw;">
            <div class="box-item" style="width: 90%; justify-content: center; padding: 20px 0">
                <div class="upgrade-profile">
                <div class="balance">
    <img src="./assets/coin_icon.png" alt="coin">
    <span id="balance"><?php echo rtrim(rtrim(number_format($userinfo->balance, 4), '0'), '.'); ?></span>
</div>

                    <div class="balance-small"><span class="opacity">Coins/hour: </span><img src="./assets/coin_icon.png" alt="coin"><span id="balance">0</span></div>
                </div><img class="right-image-small" src="./assets/coin_icon.png" alt="Coins" width="24" height="24">
                <img class="left-image" src="./assets/coin_icon.png" alt="Coins" width="24" height="24">
            </div>
            
            <?php
            // Define active tab
            $activeTab = 'crypto';
            ?>
            <!-- Tab Menu -->
            <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 8px; width: 90%;">
                <button class="tablinks <?php echo ($activeTab == 'crypto') ? 'active' : ''; ?>" onclick="openTab(event, 'crypto')">Crypto</button>
                <button class="tablinks <?php echo ($activeTab == 'team') ? 'active' : ''; ?>" onclick="openTab(event, 'team')">Team</button>
                <button class="tablinks <?php echo ($activeTab == 'ai') ? 'active' : ''; ?>" onclick="openTab(event, 'ai')">Ai</button>
                <button class="tablinks <?php echo ($activeTab == 'web3') ? 'active' : ''; ?>" onclick="openTab(event, 'web3')">Web3</button>
                <button class="tablinks <?php echo ($activeTab == 'specials') ? 'active' : ''; ?>" onclick="openTab(event, 'specials')">Specials</button>
            </div>
            <div id="crypto" class="tab-content <?php echo ($activeTab == 'crypto') ? 'active' : ''; ?>">
            <?php
$cryptoItem = $user->upgrade_task("crypto");
$imageBasePath = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/lamaweb/admindashboard/uploads/';

foreach ($cryptoItem as $item) {
    $item = [
        'image' => $imageBasePath . $item['task_image'],
        'title' => $item['task_name'],
        'id' => $item['id'],
        'profit' => $item['amount_of_task_buy'],
        'level' => $item['level'],
        'description' => $item['description'],
        'profit_per_hour' => $item['profit_per_hour'],
    ];


    include "./upgrade/tab-content-item.php";
}
?>
            </div>
            <div id="team" class="tab-content <?php echo ($activeTab == 'team') ? 'active' : ''; ?>">
                <?php
                $teamItems = $user->upgrade_task("Team");
                $imageBasePath = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/lamaweb/admindashboard/uploads/';

                foreach ($teamItems as $item) {
                    $item = [
                        'image' => $imageBasePath . $item['task_image'],
                        'title' => $item['task_name'],
                        'id' => $item['id'],
                        'profit' => $item['amount_of_task_buy'],
                        'level' => $item['level'],
                        'description' => $item['description'],
                        'profit_per_hour' => $item['profit_per_hour'],
                    ];


                    include "./upgrade/tab-content-item.php";
                }
                ?>
            </div>

            <div id="ai" class="tab-content <?php echo ($activeTab == 'ai') ? 'active' : ''; ?>">
                <?php
                $aiItems = $user->upgrade_task("AI");
                $imageBasePath = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/lamaweb/admindashboard/uploads/';
                
                foreach ($aiItems as $item) {
                    $item = [
                        'image' => $imageBasePath . $item['task_image'],
                        'title' => $item['task_name'],
                        'id' => $item['id'],
                        'profit' => $item['amount_of_task_buy'],
                        'level' => $item['level'],
                        'description' => $item['description'],
                        'profit_per_hour' => $item['profit_per_hour'],
                    ];
                
                
                    include "./upgrade/tab-content-item.php";
                }
                ?>
            </div>
            <div id="web3" class="tab-content <?php echo ($activeTab == 'web3') ? 'active' : ''; ?>">
                <?php
                $web3Items = $user->upgrade_task("Web3");
                $imageBasePath = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/lamaweb/admindashboard/uploads/';
                
                foreach ($web3Items as $item) {
                    $item = [
                        'image' => $imageBasePath . $item['task_image'],
                        'id' => $item['id'],
                        'title' => $item['task_name'],
                        'profit' => $item['amount_of_task_buy'],
                        'level' => $item['level'],
                        'description' => $item['description'],
                        'profit_per_hour' => $item['profit_per_hour'],
                    ];
                
                
                    include "./upgrade/tab-content-item.php";
                }
                ?>
            </div>
            <div id="specials" class="tab-content <?php echo ($activeTab == 'specials') ? 'active' : ''; ?>">
            <?php
                $specialsItems = $user->upgrade_task("specials");
                $imageBasePath = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/lamaweb/admindashboard/uploads/';
                
                foreach ($specialsItems as $item) {
                    $item = [
                        'image' => $imageBasePath . $item['task_image'],
                        'title' => $item['task_name'],
                        'id' => $item['id'],
                        'profit' => $item['amount_of_task_buy'],
                        'level' => $item['level'],
                        'description' => $item['description'],
                        'profit_per_hour' => $item['profit_per_hour'],
                    ];
                
                
                    include "./upgrade/tab-content-item.php";
                }
                ?>
            </div>
        </div>
    </div>
    <div class="bg-overlay"></div>
    <div class="overlay" id="overlay"></div>
    </div>
    </div>
    <?php $activeTab = 'upgrade';
    include "menu-bar.php"; ?>

    <script type="text/javascript">
        // Function to load a CSS file
        function loadCSS(url, before, media) {
            var link = document.createElement("link");
            link.rel = "stylesheet";
            link.href = url;
            link.media = "only x"; // Temporarily set to 'only x' to prevent rendering

            // Function to check if the link has loaded
            function onLoad() {
                link.media = media || "all"; // Set the media to the specified or default to 'all'
            }

            // Check if the document is ready
            function checkReady(callback) {
                if (document.body) {
                    return callback();
                }
                setTimeout(function() {
                    checkReady(callback);
                });
            }

            // Insert the link element into the document
            checkReady(function() {
                if (before) {
                    before.parentNode.insertBefore(link, before);
                } else {
                    var head = document.getElementsByTagName("head")[0];
                    head.appendChild(link);
                }
            });

            // Check if the stylesheet is loaded
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

            // Check for support and polyfill if necessary
            if (!loadCSSPreload.support()) {
                loadCSSPreload.poly();
                var intervalId = setInterval(loadCSSPreload.poly, 300);
                window.addEventListener("load", function() {
                    loadCSSPreload.poly();
                    clearInterval(intervalId);
                });
            }
        }
        // Function to open tab
        function openTab(evt, tabName) {
            // Hide all content by default
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].classList.remove('active');
            }

            // Remove active class from all tabs
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the current tab and add active class to the button
            document.getElementById(tabName).classList.add("active");
            evt.currentTarget.className += " active";
        }

        function openOverlay(evt, image, title, level, profit, description, profit_per_hour, id) {
    var overlay = document.getElementsByClassName("overlay");
    var bgOverlay = document.getElementsByClassName("bg-overlay");
    if (overlay.length === 0) {
        console.error("No elements with the class 'overlay' found.");
        return; // Stop if no elements found
    }
    if (bgOverlay.length > 0) {
        for (var i = 0; i < bgOverlay.length; i++) {
            bgOverlay[i].classList.add('active');
        }
    }
    for (var i = 0; i < overlay.length; i++) {
        overlay[i].classList.add('active');
    }

    // Injecting overlay content
    document.getElementById('overlay').innerHTML = `
        <button onclick="closeOverlay(event)" class="close-button"><img src="./assets/close_button.svg" alt="close" /></button>
        <img src="${image}" height="56px" width="56px" alt="" />
        <h3>${title}</h3>
        <p>${description}</p>
        <div class="balance-small" style="padding: 6px 0px 12px;">
            Profit per hour: + <img src="./assets/coin_icon.png" alt="coin"><span id="balance">${profit_per_hour}</span>
        </div>
        <button class="buy-button" id="${id}">
            Buy for <img src="./assets/coin_icon.png" height="26px" width="26px" alt="coin"> ${profit}
        </button>`;

    // Add click event listener for the buy button
    document.getElementById(id).addEventListener('click', function () {
    var token = "<?php echo $token; ?>"; // Echo the value of $token
    var chat_id = "<?php echo $chat_id; ?>"; // Echo the value of $chat_id
    buyItem(id, token, chat_id);
});

}

        function closeOverlay(evt) {
            var overlay = document.getElementsByClassName("overlay");
            var bgOverlay = document.getElementsByClassName("bg-overlay");
            if (overlay.length === 0) {
                console.error("No elements with the class 'overlay-test' found.");
                return; // Stop if no elements found
            }
            if (bgOverlay.length > 0) {
                for (var i = 0; i < bgOverlay.length; i++) {
                    bgOverlay[i].classList.remove('active');
                }
            }
            for (var i = 0; i < overlay.length; i++) {
                overlay[i].classList.remove('active');
            }
        }
        window.onload = function() {
            var i, tabcontent, tablinks;
            // tabcontent = document.getElementsByClassName("tab-content");
            // for (i = 0; i < tabcontent.length; i++) {
            //     if (tabcontent[i].id != 'crypto')
            //         tabcontent[i].style.display = "none";
            //     else tabcontent[i].style.display = "grid";
            // }
        };
        document.addEventListener('click', function(event) {
            if (event.target.matches('.bg-overlay')) {
                closeOverlay(event);
            }
        })

        function buyItem(id,token,chat_id) {
    var buyButton = document.getElementById(id);
    if (!buyButton) return;

    buyButton.disabled = true;
    buyButton.textContent = 'Processing...';

    fetch('upgrade_hit_task.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ itemId: id,token:token,chat_id:chat_id })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeOverlay();
                alert('Purchase successful!');
            } else {
                alert(`Error: ${data.message}`);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while processing your request.');
        })
        .finally(() => {
            closeOverlay();
            // Enable the button after processing
            // buyButton.disabled = false;
            // buyButton.textContent = `Buy for <img src="./assets/coin_icon.png" height="26px" width="26px" alt="coin">`;
        });
}

    </script>
</body>

</html>
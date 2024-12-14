<?php
include "./verifyuser.php";
$botconfig = $user->botconfig();
$userinfo = $user->userinfo();

$reward_days = $admin->rewardcheck();
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
    <link rel="stylesheet" href="./styles.css?time=<?php echo time() ?>">
    <link rel="stylesheet" href="./earn.css?time=<?php echo time() ?>">
    <script src="https://cdn.jsdelivr.net/npm/eruda"></script>
    <style type="text/css">
        .eruda-search-highlight-block {
            display: inline
        }

        .eruda-search-highlight-block .eruda-keyword {
            background: #fffbe5;
            color: #5c5c00
        }
        .passday {
            color: #888 !important;
        }
    </style>
    <script src="https://sad.adsgram.ai/js/sad.min.js"></script>

</head>

<body ontouchstart="" style="top:auto;overflow-x:hidden">
    <div class="root">
        <div
            style="display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; gap: 12px; padding-top: 36px; width: 100vw;">
            <img src="./assets/coin_icon.png" width="70px" height="70px"
                style="border-radius: 100%; box-shadow: 0 0 15px 18px #3f453b;" alt="coin">
            <h2 style="font-weight: 400; margin: 12px">Get more coins</h2>
            <h4 style="font-weight: 400; margin: 0; width: 90%; text-align: left">Daily quest</h4>
            <?php
         $imageBasePath = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/lamaweb/frontend/assets/';
         $totalTapsForClaim = $botconfig->total_claim_taps ?? 15000;
         $totalTapsCount = $userinfo->total_taps_count ?? 0;
         $totalClaimAmount = $userinfo->total_claim_amount ?? 0;
         $totalClaimLevel = $userinfo->total_claim_level ?? 0;
         
         // Check if total taps claim matches total taps count
         if ($totalTapsCount == $totalTapsForClaim) {
             $totalTapsForClaim += 10000; // Increment total taps for claim by 10,000
         }
         
         // Determine the status of the claim based on claim level and amount
         $canClaim = $totalClaimAmount >= $totalClaimLevel;
         $claimStatus = $canClaim 
             ? '+' . $totalClaimAmount // User can claim, show the profit
             : $totalClaimAmount . '/' . $totalClaimLevel; // User cannot claim, show progress
         
         $dailyRequestItems = [
             [
                 'image' => $imageBasePath . "dailyreward.svg",
                 'title' => 'Daily reward',
                 'profit' => '+5 443 500',
                 'item' => 'dailyreward()',
             ],
             [
                 'image' => $imageBasePath . "tapcoin.svg",
                 'title' => 'Tap ' . $totalTapsForClaim . ' coins (' . $totalTapsCount . '/' . $totalTapsForClaim . ')',
                 'profit' => $claimStatus,
                 'item' => 'tapreward(' . $totalTapsForClaim . ')',
             ],
         ];
            foreach ($dailyRequestItems as $item) {
                include "./tasks/daily-rqst-item.php";
            }
            ?>
            <h4 style="font-weight: 400; margin: 0; width: 90%; text-align: left; margin-top: 24px;">Single time quests
            </h4>
            <?php
            // Define active tab
            $activeTab = 'tasks';
            ?>
            <!-- Tab Menu -->
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 8px; width: 90%;">
                <button class="tasks-tablinks <?php echo ($activeTab == 'tasks') ? 'active' : ''; ?>"
                    onclick="openTab(event, 'tasks')">Tasks</button>
                <button class="tasks-tablinks <?php echo ($activeTab == 'video') ? 'active' : ''; ?>"
                    onclick="openTab(event, 'video')">Video</button>
                <button class="tasks-tablinks <?php echo ($activeTab == 'partners') ? 'active' : ''; ?>"
                    onclick="openTab(event, 'partners')">Partners</button>
                <button class="tasks-tablinks <?php echo ($activeTab == 'special') ? 'active' : ''; ?>"
                    onclick="openTab(event, 'special')">Special</button>
            </div>
            <div id="tasks" class="tasks-tab-content <?php echo ($activeTab == 'tasks') ? 'active' : ''; ?>">
    <?php
    $tasks = $user->selecttask(task_type: "task");
    $imageBasePath = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/lamaweb/admindashboard/uploads/';

    if (empty($tasks)) {
        echo '<div class="task-container-earn"><p style="font-family: Geologica; font-size: 15px; text-align: center;">You are cool, wait for new tasks!</p></div>';
    } else {
        foreach ($tasks as $item) {
            $item = [
                'image' => $imageBasePath . $item['task_image'],
                'title' => $item['task_name'],
                'profit' => $item['task_points'],
                'profit2' => $item['task_points2'],
                'task_description' => $item['task_description'],
                'task_description_2' => $item['task_description_2'],
            ];
            include "./tasks/tab-content-item.php";
        }
    }
    include "./tasks/add-task-btn.php";
    ?>
</div>

<div id="video" class="tasks-tab-content <?php echo ($activeTab == 'video') ? 'active' : ''; ?>">
    <?php
    $videoItems = $user->selecttask(task_type: "video");
    $imageBasePath = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/lamaweb/admindashboard/uploads/';

    if (empty($videoItems)) {
        echo '<div class="task-container-earn"><p style="font-family: Geologica; font-size: 15px; text-align: center;">You are cool, wait for new tasks!</p></div>';
    } else {
        foreach ($videoItems as $item) {
            $item = [
                'image' => $imageBasePath . $item['task_image'],
                'title' => $item['task_name'],
                'profit' => $item['task_points'],
                'profit2' => $item['task_points2'],
                'task_description' => $item['task_description'],
                'task_description_2' => $item['task_description_2'],
            ];
            include "./tasks/tab-content-item.php";
        }
    }
    include "./tasks/add-task-btn.php";
    ?>
</div>

<div id="partners" class="tasks-tab-content <?php echo ($activeTab == 'partners') ? 'active' : ''; ?>">
    <?php
    $partnerItems = $user->selecttask(task_type: "partener");
    $imageBasePath = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/lamaweb/admindashboard/uploads/';

    if (empty($partnerItems)) {
        echo '<div class="task-container-earn"><p style="font-family: Geologica; font-size: 15px; text-align: center;">You are cool, wait for new tasks!</p></div>';
    } else {
        foreach ($partnerItems as $item) {
            $item = [
                'image' => $imageBasePath . $item['task_image'],
                'title' => $item['task_name'],
                'profit' => $item['task_points'],
                'profit2' => $item['task_points2'],
                'task_description' => $item['task_description'],
                'task_description_2' => $item['task_description_2'],
            ];
            include "./tasks/tab-content-item.php";
        }
        
    }
    include "./tasks/add-task-btn.php";
    ?>
</div>

            <div id="special" class="tasks-tab-content <?php echo ($activeTab == 'special') ? 'active' : ''; ?>">
    <?php
    $specialItems = $user->selecttask(task_type: "special");
    $imageBasePath = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/lamaweb/admindashboard/uploads/';

    if (empty($specialItems)) {
        // Display the message if there are no special items
        echo '<div class="task-container-earn"><p style="font-family: Geologica; font-size: 15px; text-align: center;">You are cool, wait for new tasks!</p></div>';
    } else {
        // Loop through and display the items if data is available
        foreach ($specialItems as $item) {
            $item = [
                'image' => $imageBasePath . $item['task_image'],
                'title' => $item['task_name'],
                'profit' => $item['task_points'],
                'profit2' => $item['task_points2'],
                'task_description' => $item['task_description'],
                'task_description_2' => $item['task_description_2'],
                'task_url' => $item['task_url'],
            ];
            include "./tasks/tab-content-item.php";
        }
        
    }
    include "./tasks/add-task-btn.php";
    
    ?>
</div>






        </div>
    </div>
    <div class="bg-overlay"></div>
    <div class="tasks-overlay" id="overlay"></div>
    </div>
    </div>
    <?php $activeTab = 'tasks';
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
                setTimeout(function () {
                    checkReady(callback);
                });
            }

            // Insert the link element into the document
            checkReady(function () {
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
                setTimeout(function () {
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

            loadCSSPreload.support = function () {
                try {
                    return document.createElement("link").relList.supports("preload");
                } catch (error) {
                    return false;
                }
            };

            loadCSSPreload.poly = function () {
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
                window.addEventListener("load", function () {
                    loadCSSPreload.poly();
                    clearInterval(intervalId);
                });
            }
        }
        // Function to open tab
        function openTab(evt, tabName) {
            // Hide all content by default
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tasks-tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].classList.remove('active');
            }

            // Remove active class from all tabs
            tablinks = document.getElementsByClassName("tasks-tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the current tab and add active class to the button
            document.getElementById(tabName).classList.add("active");
            evt.currentTarget.className += " active";
        }


        function tapreward(totalTapsForClaim) {
    const totalTapsCount = parseInt(<?php echo $userinfo->total_taps_count ?>); // Assume total taps count is stored in a hidden input or accessible element

    if (totalTapsCount === totalTapsForClaim) {
        // AJAX request to claim reward
        fetch('total_taps_claim.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ action: 'claimReward' }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Reward claimed successfully!');
            } else {
                alert(data.message || 'Failed to claim reward.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while claiming the reward.');
        });
    } else {
        alert('Not able to claim. Keep tapping!');
    }
}

var active_day = 1;
var active_btn = true;

function formatNumber(number) {
  if (number >= 1000000) {
    // Millions
    return (number / 1000000).toFixed(1) + "M";
  } else if (number >= 1000) {
    // Thousands
    return (number / 1000).toFixed(1) + "k";
  } else {
    // No formatting needed
    return number;
  }
}
        function dailyreward() {
            var overlay = document.getElementsByClassName("tasks-overlay");
            var bgOverlay = document.getElementsByClassName("bg-overlay");
            if (overlay.length === 0) {
                console.error("No elements with the class 'overlay-test' found.");
                return;
            }
            if (bgOverlay.length > 0) {
                for (var i = 0; i < bgOverlay.length; i++) {
                    bgOverlay[i].classList.add('active');
                }
            }
            for (var i = 0; i < overlay.length; i++) {
                overlay[i].classList.add('active');
            }

            console.log(active_day)
            document.getElementById('overlay').innerHTML = `<div class="daily-reward-overlay-earn active" id="dailyRewardOverlay" style="visibility: visible;"><button  onclick="${active_btn ? 'closedailyreward(event)' : 'closedailyreward_deactive(event)'}" class="close-button" class="close-button-earn"><img class="img-earn" src="./assets/close_button.svg" alt="Close"></button><div class="title-earn">Take daily reward</div><svg class="icon" width="158" height="159" viewBox="0 0 158 159" fill="none" xmlns="http://www.w3.org/2000/svg"><g filter="url(#filter0_f_0_2347)"><path d="M66.9582 53.0833C66.9582 51.9097 66.0068 50.9583 64.8332 50.9583C63.6596 50.9583 62.7082 51.9097 62.7082 53.0833V57.5579C58.6301 57.8844 55.9529 58.6859 53.986 60.6528C52.0191 62.6197 51.2177 65.2969 50.8911 69.375H107.109C106.782 65.2969 105.981 62.6197 104.014 60.6528C102.047 58.6859 99.3697 57.8844 95.2916 57.5579V53.0833C95.2916 51.9097 94.3402 50.9583 93.1666 50.9583C91.993 50.9583 91.0416 51.9097 91.0416 53.0833V57.3699C89.1566 57.3333 87.0438 57.3333 84.6666 57.3333H73.3332C70.956 57.3333 68.8432 57.3333 66.9582 57.3699V53.0833Z" fill="url(#paint0_linear_0_2347)"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M50.6666 80C50.6666 77.6227 50.6666 75.5099 50.7031 73.625H107.297C107.333 75.5099 107.333 77.6227 107.333 80V85.6667C107.333 96.3518 107.333 101.694 104.014 105.014C100.694 108.333 95.3517 108.333 84.6666 108.333H73.3332C62.6481 108.333 57.3055 108.333 53.986 105.014C50.6666 101.694 50.6666 96.3518 50.6666 85.6667V80ZM93.1666 85.6667C94.7314 85.6667 95.9999 84.3981 95.9999 82.8333C95.9999 81.2685 94.7314 80 93.1666 80C91.6018 80 90.3332 81.2685 90.3332 82.8333C90.3332 84.3981 91.6018 85.6667 93.1666 85.6667ZM93.1666 97C94.7314 97 95.9999 95.7315 95.9999 94.1667C95.9999 92.6019 94.7314 91.3333 93.1666 91.3333C91.6018 91.3333 90.3332 92.6019 90.3332 94.1667C90.3332 95.7315 91.6018 97 93.1666 97ZM81.8332 82.8333C81.8332 84.3981 80.5647 85.6667 78.9999 85.6667C77.4351 85.6667 76.1666 84.3981 76.1666 82.8333C76.1666 81.2685 77.4351 80 78.9999 80C80.5647 80 81.8332 81.2685 81.8332 82.8333ZM81.8332 94.1667C81.8332 95.7315 80.5647 97 78.9999 97C77.4351 97 76.1666 95.7315 76.1666 94.1667C76.1666 92.6019 77.4351 91.3333 78.9999 91.3333C80.5647 91.3333 81.8332 92.6019 81.8332 94.1667ZM64.8332 85.6667C66.398 85.6667 67.6666 84.3981 67.6666 82.8333C67.6666 81.2685 66.398 80 64.8332 80C63.2684 80 61.9999 81.2685 61.9999 82.8333C61.9999 84.3981 63.2684 85.6667 64.8332 85.6667ZM64.8332 97C66.398 97 67.6666 95.7315 67.6666 94.1667C67.6666 92.6019 66.398 91.3333 64.8332 91.3333C63.2684 91.3333 61.9999 92.6019 61.9999 94.1667C61.9999 95.7315 63.2684 97 64.8332 97Z" fill="url(#paint1_linear_0_2347)"></path></g><g filter="url(#filter1_f_0_2347)"><path d="M66.9582 53.0833C66.9582 51.9097 66.0068 50.9583 64.8332 50.9583C63.6596 50.9583 62.7082 51.9097 62.7082 53.0833V57.5579C58.6301 57.8844 55.9529 58.6859 53.986 60.6528C52.0191 62.6197 51.2177 65.2969 50.8911 69.375H107.109C106.782 65.2969 105.981 62.6197 104.014 60.6528C102.047 58.6859 99.3697 57.8844 95.2916 57.5579V53.0833C95.2916 51.9097 94.3402 50.9583 93.1666 50.9583C91.993 50.9583 91.0416 51.9097 91.0416 53.0833V57.3699C89.1566 57.3333 87.0438 57.3333 84.6666 57.3333H73.3332C70.956 57.3333 68.8432 57.3333 66.9582 57.3699V53.0833Z" fill="url(#paint2_linear_0_2347)"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M50.6666 80C50.6666 77.6227 50.6666 75.5099 50.7031 73.625H107.297C107.333 75.5099 107.333 77.6227 107.333 80V85.6667C107.333 96.3518 107.333 101.694 104.014 105.014C100.694 108.333 95.3517 108.333 84.6666 108.333H73.3332C62.6481 108.333 57.3055 108.333 53.986 105.014C50.6666 101.694 50.6666 96.3518 50.6666 85.6667V80ZM93.1666 85.6667C94.7314 85.6667 95.9999 84.3981 95.9999 82.8333C95.9999 81.2685 94.7314 80 93.1666 80C91.6018 80 90.3332 81.2685 90.3332 82.8333C90.3332 84.3981 91.6018 85.6667 93.1666 85.6667ZM93.1666 97C94.7314 97 95.9999 95.7315 95.9999 94.1667C95.9999 92.6019 94.7314 91.3333 93.1666 91.3333C91.6018 91.3333 90.3332 92.6019 90.3332 94.1667C90.3332 95.7315 91.6018 97 93.1666 97ZM81.8332 82.8333C81.8332 84.3981 80.5647 85.6667 78.9999 85.6667C77.4351 85.6667 76.1666 84.3981 76.1666 82.8333C76.1666 81.2685 77.4351 80 78.9999 80C80.5647 80 81.8332 81.2685 81.8332 82.8333ZM81.8332 94.1667C81.8332 95.7315 80.5647 97 78.9999 97C77.4351 97 76.1666 95.7315 76.1666 94.1667C76.1666 92.6019 77.4351 91.3333 78.9999 91.3333C80.5647 91.3333 81.8332 92.6019 81.8332 94.1667ZM64.8332 85.6667C66.398 85.6667 67.6666 84.3981 67.6666 82.8333C67.6666 81.2685 66.398 80 64.8332 80C63.2684 80 61.9999 81.2685 61.9999 82.8333C61.9999 84.3981 63.2684 85.6667 64.8332 85.6667ZM64.8332 97C66.398 97 67.6666 95.7315 67.6666 94.1667C67.6666 92.6019 66.398 91.3333 64.8332 91.3333C63.2684 91.3333 61.9999 92.6019 61.9999 94.1667C61.9999 95.7315 63.2684 97 64.8332 97Z" fill="url(#paint3_linear_0_2347)"></path></g><path d="M66.9584 53.0833C66.9584 51.9097 66.007 50.9583 64.8334 50.9583C63.6597 50.9583 62.7084 51.9097 62.7084 53.0833V57.5579C58.6303 57.8844 55.953 58.6859 53.9861 60.6528C52.0192 62.6197 51.2178 65.2969 50.8912 69.375H107.109C106.782 65.2969 105.981 62.6197 104.014 60.6528C102.047 58.6859 99.3698 57.8844 95.2917 57.5579V53.0833C95.2917 51.9097 94.3403 50.9583 93.1667 50.9583C91.9931 50.9583 91.0417 51.9097 91.0417 53.0833V57.3699C89.1568 57.3333 87.044 57.3333 84.6667 57.3333H73.3334C70.9561 57.3333 68.8433 57.3333 66.9584 57.3699V53.0833Z" fill="url(#paint4_linear_0_2347)"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M50.6667 80C50.6667 77.6227 50.6667 75.5099 50.7032 73.625H107.297C107.333 75.5099 107.333 77.6227 107.333 80V85.6667C107.333 96.3518 107.333 101.694 104.014 105.014C100.694 108.333 95.3519 108.333 84.6667 108.333H73.3334C62.6482 108.333 57.3056 108.333 53.9861 105.014C50.6667 101.694 50.6667 96.3518 50.6667 85.6667V80ZM93.1667 85.6667C94.7315 85.6667 96 84.3981 96 82.8333C96 81.2685 94.7315 80 93.1667 80C91.6019 80 90.3334 81.2685 90.3334 82.8333C90.3334 84.3981 91.6019 85.6667 93.1667 85.6667ZM93.1667 97C94.7315 97 96 95.7315 96 94.1667C96 92.6019 94.7315 91.3333 93.1667 91.3333C91.6019 91.3333 90.3334 92.6019 90.3334 94.1667C90.3334 95.7315 91.6019 97 93.1667 97ZM81.8334 82.8333C81.8334 84.3981 80.5648 85.6667 79 85.6667C77.4352 85.6667 76.1667 84.3981 76.1667 82.8333C76.1667 81.2685 77.4352 80 79 80C80.5648 80 81.8334 81.2685 81.8334 82.8333ZM81.8334 94.1667C81.8334 95.7315 80.5648 97 79 97C77.4352 97 76.1667 95.7315 76.1667 94.1667C76.1667 92.6019 77.4352 91.3333 79 91.3333C80.5648 91.3333 81.8334 92.6019 81.8334 94.1667ZM64.8334 85.6667C66.3982 85.6667 67.6667 84.3981 67.6667 82.8333C67.6667 81.2685 66.3982 80 64.8334 80C63.2685 80 62 81.2685 62 82.8333C62 84.3981 63.2685 85.6667 64.8334 85.6667ZM64.8334 97C66.3982 97 67.6667 95.7315 67.6667 94.1667C67.6667 92.6019 66.3982 91.3333 64.8334 91.3333C63.2685 91.3333 62 92.6019 62 94.1667C62 95.7315 63.2685 97 64.8334 97Z" fill="url(#paint5_linear_0_2347)"></path><defs><filter id="filter0_f_0_2347" x="0.666565" y="0.958328" width="156.667" height="157.375" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB"><feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood><feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"></feBlend><feGaussianBlur stdDeviation="25" result="effect1_foregroundBlur_0_2347"></feGaussianBlur></filter><filter id="filter1_f_0_2347" x="46.6666" y="46.9583" width="64.6667" height="65.375" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB"><feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood><feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"></feBlend><feGaussianBlur stdDeviation="2" result="effect1_foregroundBlur_0_2347"></feGaussianBlur></filter><linearGradient id="paint0_linear_0_2347" x1="78.9999" y1="50.9583" x2="78.9999" y2="108.333" gradientUnits="userSpaceOnUse"><stop stop-color="#2FB8FF"></stop><stop offset="1" stop-color="#9EECD9"></stop></linearGradient><linearGradient id="paint1_linear_0_2347" x1="78.9999" y1="50.9583" x2="78.9999" y2="108.333" gradientUnits="userSpaceOnUse"><stop stop-color="#2FB8FF"></stop><stop offset="1" stop-color="#9EECD9"></stop></linearGradient><linearGradient id="paint2_linear_0_2347" x1="78.9999" y1="50.9583" x2="78.9999" y2="108.333" gradientUnits="userSpaceOnUse"><stop stop-color="#2FB8FF"></stop><stop offset="1" stop-color="#9EECD9"></stop></linearGradient><linearGradient id="paint3_linear_0_2347" x1="78.9999" y1="50.9583" x2="78.9999" y2="108.333" gradientUnits="userSpaceOnUse"><stop stop-color="#2FB8FF"></stop><stop offset="1" stop-color="#9EECD9"></stop></linearGradient><linearGradient id="paint4_linear_0_2347" x1="79" y1="50.9583" x2="79" y2="108.333" gradientUnits="userSpaceOnUse"><stop stop-color="#2FB8FF"></stop><stop offset="1" stop-color="#9EECD9"></stop></linearGradient><linearGradient id="paint5_linear_0_2347" x1="79" y1="50.9583" x2="79" y2="108.333" gradientUnits="userSpaceOnUse"><stop stop-color="#2FB8FF"></stop><stop offset="1" stop-color="#9EECD9"></stop></linearGradient></defs></svg>
                <div id="rewardsContainer2" class="rewards-container-earn">
                    <?php
                    foreach($reward_days as $reward_day){
                    ?>
                    <div id="reward-1" class="reward-item-earn ${active_day ==<?php echo $reward_day['day_number'] ?> ? 'active' : ''}">
                    <div class="description1-earn ${active_day > <?php echo $reward_day['day_number'] ?> ? 'passday' : ''}">Day <?php echo $reward_day['day_number'] ?></div>
                    <div class="container-earn">
                        <img class="coin-earn" src="./assets/coin_icon.png" alt="CoinIcon">
                        <div class="description2-earn ${active_day > <?php echo $reward_day['day_number'] ?> ? 'passday' : ''}">+${formatNumber(<?php echo $reward_day['amount'] ?>)}</div>
                    </div>
                    </div>
                    <?php }?>
                </div>
                <button class="task-button1-earn" onclick="${active_btn ? 'closedailyreward(event)' : 'closedailyreward_deactive(event)'}">Claim</button>
            </div>`

        }

        function openOverlay(evt, image, title, profit,profit2,task_description, task_description_2,url) {
            var overlay = document.getElementsByClassName("tasks-overlay");
            var bgOverlay = document.getElementsByClassName("bg-overlay");
            if (overlay.length === 0) {
                console.error("No elements with the class 'overlay-test' found.");
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
            document.getElementById('overlay').innerHTML = `<button onclick="closeOverlay(event)" class="close-button"><img src="./assets/close_button.svg" alt="close" /></button>
                <h3>${task_description}</h3>
                <p>${task_description_2}</p>
                <div class="balance-small" style="padding: 6px 0px 12px;"><img src="./assets/coin_icon.png" alt="coin"><span id="balance">+${profit}</span><img src="./assets/coin_icon.png" alt="coin"><span id="balance2">+${profit2}</span></div>
                <button class="buy-button">
                    <a href="${url}">Go ahead!</a>
                </button>
                <button class="buy-button">
                    Claim
                </button>`;

        }

        function closedailyreward(event) {
    const overlay = document.getElementsByClassName("tasks-overlay");
    const bgOverlay = document.getElementsByClassName("bg-overlay");
    const rewardOverlay = document.getElementById("dailyRewardOverlay");

    Array.from(overlay).forEach(element => element.classList.remove('active'));
    Array.from(bgOverlay).forEach(element => element.classList.remove('active'));
    if (rewardOverlay) rewardOverlay.remove();
    
    console.log(active_day, "active")
    const reward_day = <?php echo json_encode($reward_days); ?>;
    if (active_day <= reward_day.length)
        {active_day++;}
    else active_day = 1;
    active_btn=false;
}
function closedailyreward_deactive(event) {
    const overlay = document.getElementsByClassName("tasks-overlay");
    const bgOverlay = document.getElementsByClassName("bg-overlay");
    const rewardOverlay = document.getElementById("dailyRewardOverlay");

    Array.from(overlay).forEach(element => element.classList.remove('active'));
    Array.from(bgOverlay).forEach(element => element.classList.remove('active'));
    if (rewardOverlay) rewardOverlay.remove();
}

        function checkTime() {
        const now = new Date();
        const hours = now.getHours();
        const minutes = now.getMinutes();
        const seconds = now.getSeconds();

        if (hours === 0 && minutes === 0 && seconds === 0) {
            active_btn = true;
            console.log("active_btn is now true!");
            // Add your code here to perform actions when active_btn becomes true
        }
        }

        // Check the time every second
        setInterval(checkTime, 1000);

        // Initial check (in case the script runs at 00:00:00)
        checkTime();

        function closeOverlay(evt) {
            var overlay = document.getElementsByClassName("tasks-overlay");
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
        window.onload = function () {
            var i, tabcontent, tablinks;
            // tabcontent = document.getElementsByClassName("tasks-tab-content");
            // for (i = 0; i < tabcontent.length; i++) {
            //     if (tabcontent[i].id != 'tasks')
            //         tabcontent[i].style.display = "none";
            //     else tabcontent[i].style.display = "flex";
            // }
        };
        document.addEventListener('click', function (event) {
            if (event.target.matches('.bg-overlay')) {
                closeOverlay(event);
            }
        })
    </script>
</body>

</html>
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
    <title>Lama Web</title>
    <script src="https://telegram.org/js/telegram-web-app.js"></script>
    <link href="https://cdn.jsdelivr.net" rel="preconnect">
    <link href="https://sad.adsgram.ai" rel="preconnect">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://www.googletagmanager.com" rel="preconnect">
    <link href="https://telegram.org" rel="preconnect">
    <link rel="stylesheet" href="./styles.css?time=<?php echo time() ?>">
    <script src="https://cdn.jsdelivr.net/npm/eruda"></script>
    <style type="text/css">
        .eruda-search-highlight-block {
            display: inline
        }

        .eruda-search-highlight-block .eruda-keyword {
            background: #fffbe5;
            color: #5c5c00
        }

        .daily-reward-overlay-earn {
            height: auto;
        }

        .modal-top {
            width: 90%;
            flex-direction: row;
            justify-content: space-between;
            align-items: start;
            display: flex;
        }

        .overlay-image {
            width: 80px;
            height: 80px;
            border-radius: 50px;
            flex-direction: row;
            justify-content: center;
            object-fit: cover;
            overflow: hidden;
            align-items: center;
            margin-top: 20px;
        }

        .img-mark {
            max-width: 80px;
            margin-top: -40%;
        }

        .boost-button {
            visibility: hidden;
        }

    </style>
    <script src="https://sad.adsgram.ai/js/sad.min.js"></script>

</head>

<body ontouchstart="" style="top:auto;overflow:hidden">
        <div class="tasks-overlay" id="overlay"></div>
        <script>
            // sessionStorage.removeItem('visitCount');
            // console.log('visitCount');
            function getVisitCount() {
                let visitCount = sessionStorage.getItem('visitCount');
                if (visitCount === null) {
                    visitCount = 0;
                }
                return parseInt(visitCount);
            }

            // Function to increment and store the visit count
            function incrementVisitCount() {
                let visitCount = getVisitCount();
                visitCount++;
                sessionStorage.setItem('visitCount', visitCount);
            }

            // function clearVisitCount() {
            //     sessionStorage.removeItem('visitCount');
            // }

            // Function to conditionally render the div
            function renderDiv() {
                const visitCount = getVisitCount();
                if (visitCount < 2) {
                    console.log('dddd')
                    document.getElementById('overlay').innerHTML = `
                        <div class="daily-reward-overlay-earn active" id="dailyRewardOverlay" style="visibility: visible;">
                            <div class="modal-top"> 
                                <div style="visibility: hidden;">               
                                    <button class="close-button close-button-earn">
                                    </button>
                                </div>
                                <div class="overlay-image">
                                    <img class="img-mark" src="./assets/Loading_Background.png" alt="Close">
                                </div>
                                <div>   
                                    <button onclick="closeModal(event)" class="close-button close-button-earn">
                                        <img class="img-earn" src="./assets/close_button.svg" alt="Close">
                                    </button>
                                </div>
                            </div>
                            <div class="title-earn" style="width: 80%; font-size: 24px; padding: 3%;">While you were away your lamaz earned</div>
                            <div class="title-earn" style="width: 80%; font-size: 24px;">
                                <img style="max-width: 50px" src="./assets/coin_icon.png" alt="Close">
                                &nbsp;&nbsp;&nbsp;303
                            </div>    
                            <button id="claim-button" style= "margin-top: 20px;" class="task-button1-earn" onclick="closeModal(event)">Thanks, CRYPTOLAMAZ ❤</button>
                        </div>`
                }
                else {
                    document.getElementById('boost-btn').style.visibility='visible';
                }
            }

            window.addEventListener('load', () => {
                incrementVisitCount();
                renderDiv();
            });
            
            // Event listener for mini closure (replace 'miniCloseButton' with your actual ID)
            // document.getElementById('claim-button').addEventListener('click', () => {
            //     clearVisitCount(); // Clear visit count when mini is closed
            //     renderDiv(); // Re-render to reflect the cleared count
            // });

            function closeModal (event) {
                document.getElementById('boost-btn').style.visibility='visible';
                    const overlay = document.getElementsByClassName("tasks-overlay");
                    const rewardOverlay = document.getElementById("dailyRewardOverlay");

                    Array.from(overlay).forEach(element => element.classList.remove('active'));
                    if (rewardOverlay) rewardOverlay.remove();
                    return;
            }
            // window.onload = function() {
            //     document.getElementById('boost-btn').style.visibility='hidden';
            // };
        </script>
        <div class="box" style="width: 90%;">
            <div class="objects">
                <div class="user-profile">
                    <div class="wrap"><img src="./assets/default_profile_img.png" alt="User Icon" id="profileImg"></div>
                    <span id="username"><?php echo $firstname . ' ' . $lastname; ?></span>

                    <div class="league">●</div>
                    <div class="league" id="league">Bronze</div>
                </div><img class="right-image" src="./assets/coin_icon.png" alt="Coins" width="24" height="24">
                <div class="league-and-coins-per-hour">
                    <div class="leagues">
                        <div class="text"
                            style="display: flex; justify-content: center; align-items: center; text-align: center;">
                            <div class="txt" style="white-space: nowrap;">lvl 1</div>
                            <div class="progress-bar-container" onclick="window.location.href='league.php'">
                                <svg class="progress-bar" width="236" height="17" viewBox="0 0 236 17" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <defs>
                                        <clipPath id="clip-path">
                                            <path
                                                d="M6 9.47214V14C6 15.1046 6.89543 16 8 16H227.5C228.605 16 229.5 15.1046 229.5 14V9.47214C229.5 9.16165 229.428 8.85542 229.289 8.57771L226.053 2.10557C225.714 1.428 225.021 1 224.264 1H11.2361C10.4785 1 9.786 1.428 9.44721 2.10557L6.21115 8.57771C6.07229 8.85542 6 9.16165 6 9.47214Z">
                                            </path>
                                        </clipPath>
                                        <linearGradient id="bronze-gradient" x1="0" y1="0" x2="1" y2="0">
                                            <stop offset="0%" stop-color="#cd7f32"></stop>
                                            <stop offset="100%" stop-color="#a66a2c"></stop>
                                        </linearGradient>
                                        <linearGradient id="silver-gradient" x1="0" y1="0" x2="1" y2="0">
                                            <stop offset="0%" stop-color="#c0c0c0"></stop>
                                            <stop offset="100%" stop-color="#a9a9a9"></stop>
                                        </linearGradient>
                                        <linearGradient id="gold-gradient" x1="0" y1="0" x2="1" y2="0">
                                            <stop offset="0%" stop-color="#ffd700"></stop>
                                            <stop offset="100%" stop-color="#ffb700"></stop>
                                        </linearGradient>
                                        <linearGradient id="platinum-gradient" x1="0" y1="0" x2="1" y2="0">
                                            <stop offset="0%" stop-color="#e5e4e2"></stop>
                                            <stop offset="100%" stop-color="#d1d1d1"></stop>
                                        </linearGradient>
                                        <linearGradient id="diamond-gradient" x1="0" y1="0" x2="1" y2="0">
                                            <stop offset="0%" stop-color="#b9f2ff"></stop>
                                            <stop offset="100%" stop-color="#89cff0"></stop>
                                        </linearGradient>
                                        <filter id="glow" x="-50%" y="-50%" width="200%" height="200%">
                                            <feDropShadow dx="0" dy="-5" stdDeviation="5" flood-color="white"
                                                flood-opacity="0.8"></feDropShadow>
                                        </filter>
                                        <filter id="filter0_bi_1_46" x="-14.5" y="-19.5" width="264.5" height="56"
                                            filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                            <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                            <feGaussianBlur in="BackgroundImageFix" stdDeviation="10"></feGaussianBlur>
                                            <feComposite in2="SourceAlpha" operator="in"
                                                result="effect1_backgroundBlur_1_46"></feComposite>
                                            <feBlend mode="normal" in="SourceGraphic" in2="effect1_backgroundBlur_1_46"
                                                result="shape"></feBlend>
                                            <feColorMatrix in="SourceAlpha" type="matrix"
                                                values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha">
                                            </feColorMatrix>
                                            <feOffset dx="11" dy="5"></feOffset>
                                            <feGaussianBlur stdDeviation="4.5"></feGaussianBlur>
                                            <feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1"></feComposite>
                                            <feColorMatrix type="matrix"
                                                values="0 0 0 0 1 0 0 0 0 1 0 0 0 0 1 0 0 0 0.29 0"></feColorMatrix>
                                            <feBlend mode="normal" in2="shape" result="effect2_innerShadow_1_46"></feBlend>
                                        </filter>
                                        <filter id="filter1_f_1_46" x="0" y="3" width="236" height="14"
                                            filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                            <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                            <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix"
                                                result="shape"></feBlend>
                                            <feGaussianBlur stdDeviation="3" result="effect1_foregroundBlur_1_46">
                                            </feGaussianBlur>
                                        </filter>
                                        <linearGradient id="paint0_linear_1_46" x1="143.5" y1="-1" x2="143.5" y2="16"
                                            gradientUnits="userSpaceOnUse">
                                            <stop stop-color="white" stop-opacity="0"></stop>
                                            <stop offset="1" stop-color="white" stop-opacity="0.4"></stop>
                                        </linearGradient>
                                    </defs>
                                    <g filter="url(#filter0_bi_1_46)">
                                        <rect id="progress-fill" x="6" y="1" width="0.13216528661146446" height="15"
                                            fill="url(#bronze-gradient)" clip-path="url(#clip-path)"></rect>
                                        <rect id="progress-glow" x="6" y="1" width="0" height="15"
                                            fill="url(#bronze-gradient)" clip-path="url(#clip-path)" filter="url(#glow)">
                                        </rect>
                                        <path
                                            d="M6 9.47214V14C6 15.1046 6.89543 16 8 16H227.5C228.605 16 229.5 15.1046 229.5 14V9.47214C229.5 9.16165 229.428 8.85542 229.289 8.57771L226.053 2.10557C225.714 1.428 225.021 1 224.264 1H11.2361C10.4785 1 9.786 1.428 9.44721 2.10557L6.21115 8.57771C6.07229 8.85542 6 9.16165 6 9.47214Z"
                                            stroke="url(#paint0_linear_1_46)" style="mix-blend-mode: overlay;"></path>
                                    </g>
                                    <g filter="url(#filter1_f_1_46)">
                                        <path d="M6 9H230V11H6V9Z" fill="black" fill-opacity="0.17"
                                            style="mix-blend-mode: overlay;"></path>
                                    </g>
                                </svg>
                            </div>
                            <div class="next-lvl" id="progress-value"><?php echo rtrim(rtrim(number_format($userinfo->balance, 4), '0'), '.'); ?>/25.0K</div><svg class="arrow" width="6" height="12"
                                viewBox="0 0 6 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 1.33334L5 6.00001L1 10.6667" stroke="white" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button id="boost-btn" class="boost-button" onclick="window.location.href='boost.php'">
            <img src="./assets/boost.svg" alt="boost icon" class="boost-img">Boost
        </button>
        <div class="root" onclick="createRisingText(event)">
            <div
                style="display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">

                <div class="balance-container-home">
                    <div class="balance"><img src="./assets/coin_icon.png" alt="coin"><span id="balance"><?php echo rtrim(rtrim(number_format($userinfo->balance, 4), '0'), '.'); ?></span></div>
                </div>
                <div class="hamster-container" id="vibrateButton"
                    style="transform: translateY(0px) scale(1); transform-origin: center bottom; transition: transform 0.3s ease-in-out;">
                    <svg width="164" height="800" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <defs>
                            <filter id="neon">
                                <feMorphology operator="dilate" radius="4" in="SourceAlpha" result="thicken"></feMorphology>
                                <feGaussianBlur in="thicken" stdDeviation="0" result="blurred"></feGaussianBlur>
                                <feFlood flood-color="#FF8C00" flood-opacity="0" result="glowColor"></feFlood>
                                <feComposite in="glowColor" in2="blurred" operator="in" result="softGlowColored">
                                </feComposite>
                                <feMerge>
                                    <feMergeNode in="softGlowColored"></feMergeNode>
                                    <feMergeNode in="SourceGraphic"></feMergeNode>
                                </feMerge>
                            </filter>
                        </defs>
                        <image id="tap-object" class="clickable-image" x="30" y="200" width="144" height="360"
                            href="./assets/bronze.png" style="filter: url(&quot;#neon&quot;);"></image>
                    </svg>
                </div>
                <div class="energy-container">
                    <div class="energy">
                        <div class="svg-container2"><svg width="21" height="23" viewBox="0 0 21 23" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g filter="url(#filter0_f_122_7411)">
                                    <path
                                        d="M6.32466 9.2961L8.95237 6.76391C10.6509 5.12711 11.5002 4.30871 12.1117 4.61533C12.7232 4.92195 12.5293 6.06899 12.1416 8.36307L12.1051 8.57938C11.9653 9.4068 11.8953 9.82051 12.1159 10.1247L12.1276 10.1405C12.3547 10.4402 12.7853 10.5129 13.6465 10.6585C15.1962 10.9204 15.9711 11.0513 16.1536 11.5656C16.1566 11.5741 16.1595 11.5827 16.1622 11.5913C16.3288 12.1103 15.7775 12.6415 14.6751 13.7039L12.0474 16.236C10.3488 17.8728 9.49951 18.6912 8.888 18.3846C8.2765 18.078 8.47037 16.9309 8.8581 14.6368L8.89464 14.4206C9.03449 13.5932 9.10442 13.1795 8.88389 12.8753L8.87217 12.8595C8.64501 12.5598 8.21442 12.487 7.35323 12.3415C5.8035 12.0796 5.02864 11.9486 4.8462 11.4344C4.84317 11.4259 4.84028 11.4173 4.83753 11.4087C4.67098 10.8897 5.2222 10.3585 6.32466 9.2961Z"
                                        fill="url(#paint0_linear_122_7411)"></path>
                                </g>
                                <path
                                    d="M6.32466 9.2961L8.95237 6.76391C10.6509 5.12711 11.5002 4.30871 12.1117 4.61533C12.7232 4.92195 12.5293 6.06899 12.1416 8.36307L12.1051 8.57938C11.9653 9.4068 11.8953 9.82051 12.1159 10.1247L12.1276 10.1405C12.3547 10.4402 12.7853 10.5129 13.6465 10.6585C15.1962 10.9204 15.9711 11.0513 16.1536 11.5656C16.1566 11.5741 16.1595 11.5827 16.1622 11.5913C16.3288 12.1103 15.7775 12.6415 14.6751 13.7039L12.0474 16.236C10.3488 17.8728 9.49951 18.6912 8.888 18.3846C8.2765 18.078 8.47037 16.9309 8.8581 14.6368L8.89464 14.4206C9.03449 13.5932 9.10442 13.1795 8.88389 12.8753L8.87217 12.8595C8.64501 12.5598 8.21442 12.487 7.35323 12.3415C5.8035 12.0796 5.02864 11.9486 4.8462 11.4344C4.84317 11.4259 4.84028 11.4173 4.83753 11.4087C4.67098 10.8897 5.2222 10.3585 6.32466 9.2961Z"
                                    fill="url(#paint1_linear_122_7411)"></path>
                                <defs>
                                    <filter id="filter0_f_122_7411" x="0.808105" y="0.55188" width="19.3833"
                                        height="21.8962" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                        <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape">
                                        </feBlend>
                                        <feGaussianBlur stdDeviation="2" result="effect1_foregroundBlur_122_7411">
                                        </feGaussianBlur>
                                    </filter>
                                    <linearGradient id="paint0_linear_122_7411" x1="15.4573" y1="-17.8341" x2="9.31954"
                                        y2="18.4843" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#2FB8FF"></stop>
                                        <stop offset="1" stop-color="#9EECD9"></stop>
                                    </linearGradient>
                                    <linearGradient id="paint1_linear_122_7411" x1="15.4573" y1="-17.8341" x2="9.31954"
                                        y2="18.4843" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#2FB8FF"></stop>
                                        <stop offset="1" stop-color="#9EECD9"></stop>
                                    </linearGradient>
                                </defs>
                            </svg></div><span id="energy"><?php echo $userinfo->left_point; ?></span> / <span
                            id="max-energy"><?php echo $userinfo->total_points; ?></span>
                    </div>

                </div>
                <div class="reward-amount" id="rewardAmount"></div>
                <!-- <div class="reward-description">Bot mined some coins for you</div><button class="reward-button">Thanks</button> -->
            </div>
            <div class="crypto-overlay ">
                <div class="crypto-reward-details "><button class="close-button"><img class="img"
                            src="./assets/close_button.svg" alt="Close"></button>
                    <!-- <div style="border-radius: 100px; border: 4px solid rgb(3, 18, 35); background: rgb(20, 33, 48); position: absolute; left: 50%; top: 27px; transform: translateX(-50%); display: flex; padding: 8px; width: 82px; height: 82px; box-sizing: border-box; align-items: center; text-align: center; justify-content: center; overflow: hidden;"><img src="./assets/Loading_Background.png" style="border-radius: 0px 0px 32px 32px; transform: scale(0.19); margin-bottom: 10px;"></div> -->
                    <!-- <div style="border-radius: 16px; background: transparent; margin-bottom: 5px; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 60px 0px 28px; width: 927.9px; margin-top: 50px; box-sizing: border-box;"> -->
                    <div
                        style="margin-bottom: 10px; display: flex; flex-direction: row; width: fit-content; box-sizing: border-box;">
                        <span
                            style="margin: 4px 0px 0px; display: inline-block; overflow-wrap: break-word; font-family: Geologica; font-weight: 400; font-size: 30px; color: rgb(255, 255, 255);">While
                            you were away</span></div>
                    <div
                        style="margin-bottom: 10px; display: flex; flex-direction: row; width: fit-content; box-sizing: border-box;">
                        <span
                            style="margin: 0px; display: inline-block; overflow-wrap: break-word; font-family: Geologica; font-weight: 400; font-size: 30px; color: rgb(255, 255, 255);">your
                            lamaz earned</span></div>
                    <div
                        style="margin-bottom: 0px; display: flex; flex-direction: row; width: fit-content; box-sizing: border-box; align-items: center; justify-content: center;">
                        <img src="./assets/coin_icon.png" style="margin-right: 12px; width: 60px; height: 60px;"><span
                            style="margin: 0px 0px 6px; display: inline-block; overflow-wrap: break-word; font-family: Geologica; font-weight: 400; font-size: 30px; color: rgb(255, 255, 255);">0</span>
                    </div>
                </div>
                <button class="crypto-reward-button"
                    style="border-radius: 16px; background: rgb(21, 145, 161); margin-right: 5px; border: none; display: flex; text-align: center; justify-content: center; align-items: center; width: 927.9px; height: 50px; box-sizing: border-box; overflow-wrap: break-word; font-family: Geologica; font-weight: 500; font-size: 16px; letter-spacing: 0.3px; color: rgb(255, 255, 255);">Thanks,
                    CRYPTOLAMAZ<svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg" style="margin-left: 3px;">
                        <path
                            d="M1.6665 7.61413C1.6665 11.6666 5.01603 13.8261 7.46795 15.7589C8.33317 16.441 9.1665 17.0832 9.99984 17.0832C10.8332 17.0832 11.6665 16.441 12.5317 15.7589C14.9836 13.8261 18.3332 11.6666 18.3332 7.61413C18.3332 3.56168 13.7497 0.687765 9.99984 4.58374C6.24997 0.687765 1.6665 3.56168 1.6665 7.61413Z"
                            fill="white"></path>
                    </svg></button>
            </div>
        </div>
        <div class="overlay" id="overlay"></div>
        <img src="./assets/bronze-background.png" class="overlay-bg" alt="Image 1"
            style="width: 100vw; height: 100vh; object-fit: cover; position: fixed; top: 0px; left: 0px; z-index: -1;">
    <?php $activeTab = 'mine';
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
        // Function to update the width of the progress-glow rectangle
        function updateGlowWidth(newWidth) {
            const progressGlow = document.getElementById('progress-glow');
            progressGlow.setAttribute('width', newWidth);
        }

        function createRisingText(event) {
            // console.log(event, event.currentTarget);
            addEffects(rectElement);

            // if(event.currentTarget.classList.contains('box')) {
            //     return;
            // }

            // Create a new span element for the text
            var risingText = document.createElement('span');
            risingText.className = 'rising-text';
            risingText.textContent = '+1'; // The text to display

            // Position the text at the click location
            var parentRect = event.currentTarget.getBoundingClientRect();
            risingText.style.left = event.clientX - 10 + 'px';
            risingText.style.top = event.clientY - parentRect.top - 10 + 'px';

            // Append the rising text to the clickable div
            event.currentTarget.appendChild(risingText);

            // Remove the rising text after the animation is completed
            setTimeout(function () {
                risingText.remove();
            }, 2000); // Matches the animation duration (2 seconds)
        }

        let currentScale = 1; // Initial scale factor
        let resetTimeout; // Timeout for resetting the scale
        let clickCount = <?php echo rtrim(rtrim(number_format($userinfo->balance, 4), '0'), '.'); ?>; // Count of clicks
        let progress = clickCount;
        let balance = clickCount;





        // Get the rectangular element
        const rectElement = document.getElementById('tap-object');
        const rectBounds = rectElement.getBoundingClientRect();

        // Add click event listener to the document
        document.addEventListener('click', (event) => {
            // Get the click coordinates
            const {
                clientX,
                clientY
            } = event;
            // Check if the click is inside the rectangle's boundaries
            // addEffects(rectElement);
            if (
                clientX >= rectBounds.left &&
                clientX <= rectBounds.right
            ) {
                //addEffects(rectElement);
                // Your event handling logic goes here
            }
        });




        // Function to be executed every second
        function updateCounter() {
            // Decrement clickCount only if it's greater than 0
            if (clickCount > 0) {
                clickCount--;
                document.getElementById('energy').innerText = <?php echo $userinfo->total_points; ?> - clickCount;
            }
        }

        // Updated addEffects function
        function addEffects(element) {
            const maxClicks = <?php echo $botconfig->tap_amount; ?>;

            // Prevent increment if max clicks reached
            if (clickCount >= maxClicks) {
                return;
            }

            clickCount++;
            balance++;
            document.getElementById('balance').innerText = balance;
            document.getElementById('energy').innerText = <?php echo $userinfo->total_points; ?> - clickCount;
            document.getElementById('progress-value').innerText = `${balance}/25.0K`;

            // Increment the scale factor
            if (currentScale <= 1.3) {
                currentScale += 0.01;
                element.style.transform = `scale(${currentScale})`;
            }

            // Add the sparkling effect
            element.classList.add('sparkling-effect');

            // Remove the sparkling effect after the animation is complete
            setTimeout(() => {
                element.classList.remove('sparkling-effect');
            }, 1000);

            // Clear any previous timeout to reset the scale
            clearTimeout(resetTimeout);

            // Set a timeout to reset the scale after 1 second of no action
            resetTimeout = setTimeout(() => {
                currentScale = 1;
                element.style.transition = 'transform 2.5s ease';
                element.style.transform = 'scale(1)'; // Reset to original size
            }, 1000);

            progress += 0.01;
            updateGlowWidth(progress);
        }

        // Interval to update the counter every 1 second
        setInterval(updateCounter, 1000);
    </script>
</body>

</html>
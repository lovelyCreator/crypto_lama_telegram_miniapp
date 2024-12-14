<div class="wallet-overlay" id="overlay">
  <div class="content" id="content">
    <div class="top-btn-group">
      <button onclick="openQRCode(event)" class="qr-button"><img src="./assets/qr-icon.svg" height="16px" width="16px" alt="qr" /></button>
      <button onclick="closeOverlay(event)" class="close-button"><img src="./assets/close_button.svg" alt="close" /></button>
    </div>
    <h4>Connect your wallet</h4>
    <p>Open Wallet in Telegram or select your wallet to connect</p>
    <button class="open-wallet-btn">
      <img src="./assets/wallet.png" height="16px" width="16px" alt="w" />
      Open Wallet in Telegram
      <img src="./assets/telegram-icon.png" height="16px" width="16px" alt="t" />
    </button>
    <div class="btn-group">
      <button><img src="" alt="t" />Tonkeeper</button>
      <button><img src="" alt="t" />MyTonWallet</button>
      <button><img src="" alt="t" />Tonhub</button>
      <button><img src="" alt="t" />DeWallet</button>
      <button><img src="" alt="t" />View all</button>
      <button><img src="" alt="t" />Open Link</button>
      <button><img src="" alt="t" />Copy Link</button>
    </div>
  </div>
  <div class="qr-content" id="qr-content" style="display: none;">
    <div class="top-btn-group">
      <button onclick="closeQRCode(event)" class="qr-button"><img src="./assets/qr-icon.svg" height="16px" width="16px" alt="qr" /></button>
      <button onclick="closeOverlay(event)" class="close-button"><img src="./assets/close_button.svg" alt="close" /></button>
    </div>
    <h4>Connect your wallet</h4>
    <p>Scan with your mobile wallet</p>
    <img src="../assets/qr.png" height="200px" width="200px" alt="qr" />
  </div>
  <div class="help-content" style="display: none;">
    <div class="top-btn-group" style="margin-bottom: 32px;">
      <button onclick="closeHelp(event)" class="qr-button"><img src="./assets/qr-icon.svg" height="16px" width="16px" alt="qr" /></button>
      <h4 style="margin: 0;">What is a wallet</h4>
      <button onclick="closeOverlay(event)" class="close-button"><img src="./assets/close_button.svg" alt="close" /></button>
    </div>
    <div class="help-item-group">
      <?php
      $helpItems = [
        [
          'image' => './assets/help_icon_1.png',
          'title' => 'Secure digital assets storage',
          'description' => 'A wallet protects and manages your digital assets including TON, tokens and collectables.',
        ],
        [
          'image' => './assets/help_icon_2.png',
          'title' => 'Control your Web3 Identity',
          'description' => 'Manage your digital identity and access decentralized applications with ease. Maintain control over your data and engage security in the blockchain ecosystem.',
        ],
        [
          'image' => './assets/help_icon_3.png',
          'title' => 'Effortless crypto transactions',
          'description' => 'Easily send, receive, monitor your cryptocurrencies. Streamline your operations with decentralized applications.',
        ]
      ];
      foreach ($helpItems as $item) {
        $item = $item;
        include './wallet/help-item.php';
      }
      ?>
    </div>
  </div>
  <div class="footer">
    <div>
      <img src="" alt="ton icon" />
      <b>TON</b>Connect
    </div>
    <button onclick="openHelp(event)">?</button>
  </div>
</div>
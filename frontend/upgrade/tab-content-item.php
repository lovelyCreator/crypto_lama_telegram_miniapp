<button class="tab-content-item" onclick="openOverlay(event, '<?php echo $item['image'] ?>', '<?php echo $item['title'] ?>', '<?php echo $item['level'] ?>', '<?php echo $item['profit'] ?>', '<?php echo $item['description'] ?>', '<?php echo $item['profit_per_hour'] ?>', '<?php echo $item['id'] ?>')">
  <div style="border-bottom: 2px solid rgba(255, 255, 255, 0.1);">
    <div style="margin-bottom: 12px;">
      <img src="<?php echo $item['image'] ?>" alt="crypto-item" class="item-image" />
    </div>
    <div class="item-title"><?php echo $item['title'] ?></div>
    <div class="balance-small" style="padding: 6px 0px 12px;">
      <span class="opacity">Profit per hour </span>
      <img src="./assets/coin_icon.png" alt="coin">
      <span id="balance"><?php echo $item['profit_per_hour'] ?></span>
    </div>
  </div>
  <div style="display: flex; align-items: center; padding: 12px 0px 0px 4px; font-size: 13px;">
    <span style="text-align: center; padding-right: 18px;">lvl <?php echo $item['level'] ?></span>
    <div class="balance-small" style="border-left: 1px solid rgba(255, 255, 255, 0.1);">
      <img src="./assets/coin_icon.png" alt="coin">
      <span id="balance" style="font-size: 16px"><?php echo $item['profit'] ?></span>
    </div>
  </div>
</button>

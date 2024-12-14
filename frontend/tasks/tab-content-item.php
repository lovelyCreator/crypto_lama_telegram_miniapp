<button class="daily-rqst-item" style="width: 100%;" onclick="openOverlay(event, '<?php echo ($item['image']) ?>', '<?php echo ($item['title']) ?>', '<?php echo ($item['profit']) ?>', '<?php echo ($item['profit2']) ?>', '<?php echo ($item['task_description']) ?>', '<?php echo ($item['task_description_2']) ?>', '<?php echo ($item['task_url']) ?>')">
  <img src="<?php echo ($item['image']) ?>" width="36px" height="36px" alt="" style="border: 1px solid; border-radius: 12px" />
  <div>
    <?php echo ($item['title']) ?>
    <div><img src="./assets/coin_icon.png" height="18px" width="18px" alt="coin"><span id="balance"><?php echo ($item['profit']) ?></span>
      <?php if (!isset($id)): ?>
        <img src="./assets/ton_symbol.png" height="18px" width="18px" />+<?php echo ($item['profit2']) ?>
      <?php endif; ?>
    </div>
  </div>
  <img src="./assets/arrow.svg" height="18px" alt="arrow" />
</button>
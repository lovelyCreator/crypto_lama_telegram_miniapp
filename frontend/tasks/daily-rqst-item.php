
<button class="daily-rqst-item" style="width: 90%;" onclick="<?php echo $item['item'] ?>">
  <img src="<?php echo $item['image'] ?>" width="36px" height="36px" alt="" style="border: 1px solid; border-radius: 12px" />
  <div>
    <?php echo ($item['title']) ?>
    <div><img src="./assets/coin_icon.png" height="18px" width="18px" alt="coin"><span id="balance"><?php echo ($item['profit']) ?></span></div>
  </div>
  <img src="./assets/arrow.svg" height="18px" alt="arrow" />
</button>
<?php
  $titleLeft = get_field( 'titleLeft' );
?>

<section class="text checkout">
  <?php if(strlen($titleLeft)): ?>
    <h2 class="text__titleLeftWrapper">
      <?= $titleLeft ?>
    </h2>
  <?php endif; ?>
  <div class="text__wrapper">
    <?= do_shortcode('[woocommerce_checkout]') ?>
  </div>
</section>


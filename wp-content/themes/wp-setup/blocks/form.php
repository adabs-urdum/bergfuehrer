<?php
  $id = get_field('form');
?>

<section class="text form">
  <div class="text__wrapper form__wrapper">
    <?= do_shortcode('[ninja_form id=' . $id . ']') ?>
  </div>
</section>

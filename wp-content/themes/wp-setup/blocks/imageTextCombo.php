<?php
  $layout = get_field('layout');
  $text = get_field( 'text' );
  $img = get_field('image');
  $caption = $img['caption'];
  $src = $img['sizes']['L'];
  $srcset = wp_get_attachment_image_srcset($img['ID']);
  $alt = $img['alt'] ? $img['alt'] : $img['name'];
  $imgTitle = $img['title'] ? $img['title'] : $img['name'];
  $srcset = wp_get_attachment_image_srcset($img['ID']);
?>

<section class="imageTextCombo">
  <div class="imageTextCombo__wrapper imageTextCombo__wrapper--<?= $layout ?>">
    <div class="imageTextCombo__half imageTextCombo__text">
      <div><?= $text ?></div>
    </div>
    <div class="imageTextCombo__half imageTextCombo__img">
      <img class="imageTextCombo__image" loading="lazy" src="<?= $src ?>" title="<?= $imgTitle ?>" alt="<?= $alt ?>" srcset="<?= $srcset ?>">
    </div>
  </div>
</section>

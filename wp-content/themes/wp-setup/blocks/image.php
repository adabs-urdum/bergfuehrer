<?php
  $img = get_field('image');
  $caption = $img['caption'];
  $src = $img['sizes']['L'];
  $alt = $img['alt'] ? $img['alt'] : $img['name'];
  $imgTitle = $img['title'] ? $img['title'] : $img['name'];
  $srcset = wp_get_attachment_image_srcset($img['ID']);
?>

<section class="image">
  <div class="image__wrapper">
    <img class="image__image" loading="lazy" src="<?= $src ?>" title="<?= $imgTitle ?>" alt="<?= $alt ?>" srcset="<?= $srcset ?>">
  </div>
</section>

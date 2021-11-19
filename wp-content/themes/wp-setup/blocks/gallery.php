<?php
  $images = get_field('images');
  $isOnAdminPage = is_admin();
?>

<section class="text tour__gallery gallery">
  <!-- <h2 class="text__titleLeftWrapper">
    Impressionen
  </h2> -->
  <div class="text__wrapper">
    <div class="tour__galleryImages">
      <?php foreach($images as $img): ?>
        <?php
          $caption = $img['caption'];
          $src = $img['sizes']['L'];
          $alt = $img['alt'] ? $img['alt'] : $img['name'];
          $imgTitle = $img['title'] ? $img['title'] : $img['name'];
          $srcset = wp_get_attachment_image_srcset($img['ID']);
        ?>
        <img class="tour__galleryImage gallery__image" loading="lazy" src="<?= $src ?>" title="<?= $imgTitle ?>" alt="<?= $alt ?>" srcset="<?= $srcset ?>">
      <?php endforeach; ?>
    </div>
  </div>
</section>

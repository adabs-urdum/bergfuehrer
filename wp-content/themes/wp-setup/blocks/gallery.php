<?php
  $images = get_field('images');
  $isOnAdminPage = is_admin();
?>

<section class="gallery swiper-container">
  <div class="gallery__wrapper swiper-wrapper">
    <?php foreach($images as $img): ?>
      <?php
        $caption = $img['caption'];
        $src = $img['sizes']['L'];
        $srcset = wp_get_attachment_image_srcset($img['ID']);
        $alt = $img['alt'] ? $img['alt'] : $img['name'];
        $imgTitle = $img['title'] ? $img['title'] : $img['name'];
        $srcset = wp_get_attachment_image_srcset($img['ID']);
      ?>
      <div class="swiper-slide">
        <img class="image__image" loading="lazy" src="<?= $src ?>" title="<?= $imgTitle ?>" alt="<?= $alt ?>" srcset="<?= $srcset ?>">
      </div>

      <?php
        if($isOnAdminPage):
      ?>
        <h1 class="blocksAdminHelper">Galerie</h1>
        <?php
          break;
        ?>
      <?php
        endif;
      ?>
    <?php endforeach; ?>
  </div>
</section>

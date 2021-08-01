<?php
  $address = get_field('footerContact', 'options');
  $footerLogos = get_field('footerLogos', 'options');
  $footerLinks = get_field('footerNav', 'options');
?>

<footer class="footer text">
  <div class="footer__wrapper text__titleLeftWrapper">

    <address class="footer__address">
      <?= $address ?>
    </address>

    <div class="footer__logos">
      <?php foreach($footerLogos as $footerLogo): ?>
        <?php
          $img = $footerLogo['logo'];
          $caption = $img['caption'];
          $src = $img['sizes']['L'];
          $alt = $img['alt'] ? $img['alt'] : $img['name'];
          $imgTitle = $img['title'] ? $img['title'] : $img['name'];
          $srcset = wp_get_attachment_image_srcset($img['ID']);
          $link = $footerLogo['link'];
        ?>
        <div class="footer__logoWrapper">
          <a class="footer__logoLink" href="<?= $link ?>">
            <img class="footer__logo" loading="lazy" src="<?= $src ?>" title="<?= $imgTitle ?>" alt="<?= $alt ?>" srcset="<?= $srcset ?>">
          </a>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="footer__nav">
      <?php foreach($footerLinks as $footerLink): ?>
        <?php
          $id = $footerLink['link']->ID;
          $title = get_the_title($id);
          $url = get_the_permalink($id);
        ?>
        <a href="<?= $url ?>" class="footer__navLink"><?= $title ?></a>
      <?php endforeach; ?>
    </div>

  </div>
</footer>

<?php wp_footer(); ?>

<?php
  $members = get_field( 'members' );
  $titleLeft = get_field( 'titleLeft' );
  $textAfter = get_field( 'textAfter' );
?>

<section class="team text">
  <h2 class="team__titleLeftWrapper text__titleLeftWrapper">
    <?= $titleLeft ?>
  </h2>
  <div class="team__wrapper text__wrapper">
    <div class="team__members">
      <?php foreach($members as $member): ?>
        <?php
          $memberId = $member['member']->ID;
          $name = get_field('name', $memberId);
          $lastname = get_field('lastname', $memberId);
          $img = get_field('image', $memberId);
          $caption = $img['caption'];
          $src = $img['sizes']['L'];
          $alt = $img['alt'] ? $img['alt'] : $img['name'];
          $imgTitle = $img['title'] ? $img['title'] : $img['name'];
          $srcset = wp_get_attachment_image_srcset($img['ID']);
          $text = get_field('text', $memberId);
        ?>
        <div class="team__member">
          <div class="team__imageWrapper">
            <canvas width="3" height="4"></canvas>
            <img class="team__image" loading="lazy" src="<?= $src ?>" title="<?= $imgTitle ?>" alt="<?= $alt ?>" srcset="<?= $srcset ?>">
          </div>
          <div class="team__textWrapper">
            <h3 class="team__name"><?= $name ?><br /><?= $lastname ?></h3>
            <div class="team__description"><?= $text ?></div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <?php if($textAfter): ?>
      <div class="team__textAfter">
        <?= $textAfter ?>
      </div>
    <?php endif; ?>
  </div>
</section>

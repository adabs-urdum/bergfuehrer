<?php get_header(); ?>

<main class="tour">

  <?php
    $pageID = get_the_ID();
    $pageTitle = get_the_title();
    $detailText = get_field('details', $pageID);
    $infos = get_field('infos', $pageID);
    $events = get_field('events', $pageID);
    $images = get_field('images', $pageID);
    // $infos = get_the_terms($pageID, 'Info');
  ?>

  <section class="text">
    <div class="text__wrapper">
      <h1 style="text-align: center"><?= $pageTitle ?></h1>
    </div>
  </section>

  <section class="text">

    <div for="details">
      <h2 class="text__titleLeftWrapper">Touren Details</h2>
    </div>

    <div class="text__wrapper tour__details">
      <?= $detailText ?>
    </div>

    <div class="text__wrapper tour__infos">
      <?php foreach($infos as $info): ?>
        <?php
          $term = get_term($info['info']);
          $termId = $term->term_id;
          $termName = $term->name;
          $img = get_field('image', 'term_' . $termId);
          $caption = $img['caption'];
          $src = $img['sizes']['L'];
          $alt = $img['alt'] ? $img['alt'] : $img['name'];
          $imgTitle = $img['title'] ? $img['title'] : $img['name'];
          $srcset = wp_get_attachment_image_srcset($img['ID']);
        ?>
        <div class="tour__info">
          <div class="tour__infoImageWrapper">
            <img class="tour__infoImage" loading="lazy" src="<?= $src ?>" title="<?= $imgTitle ?>" alt="<?= $alt ?>" srcset="<?= $srcset ?>">
          </div>
          <h3 class="tour__infoText"><?= $termName ?></h3>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="text__wrapper tour__bookingWrapper">
      <div class="tour__dates">
        <?php foreach($events as $key => $event): ?>
          <?php
            $date = $event['date'];
            $guide = $event['guide'];
          ?>
          <div class="tour__date">
            <input type="radio" name="tour" id="tour<?= $key ?>">
            <label for="tour<?= $key ?>" class="tour__date">
              <?= $date ?>
            </label>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="tour__booking">
        <a href="" class="button">Buchen</a>
        <a href="<?= get_permalink(13) ?>" class="button button--secondary">Kontakt</a>
      </div>
    </div>
  </section>

  <section class="text tour__gallery gallery">
    <h2 class="text__titleLeftWrapper">
      Impressionen
    </h2>
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

</main>

<?php get_footer(); ?>

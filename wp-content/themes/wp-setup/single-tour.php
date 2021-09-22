<?php get_header(); ?>

<main class="tour">

  <?php
    $pageID = get_the_ID();
    $pageTitle = get_the_title();
    $detailText = get_field('details', $pageID);
    $infos = get_field('infos', $pageID);
    $events = get_field('events', $pageID);
    $images = get_field('images', $pageID);
    $technique = get_field('technique', $pageID);
    $fitness = get_field('fitness', $pageID);
    $difficultyMax = 3;
    $materiallist = get_field('materiallist', $pageID);
    $program = get_field('program', $pageID);
    $altitude = get_field('altitude', $pageID);
    $duration = get_field('duration', $pageID);
    $price = get_field('price', $pageID);
    $place = get_term(get_field('place', $pageID))->name;
    // $infos = get_the_terms($pageID, 'Info');
    $bookingPermalink = get_permalink(163);

    $conducts = get_posts([
      'post_type' => 'conduct',
      'numberposts' => -1,
      'meta_key' => 'conductDate',
      'orderby' => 'meta_value',
      'order' => 'ASC',
    ]);

    $conducts = array_values(array_filter($conducts, function($conduct) use ($pageID){
      $id = $conduct->ID;
      $date = strtotime(get_field('conductDate', $id));
      $now = time();
      $tour = get_field('tour', $id)->ID;

      if($date > $now && $tour == $pageID){
        return 1;
      }
    }));

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

      <p>Ort: <?= $place ?></p>
      <p>Höhenmeter: <?= $altitude ?> Meter</p>
      <p>Dauer: <?= $duration ?></p>
      <p>Kosten: <?= $price ?>.– pro Person</p>

      <div class="events__difficultyWrapper">
        <div class="events__techniqueWrapper">
          <span>Technik</span>
          <span>
            <span class="events__icons">
              <?php for ($i=0; $i < $difficultyMax; $i++): ?>
                <?php
                  $class = $i + 1 - $technique < 1 ? 'full full--' . ($i + 1 - $technique) * 10 : 'empty';
                ?>
                <span class="events__icon <?= $class ?>"></span>
              <?php endfor; ?>
            </span>
          </span>
        </div>
        <div class="events__fitnessWrapper">
          <span>Kondition</span>
          <span>
            <span class="events__icons">
              <?php for ($i=0; $i < $difficultyMax; $i++): ?>
                <?php
                  $class = $i + 1 - $fitness < 1 ? 'full full--' . ($i + 1 - $fitness) * 10 : 'empty';
                ?>
                <span class="events__icon <?= $class ?>"></span>
              <?php endfor; ?>
            </span>
          </span>
        </div>
      </div>

      <div class="tour__lists">
        <div class="tour__materiallist">
          <h3>Materialliste</h3>
          <ul class="tour__materials">
            <?php foreach($materiallist as $material): ?>
              <?php
                $material = $material['material'];
              ?>
              <li class="tour__material"><?= $material ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <div class="tour__programlist">
          <h3>Programm</h3>
          <ul class="tour__program">
            <?php foreach($program as $programPoint): ?>
              <?php
                $programPoint = $programPoint['programpoint'];
              ?>
              <li class="tour__programPoint"><?= $programPoint ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
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
        <?php foreach($conducts as $conduct): ?>
          <?php
            $id = $conduct->ID;
            $maxRegistrations = get_field('maxRegistrations', $id);
            $registrations = get_field('registrations', $id);
            $registrations = is_array($registrations) ? array_sum(array_map(function($registration){
              return $registration['people'];
            }, $registrations)) : 0;

            if($maxRegistrations - $registrations < 1){
              continue;
            }

            $date = strtotime(get_field('conductDate', $id));
            $dateString = date('d.m.Y', $date);
          ?>
          <div class="tour__date">
            <input type="radio" name="tour" id="tour<?= $id ?>" value="<?= $id ?>" <?php if($id==$_GET['id']): ?>checked="checked"<?php endif; ?>>
            <label for="tour<?= $id ?>" class="tour__date">
              <span><?= $dateString ?></span>
              <span>Noch <?= $maxRegistrations - $registrations ?> freie Plätze</span>
            </label>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="tour__booking">
        <a id="bookingButton" href="<?= $bookingPermalink ?>?tour=<?= $pageID ?>" data-tour="<?= $pageID ?>" data-url="<?= $bookingPermalink ?>" target="_self" class="button">Buchen</a>
        <a href="<?= get_permalink(13) ?>" target="_self" class="button button--secondary">Kontakt</a>
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

<?php get_header(); ?>

<main class="tour">

  <?php
    $pageID = get_the_ID();
    $pageTitle = get_the_title();
    $detailText = get_field('details', $pageID);
    $downloads = get_field('downloads', $pageID);
    $infos = get_field('infos', $pageID);
    $description = get_field('description', $pageID);
    $events = get_field('events', $pageID);
    $images = get_field('images', $pageID);
    $technique = get_field('technique', $pageID);
    $fitness = get_field('fitness', $pageID);
    $difficultyMax = 3;
    $materiallist = get_field('materiallist', $pageID);
    $program = get_field('program', $pageID);
    $altitudes = get_field('altitudes', $pageID);
    $altitudeMin = $altitudes['min'];
    $altitudeMax = $altitudes['max'];
    $duration = get_field('duration', $pageID);
    $price = get_field('price', $pageID);
    // $prices = get_field('prices', $pageID);
    // $pricesOrdered = [];
    // foreach($prices as $price){
    //   $pricesOrdered[$price['anzahl']] = $price['price'];
    // }
    $type = get_term(get_field('type', $pageID))->name;
    $place = get_term(get_field('place', $pageID))->name;
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

    $places = [];
    foreach($conducts as $conduct){
      $conductId = $conduct->ID;
      $placeID = get_field('place', $conductId);
      $placeName = get_term($placeID)->name;
      if(!in_array($placeName, $places)){
        $places[] = $placeName;
      }
    }

  ?>

  <section class="text">
    <div class="text__wrapper">
      <h1 style="text-align: center"><?= $pageTitle ?></h1>
      <div>
        <?= $description ?>
      </div>
    </div>
  </section>

  <section class="text">

    <div for="details">
      <h2 class="text__titleLeftWrapper">Touren Details</h2>
    </div>

    <div class="text__wrapper tour__infos">
      <?php
        $infos = [
          'type' => [
            'icon' => '/wp-content/uploads/2021/11/211028-cwe-icons-website-art.png',
            'value' => $type,
            'file' => 'type.svg',
          ],
          'altitude' => [
            'icon' => '/wp-content/uploads/2021/11/211028-cwe-icons-website-hoehe.png',
            'value' => "{$altitudeMin}m – {$altitudeMax}m",
            'file' => 'altitude.svg',
          ],
          'duration' => [
            'icon' => '/wp-content/uploads/2021/11/211028-cwe-icons-website-dauer.png',
            'value' => "{$duration}",
            'file' => 'duration.svg',
          ],
          'place' => [
            'icon' => '/wp-content/uploads/2021/11/211028-cwe-icons-website-ort.png',
            'value' => "{$place}",
            'file' => 'place.svg',
          ],
        ];
      ?>
      <?php foreach($infos as $key => $info): ?>
        <?php
          $src = $info['icon'];
          $file = $info['file'];
          $alt = "{$key}: {$info['value']}";
          $caption = $alt;
          $imgTitle = $info['value'];
        ?>
        <div class="tour__info">
          <div class="tour__infoImageWrapper">
            <canvas width="1" height="1"></canvas>
            <?php include(get_template_directory() . '/includes/' . $file) ?>
          </div>
          <h3 class="tour__infoText"><?= $info['value'] ?></h3>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="text tour__details">
      <div>
        <?= $detailText ?>
      </div>

      <div class="events__additionalWrapper">
        <div class="events__additionalInfo"><h3 class="events__">Durchführungsort<?= count($places) > 1 ? 'e' : '' ?></h3> <?= implode(', ', $places) ?></div>
        <div class="events__additionalInfo"><h3>Höhenmeter</h3> <?= $altitudeMin ?> bis <?= $altitudeMax ?> Meter</div>
        <div class="events__additionalInfo"><h3>Dauer</h3> <?= $duration ?></div>
        <div class="events__additionalInfo"><h3>Kosten</h3>CHF <?= $price ?> pro Person</div>

        <div class="events__additionalInfo events__techniqueWrapper">
          <h3>Technik</h3>
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

        <div class="events__additionalInfo events__fitnessWrapper">
          <h3>Kondition</h3>
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

      <div class="tour__downloads">

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

    <div class="text__wrapper tour__bookingWrapper">
      <div class="tour__dates">
        <?php foreach($conducts as $conduct): ?>
          <?php
            $id = $conduct->ID;
            $maxRegistrations = get_field('maxRegistrations', $id);
            $registrations = get_field('registrations', $id);
            $wcProductId = get_field('woocommerce_product', $id)->ID;
            $placeID = get_field('place', $id);
            $place = get_term($placeID)->name;
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
            <input type="radio" name="tour" id="tour<?= $id ?>" data-wcid="<?= $wcProductId ?>" value="<?= $wcProductId ?>" <?php if($id==$_GET['id']): ?>checked="checked"<?php endif; ?>>
            <label for="tour<?= $id ?>" class="tour__date">
              <span><?= $dateString ?></span>
              <span><?= $place ?></span>
              <span>Noch <?= $maxRegistrations - $registrations ?> freie Plätze</span>
            </label>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="tour__booking">
        <?php
          $wcProduct = get_field('woocommerce_product', $_GET['id']);
          $wcProductId = $wcProduct->ID;
        ?>
        <a id="bookingButton" href="<?= wc_get_cart_url() ?>?add-to-cart=<?= $wcProductId ?>" data-tour="<?= $pageID ?>" data-url="<?= wc_get_cart_url() ?>" target="_self" class="button <?= !$wcProduct ? 'disabled' : '' ?>">Buchen</a>
        <a href="<?= get_permalink(13) ?>" target="_self" class="button button--secondary">Kontakt</a>
      </div>
    </div>
  </section>

  <?php if($images): ?>
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
  <?php endif; ?>

  <?php if($downloads): ?>
    <section class="text tour__gallery gallery">
      <h2 class="text__titleLeftWrapper">
        Dokumente
      </h2>
      <div class="text__wrapper">
        <div class="">
          <?php foreach($downloads as $download): ?>
            <?php
              $title = $download['title'];
              $file = $download['file'];
              $url = $file['url'];
            ?>
            <p><a href="<?= $url ?>" download><?= $title ?></a></p>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

</main>

<?php get_footer(); ?>

<?php
  $filter = get_field('filter');

  $args = [
    'post_type' => 'tour',
    'numberposts' => -1,
    'meta_key' => 'name',
    'orderby' => 'meta_value',
    'order' => 'DESC'
  ];
  $allEvents = get_posts($args);
  $events = $allEvents;
  if(is_int($filter)){
    $args['tax_query'] = [
      [
        'taxonomy' => 'Typ',
        'field'    => 'term_id',
        'terms'    => [$filter],
      ],
    ];
    $events = get_posts($args);
  }

  $eventsOrdered = [];
  $places = [];
  $types = [];
  $altitudes = [];
  foreach($allEvents as $event){
    $eventId = $event->ID;
    $places[] = get_field('place', $eventId);
    $types[] = get_field('type', $eventId);
    $altitudes[] = get_field('altitude', $eventId);
  }
  foreach($events as $event){
    $eventId = $event->ID;
    $dates = get_field('events', $eventId);
    foreach($dates as $date){
      $eventsOrdered[] = [
        $eventId, $date['date']
      ];
    }
  }
  usort($eventsOrdered, function($a, $b){
    return strtotime($a[1]) - strtotime($b[1]);
  });

  $places = array_map(function($placeId){
    $term = get_term($placeId);
    return [$placeId, $term->name];
  }, array_unique($places));
  sort($places);

  $types = array_map(function($type){
    $term = get_term($type);
    return [$type, $term->name];
  }, array_unique($types));
  sort($types);

  sort(array_unique($altitudes));

?>
<section class="text events">
  <div class="text__wrapper events__wrapper">
    <div class="events__filters">
      <div class="events__filter">
        <label for="placeTrigger" class="events__label">Ort</label>
        <input class="events__trigger" type="checkbox" id="placeTrigger" name="placeTrigger">
        <ul class="events__choices">
          <?php foreach($places as $place): ?>
            <input type="radio" value="<?= $place[1] ?>" id="place<?= $place[0] ?>" name="place">
            <label class="events__choice" for="place<?= $place[0] ?>"><?= $place[1] ?></label>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="events__filter">
        <label for="typeTrigger" class="events__label">Sportart</label>
        <input class="events__trigger" type="checkbox" id="typeTrigger" name="typeTrigger">
        <ul class="events__choices">
          <?php foreach($types as $type): ?>
            <input type="radio" value="<?= $type[1] ?>" id="place<?= $type[0] ?>" name="place">
            <label class="events__choice" for="place<?= $type[0] ?>"><?= $type[1] ?></label>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="events__filter">
        <label for="altitudeTrigger" class="events__label">Höhenmeter</label>
        <input class="events__trigger" type="checkbox" id="altitudeTrigger" name="altitudeTrigger">
        <div class="events__raange">
          <input type="number" value="<?= $altitudes[0] ?>" min="<?= $altitudes[0] ?>" max="<?= $altitudes[1] ?>">
          <input type="number" value="<?= $altitudes[1] ?>" min="<?= $altitudes[0] ?>" max="<?= $altitudes[1] ?>">
        </div>
      </div>
    </div>
    <ul class="events__events">
      <?php foreach($eventsOrdered as $event): ?>
        <?php
          $eventId = $event[0];
          $eventUrl = get_the_permalink($eventId);
          $title = get_the_title($eventId);
          $date = $event[1];
          $teaser = get_field('teaser', $eventId);
          $place = get_field('place', $eventId);
          $teaserText = $teaser['teaserText'];
          $img = $teaser['teaaserImage'];
          $caption = $img['caption'];
          $src = $img['sizes']['L'];
          $alt = $img['alt'] ? $img['alt'] : $img['name'];
          $imgTitle = $img['title'] ? $img['title'] : $img['name'];
          $srcset = wp_get_attachment_image_srcset($img['ID']);
        ?>
        <a href="<?= $eventUrl ?>" class="events__event" target="_self">
          <div class="events__textWrapper">
            <h4><?= $date ?></h4>
            <h3><?= $title ?> – <?= get_term($place)->name ?></h3>
            <p class="events__teaserText"><?= $teaserText ?></p>
            <span class="button">Details</span>
          </div>
          <div class="events__imageWrapper">
            <img class="events__image" loading="lazy" src="<?= $src ?>" title="<?= $imgTitle ?>" alt="<?= $alt ?>" srcset="<?= $srcset ?>">
          </div>
        </a>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

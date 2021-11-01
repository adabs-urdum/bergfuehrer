<?php
  $activeType = get_field('filter');

  $conducts = get_posts([
    'post_type' => 'conduct',
    'numberposts' => -1,
    'meta_key' => 'conductDate',
    'orderby' => 'meta_value',
    'order' => 'ASC',
  ]);

  $altitudes = [];
  $prices = [];
  $dates = [];
  $techniques = [];
  $fitnesses = [];

  foreach($conducts as $conduct){
    $id = $conduct->ID;
    $date = get_field('conductDate', $id);
    $datetime = strtotime($date);
    $tourID = get_field('tour', $id)->ID;
    $place = get_field('place', $tourID);
    $altitude = get_field('altitude', $tourID);
    $price = get_field('price', $tourID);
    $technique = get_field('technique', $tourID);
    $fitness = get_field('fitness', $tourID);

    $type = get_field('type', $tourID);
    if($datetime >= strtotime(date('d.m.Y'))){
      if(!in_array($altitude, $altitudes)){
        $altitudes[] = $altitude;
      }

      if(!in_array($price, $prices)){
        $prices[] = $price;
      }

      if(!in_array($technique, $techniques)){
        $techniques[] = $technique;
      }

      if(!in_array($fitness, $fitnesses)){
        $fitnesses[] = $fitness;
      }

      if(!array_key_exists($datetime, $dates)){
        $dates[$datetime] = $date;
      }
    }
  }

  $places = [];
  foreach(get_terms([
    'taxonomy' => 'Ortschaft',
    'hide_empty' => false,
  ]) as $place){
    $places[$place->term_id] = $place->name;
  }
  asort($places);

  $types = [];
  foreach(get_terms([
    'taxonomy' => 'Typ',
    'hide_empty' => false,
  ]) as $type){
    $types[$type->term_id] = $type->name;
  }
  asort($types);

  asort($prices);
  asort($altitudes);
  asort($techniques);
  asort($fitnesses);

?>

<section class="text events">
  <div class="text__wrapper events__wrapper">
    <div class="events__filters" data-type="<?= $activeType ?>">
      <label class="mobile_only button" for="filterTrigger">Filter</label>
      <input type="checkbox" name="filterTrigger" id="filterTrigger">
      <div class="events__filtersWrapper">
        <div class="events__filter">
          <input class="events__trigger" type="checkbox" id="placeTrigger" name="filterTrigger">
          <label for="placeTrigger" class="events__label">Ort</label>
          <div class="events__lower">
            <ul class="events__choices">
              <?php foreach($places as $placeID => $place): ?>
                <li>
                  <input type="checkbox" value="<?= $placeID ?>" id="place<?= $placeID ?>" name="place">
                  <label class="events__choice" for="place<?= $placeID ?>">
                    <span><?= $place ?></span>
                  </label>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
        <div class="events__filter">
          <input class="events__trigger" type="checkbox" id="typeTrigger" name="filterTrigger">
          <label for="typeTrigger" class="events__label">Sportart</label>
          <div class="events__lower">
            <ul class="events__choices">
              <?php foreach($types as $typeID => $type): ?>
                <?php
                  $checked = $typeID == $activeType ? 'checked="checked"' : '';
                ?>
                <li>
                  <input type="checkbox" value="<?= $typeID ?>" id="type<?= $typeID ?>" name="type" <?= $checked ?>>
                  <label class="events__choice" for="type<?= $typeID ?>">
                    <span><?= $type ?></span>
                  </label>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
        <div class="events__filter">
          <input class="events__trigger" type="checkbox" id="altitudeTrigger" name="filterTrigger">
          <label for="altitudeTrigger" class="events__label">Höhenmeter</label>
          <div class="events__lower">
            <div class="events__rangeContainer">
              <?php
                $altitudes = array_values($altitudes);
                $altitudeMin = $altitudes[0];
                $altitudeMax = array_reverse($altitudes)[0];
              ?>
              <div class="events__rangeNumbers">
                <input type="number" class="min" name="altMin" value="<?= $altitudeMin ?>" min="<?= $altitudeMin ?>" max="<?= $altitudeMax ?>">
                <input type="number" class="max" name="altMax" value="<?= $altitudeMax ?>" min="<?= $altitudeMin ?>" max="<?= $altitudeMax ?>">
              </div>
              <div class="events__rangeSlider"></div>
            </div>
          </div>
        </div>
        <div class="events__filter">
          <input class="events__trigger" type="checkbox" id="priceTrigger" name="filterTrigger">
          <label for="priceTrigger" class="events__label">Preis</label>
          <div class="events__lower">
            <div class="events__rangeContainer">
              <?php
                $prices = array_values($prices);
                $priceMin = $prices[0];
                $priceMax = array_reverse($prices)[0];
              ?>
              <div class="events__rangeNumbers">
                <input type="number" class="min" name="priceMin" value="<?= $priceMin ?>" min="<?= $priceMin ?>" max="<?= $priceMax ?>">
                <input type="number" class="max" name="priceMax" value="<?= $priceMax ?>" min="<?= $priceMin ?>" max="<?= $priceMax ?>">
              </div>
              <div class="events__rangeSlider">
                <div class="events__rangeBullet events__rangeBullet--min"></div>
                <div class="events__rangeBullet events__rangeBullet--max"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="events__filter">
          <input class="events__trigger" type="checkbox" id="fitnessTrigger" name="fitnessTrigger">
          <label for="fitnessTrigger" class="events__label">Kondition</label>
          <div class="events__lower">
            <div class="events__rangeContainer">
              <?php
                $fitnesses = array_values($fitnesses);
                $fitnessMin = $fitnesses[0];
                $fitnessMax = array_reverse($fitnesses)[0];
              ?>
              <div class="events__rangeNumbers">
                <input type="number" class="min" name="fitnessMin" value="<?= $fitnessMin ?>" min="<?= $fitnessMin ?>" max="<?= $fitnessMax ?>">
                <input type="number" class="max" name="fitnessMax" value="<?= $fitnessMax ?>" min="<?= $fitnessMin ?>" max="<?= $fitnessMax ?>">
              </div>
              <div class="events__rangeSlider">
                <div class="events__rangeBullet events__rangeBullet--min"></div>
                <div class="events__rangeBullet events__rangeBullet--max"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="events__filter">
          <input class="events__trigger" type="checkbox" id="techniqueTrigger" name="techniqueTrigger">
          <label for="techniqueTrigger" class="events__label">Technik</label>
          <div class="events__lower">
            <div class="events__rangeContainer">
              <?php
                $techniques = array_values($techniques);
                $techniqueMin = $techniques[0];
                $techniqueMax = array_reverse($techniques)[0];
              ?>
              <div class="events__rangeNumbers">
                <input type="number" class="min" name="techniqueMin" value="<?= $techniqueMin ?>" min="<?= $techniqueMin ?>" max="<?= $techniqueMax ?>">
                <input type="number" class="max" name="techniqueMax" value="<?= $techniqueMax ?>" min="<?= $techniqueMin ?>" max="<?= $techniqueMax ?>">
              </div>
              <div class="events__rangeSlider">
                <div class="events__rangeBullet events__rangeBullet--min"></div>
                <div class="events__rangeBullet events__rangeBullet--max"></div>
              </div>
            </div>
          </div>
        </div>
        <!-- <div class="events__filter">
          <input class="events__trigger" type="checkbox" id="dateTrigger" name="filterTrigger">
          <label for="dateTrigger" class="events__label">Datum</label>
          <div class="events__lower">
            <div class="--events__rangeContainer">
              <?php
                $dateMinTime = array_key_first($dates);
                $dateMin = $dates[$dateMinTime];
                $dateMaxTime = array_key_last($dates);
                $dateMax = $dates[$dateMaxTime];
              ?>
              <div class="events__rangeNumbers">
                <input type="text" name="dateMin" data-time="<?= $dateMinTime ?>" value="<?= $dateMin ?>">
                <input type="text" name="dateMax" data-time="<?= $dateMaxTime ?>" value="<?= $dateMax ?>">
              </div>
              <div class="events__rangeSlider">
                <div class="events__rangeBullet events__rangeBullet--min"></div>
                <div class="events__rangeBullet events__rangeBullet--max"></div>
              </div>
            </div>
          </div>
        </div> -->
      </div>
    </div>
    <div class="events__loaderWrapper">
      <div class="events__loader"><div></div><div></div><div></div><div></div></div>
    </div>
    <ul class="events__events">
    </ul>
  </div>
</section>

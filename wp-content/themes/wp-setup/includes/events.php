<section class="text events">
  <?php if(strlen($titleLeft)): ?>
    <h2 class="text__titleLeftWrapper">
      <?= $titleLeft ?>
    </h2>
  <?php endif; ?>
  <div class="text__wrapper events__wrapper">
    <?php if($hasFilters): ?>
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
            <input class="events__trigger" type="checkbox" id="fitnessTrigger" name="filterTrigger">
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
            <input class="events__trigger" type="checkbox" id="techniqueTrigger" name="filterTrigger">
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
    <?php else: ?>
      <input type="hidden" id="numberposts" value="<?= $numberposts ?>">
    <?php endif; ?>
    <div class="events__loaderWrapper">
      <div class="events__loader"><div></div><div></div><div></div><div></div></div>
    </div>
    <ul class="events__events">
    </ul>
  </div>
</section>

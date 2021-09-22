<?php
  $tourID = intval($_GET['event']);
  $tourName = get_field('name', $tourID);
  $price = get_field('price', $tourID);

  $conductID = intval($_GET['date']);
  $date = get_field('conductDate', $conductID);
  $conductTourID = get_field('tour', $conductID)->ID;
  $registrations = get_field('registrations', $conductID);
  $registrations = is_array($registrations) ? array_sum(array_map(function($registration){
    return $registration['people'];
  }, $registrations)) : 0;
  $maxRegistrations = get_field('maxRegistrations', $conductID);

  $getParamsMatch = false;
  if($conductTourID === $tourID){
    $getParamsMatch = true;
  }
?>

<section class="bookingform">
  <div class="text__wrapper">
    <?php if($getParamsMatch): ?>
      <h1>Buchungsformular</h1>
      <div>
        <p><span><?= $tourName ?></span></p>
        <p><?= $date ?></p>
        <p>CHF <?= $price ?> pro Person</p>
      </div>
      <div>
        <form action="" id="bookingform">
          <label for="name">
            <span>Vorname</span>
            <input type="text" id="name" name="name">
          </label>
          <label for="lastname">
            <span>Nachname</span>
            <input type="text" id="lastname" name="lastname">
          </label>
          <label for="email">
            <span>E-Mail</span>
            <input type="email" id="email" name="email">
          </label>
          <label for="phone">
            <span>Telefon</span>
            <input type="tel" id="phone" name="phone">
          </label>
          <label for="streetnumber">
            <span>Strasse, Nr.</span>
            <input type="text" id="streetnumber" name="streetnumber">
          </label>
          <label for="zip">
            <span>PLZ</span>
            <input type="text" id="zip" name="zip">
          </label>
          <label for="town">
            <span>Ort</span>
            <input type="text" id="town" name="town">
          </label>
          <label for="number">
            <span>Anzahl</span>
            <select name="number" id="number">
              <?php for ($i=1; $i <= ($maxRegistrations - $registrations); $i++): ?>
                <option value="<?= $i ?>"><?= $i ?></option>
              <?php endfor; ?>
            </select>
          </label>
          <input type="hidden" name="event" value="<?= $tourID ?>">
          <input type="hidden" name="conduct" value="<?= $conductID ?>">
          <input type="submit" class="button" value="Kostenpflichtig Buchen">
        </form>
      </div>
    <?php else: ?>
      <h1>Verarbeitungsfehler. Bitte versuche es nochmal.</h1>
    <?php endif; ?>
  </div>
</section>

<?php

  $conducts = get_posts([
    'post_type' => 'conduct',
    'numberposts' => -1,
    'meta_key' => 'conductDate',
    'orderby' => 'meta_value',
    'order' => 'ASC',
  ]);

  $activeType = get_field('filter');
  $altitudes = [];
  $prices = [];
  $dates = [];
  $techniques = [];
  $fitnesses = [];
  $hasFilters = true;

  foreach($conducts as $conduct){
    $id = $conduct->ID;
    $date = get_field('conductDate', $id);
    $datetime = strtotime($date);
    $tourID = get_field('tour', $id)->ID;
    $place = get_field('place', $tourID);
    $altitudesGroup = get_field('altitudes', $tourID);
    $altitudeMin = $altitudesGroup['min'];
    $altitudeMax = $altitudesGroup['max'];
    $price = get_field('price', $tourID);
    $technique = get_field('technique', $tourID);
    $fitness = get_field('fitness', $tourID);

    $type = get_field('type', $tourID);
    if($datetime >= strtotime(date('d.m.Y'))){
      if(!in_array($altitudeMin, $altitudes)){
        $altitudes[] = $altitudeMin;
      }

      if(!in_array($altitudeMax, $altitudes)){
        $altitudes[] = $altitudeMax;
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

  include(get_template_directory() . '/includes/events.php');
?>

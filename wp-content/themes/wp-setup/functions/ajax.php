<?php

function getconducts(WP_REST_Request $request) {
  // verify_general_nonce();

  $data = json_decode($request->get_body());

  $activeTypes = $data->types;
  if(count($activeTypes) == 0){
    $activeTypes = false;
  }

  $activePlaces = $data->places;
  if(count($activePlaces) == 0){
    $activePlaces = false;
  }

  $altMin = $data->altMin;
  $altMax = $data->altMax;
  $priceMin = $data->priceMin;
  $priceMax = $data->priceMax;
  $dateMin = strtotime($data->dateMin);
  $dateMax = strtotime($data->dateMax);

  $conducts = get_posts([
    'post_type' => 'conduct',
    'numberposts' => -1,
    'meta_key' => 'conductDate',
    'orderby' => 'meta_value',
    'order' => 'ASC',
  ]);

  $orderedConducts = [];

  foreach($conducts as $conduct){
    $id = $conduct->ID;
    $registrations = get_field('registrations', $id);
    $registrations = is_array($registrations) ? array_sum(array_map(function($registration){
      return $registration['people'];
    }, $registrations)) : 0;
    $date = get_field('conductDate', $id);
    $datetime = strtotime($date);
    $tourID = get_field('tour', $id)->ID;
    $place = get_field('place', $tourID);
    $altitude = get_field('altitude', $tourID);
    $price = get_field('price', $tourID);

    $type = get_field('type', $tourID);
    if($datetime >= strtotime(date('d.m.Y'))){
      $orderedConducts[] = [
        'id' => $id,
        'tour' => $tourID,
        'type' => $type,
        'date' => $date,
        'datetime' => $datetime,
        'guide' => get_field('guide', $id)->ID,
        'maxRegistrations' => get_field('maxRegistrations', $id),
        'registrations' => $registrations,
        'place' => $place,
        'price' => $price,
        'altitude' => $altitude,
      ];
    }
  }

  $markup = '';
  $counter = 1;

  foreach($orderedConducts as $key => $conduct):
    $eventId = $conduct['tour'];
    $eventUrl = get_the_permalink($eventId);
    $title = get_the_title($eventId);
    $type = get_term($conduct['type'])->name;
    $date = $conduct['date'];
    $datetime = $conduct['datetime'];
    $teaser = get_field('teaser', $eventId);
    $place = get_field('place', $eventId);
    $technique = floatval(get_field('technique', $eventId));
    $fitness = floatval(get_field('fitness', $eventId));
    $altitude = $conduct['altitude'];
    $price = $conduct['price'];
    $difficultyMax = 3;
    $teaserText = $teaser['teaserText'];
    $img = $teaser['teaaserImage'];
    $caption = $img['caption'];
    $src = $img['sizes']['L'];
    $alt = $img['alt'] ? $img['alt'] : $img['name'];
    $imgTitle = $img['title'] ? $img['title'] : $img['name'];
    $srcset = wp_get_attachment_image_srcset($img['ID']);


    if($activeTypes && !in_array($conduct['type'], $activeTypes)){
      continue;
    }
    else if($activePlaces && !in_array($conduct['place'], $activePlaces)){
      continue;
    }
    else if($altitude < $altMin || $altitude > $altMax){
      continue;
    }
    else if($price < $priceMin || $price > $priceMax){
      continue;
    }
    else if($datetime < $dateMin || $datetime > $dateMax){
      continue;
    }
    else if($conduct['maxRegistrations'] - $conduct['registrations'] < 1){
      continue;
    }

    $techniqueMarkup = '';
    for($i=0; $i < $difficultyMax; $i++):
      $class = $i + 1 - $technique < 1 ? 'full full--' . ($i + 1 - $technique) * 10 : 'empty';
      $techniqueMarkup .= '<span class="events__icon ' . $class . '"></span>';
    endfor;

    $fitnessMarkup = '';
    for ($i=0; $i < $difficultyMax; $i++):
      $class = $i + 1 - $fitness < 1 ? 'full full--' . ($i + 1 - $fitness) * 10 : 'empty';
      $fitnessMarkup .= '<span class="events__icon ' . $class . '"></span>';
    endfor;

    $markup .= '
        <a href="' . $eventUrl . '?id=' . $conduct['id'] . '" class="events__event" target="_self" style="animation-delay:' . $counter * 0.2 . 's">
          <div class="events__textWrapper">
            <h4>' . $type . ' - ' . $date . '</h4>
            <h3>' . $title . ' – ' . get_term($place)->name . '</h3>
            <p class="events__teaserText">' . $teaserText . '</p>
            <div class="events__difficultyWrapper">
              <div class="events__techniqueWrapper">
                <span>Technik</span>
                <span>
                  <span class="events__icons">
                    ' . $techniqueMarkup . '
                  </span>
                </span>
              </div>
              <div class="events__fitnessWrapper">
                <span>Kondition</span>
                <span>
                  <span class="events__icons">
                    ' . $fitnessMarkup . '
                  </span>
                </span>
              </div>
            </div>
            <span class="button">Details</span>
          </div>
          <div class="events__imageWrapper">
            <img class="events__image" loading="lazy" src="' . $src . '" title="' . $imgTitle . '" alt="' . $alt . '" srcset="' . $srcset . '">
          </div>
        </a>';

      $counter += 1;
  endforeach;

  if(strlen($markup) == 0){
    $markup = '<h2>Leider keine Treffer.</h2>';
  }

  return [
    'data' => $data,
    'markup' => $markup
  ];
}
add_action('rest_api_init', function ($server) {
    register_rest_route('api', '/conducts', [
        'methods' => 'POST',
        'callback' => 'getconducts',
    ]);
});

function setbooking(WP_REST_Request $request) {
  // verify_general_nonce();

  $data = json_decode($request->get_body());

  $conductID = intval($data->conduct);
  $name = $data->name;
  $lastname = $data->lastname;
  $number = intval($data->number);
  $phone = $data->phone;
  $street = $data->street;
  $zip = $data->zip;
  $town = $data->town;
  $email = $data->email;

  $participant = [
    'firstname' => $name,
    'lastname' => $lastname,
    'people' => $number,
    'email' => $email,
    'telephone' => $phone,
    'street' => $street,
    'zip' => $zip,
    'city' => $town,
  ];

  $success = add_row('registrations', $participant, $conductID);

  return [
    'data' => $data,
    'success' => $success,
  ];
}
add_action('rest_api_init', function ($server) {
    register_rest_route('api', '/booking', [
        'methods' => 'POST',
        'callback' => 'setbooking',
    ]);
});

// function loginForm() {
//   verify_general_nonce();

//   $mail = htmlspecialchars($_GET['mail']);
//   $pass = htmlspecialchars($_GET['pass']);

//   $user = wp_signon([
//     'user_login'    => $mail,
//     'user_password' => $pass,
//     'remember'      => true
//   ]);
//   wp_set_current_user($user);



//   echo json_encode(['data' => $_GET, 'redirect' => get_permalink(38), 'get_current_user_id' => get_current_user_id(), 'user' => $user->ID]);

//   wp_die();
// }
// add_action('wp_ajax_loginForm', 'loginForm');
// add_action('wp_ajax_nopriv_loginForm', 'loginForm' );


// /**
//  * Verify the submitted nonce
//  */
function verify_general_nonce(){
    $nonce = isset( $_SERVER['HTTP_X_CSRF_TOKEN'] )
        ? $_SERVER['HTTP_X_CSRF_TOKEN']
       : '';
    if ( !wp_verify_nonce( $nonce, 'ajaxNonce' ) ) {
        die();
    }
}

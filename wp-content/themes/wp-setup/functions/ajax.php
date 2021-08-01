<?php

// function subscribe(WP_REST_Request $request) {
//   // verify_general_nonce();

//   $data = json_decode($request->get_body());

//   $name = htmlspecialchars($data->name);
//   $lastname = htmlspecialchars($data->lastname);
//   $city = htmlspecialchars($data->city);
//   $mail = htmlspecialchars($data->mail);
//   $pass = htmlspecialchars($data->pass);
//   $street = htmlspecialchars($data->street);
//   $repeat = $data->repeat == 'true' ? true : false;

//   if(!$repeat){
//     $user = wp_create_user($mail, $pass, $mail);
//   }

//   $user = wp_signon([
//     'user_login'    => $mail,
//     'user_password' => $pass,
//     'remember'      => true
//   ]);
//   wp_set_current_user($user);

//   $user = get_current_user_id();

//   update_field('userName', $name, 'user_' . $user);
//   update_field('userLastname', $lastname, 'user_' . $user);
//   update_field('userCity', $city, 'user_' . $user);
//   update_field('userStreet', $street, 'user_' . $user);
//   update_field('userMail', $mail, 'user_' . $user);

//   if($data->payment->paymentIntent->status === 'succeeded'){
//     $updateSuccess = update_field('userPaid', true, 'user_' . $user);
//   }



//   echo json_encode([
//     'user' => $user,
//     'redirect' => get_permalink(38),
//     // '$repeat' => $repeat,
//     // '$data->repeat' => $data->repeat,
//     'updateSuccess' => $updateSuccess,
//     '$data->payment->paymentIntent->status' => $data->payment->paymentIntent->status
//   ]);
// }
// add_action('rest_api_init', function ($server) {
//     register_rest_route('api', '/subscription', [
//         'methods' => 'POST',
//         'callback' => 'subscribe',
//     ]);
// });

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
// function verify_general_nonce(){
//     $nonce = isset( $_SERVER['HTTP_X_CSRF_TOKEN'] )
//         ? $_SERVER['HTTP_X_CSRF_TOKEN']
//        : '';
//     if ( !wp_verify_nonce( $nonce, 'ajaxNonce' ) ) {
//         die();
//     }
// }

<?php

function sendEmailCustomerCallback( $form_data ){
    $to = $form_data['fields_by_key']['email_3']['value'];
    $subject = 'This is the subject stuff';
    $headers = ['Content-Type: text/html; charset=UTF-8'];

    $message = [];
    foreach($form_data['fields'] as $field){
      if($field['label'] != 'Send'){
        $message[$field['label']] = $field['value'];
      }
    }

    $messageFormatted = [];
    foreach($message as $k => $v){
      $messageFormatted[] = sprintf('<tr><td>%s: </td><td>%s</td></tr>',$k,$v);
    }

    $message = implode('', $messageFormatted);
    $message = '<table><tbody>' . $message . '</tbody></table>';

    $message = apply_filters('wp_mail_original_content', $message);

    wp_mail($to, $subject, $message, $headers);
}
add_action( 'sendEmailCustomer', 'sendEmailCustomerCallback' );

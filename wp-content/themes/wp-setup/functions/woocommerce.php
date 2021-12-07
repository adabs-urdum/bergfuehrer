<?php
  function add_woocommerce_support() {
    add_theme_support( 'woocommerce', array(
    'thumbnail_image_width' => 580,
    'single_image_width'    => 1200,
    'product_grid'          => array(
      'default_rows'    => 3,
      'min_rows'        => 1,
      'max_rows'        => 3,
      'default_columns' => 3,
      'min_columns'     => 3,
      'max_columns'     => 4,
    ),
    ) );
  }
  add_action( 'after_setup_theme', 'add_woocommerce_support' );

  // function on_woocommerce_payment_complete( $order_id ) {
  //     write_log("Payment has been received for order $order_id");
  // }
  // add_action( 'woocommerce_payment_complete', 'on_woocommerce_payment_complete', 10, 1 );

  // function on_order_status_completed($order_id){
  //   write_log('on_order_status_completed');
  // }
  // add_action( 'woocommerce_order_status_completed', 'on_order_status_completed', 10, 1);


  /**
  * Auto Complete all WooCommerce orders.
  */
  add_action( 'woocommerce_thankyou', 'custom_woocommerce_auto_complete_order' );
  function custom_woocommerce_auto_complete_order( $order_id ) {
      if ( ! $order_id ) {
          return;
      }

      $order = wc_get_order( $order_id );
      $order->update_status( 'completed' );

      $orderId = $order_id;
      $order = new WC_Order($orderId);
      $address = $order->get_address();
      $items = array_map(function($item){
        $id = $item->get_product_id();
        $quantity = $item->get_quantity();
        return [
          'id' => $id,
          'quantity' => $quantity,
        ];
      }, $order->get_items());

      foreach($items as $item){
        $id = $item['id'];
        $quantity = $item['quantity'];
        $conductId = get_field('conduct', $id)->ID;
        $registration = [
          'firstname' => $address['first_name'],
          'lastname' => $address['last_name'],
          'email' => $address['email'],
          'telephone' => $address['phone'],
          'street' => "{$address['address_1']} {$address['address_2']}",
          'zip' => $address['postcode'],
          'city' => $address['city'],
          'people' => $quantity,
          'paid' => true,
        ];

        add_row('registrations', $registration, $conductId);
      }
  }


  function attach_to_wc_emails ( $attachments , $email_id, $object ) {
    // $email_ids = array( 'new_order', 'customer_processing_order', 'customer_invoice' );
    $email_ids = array( 'customer_completed_order');
    write_log('customer_completed_order');
    if ( in_array ( $email_id, $email_ids ) ) {
      // Avoiding errors and problems
      if ( ! is_a( $object, 'WC_Order' ) || ! isset( $email_id ) ) {
          return $attachments;
      }
      $order = $object;

      $items = array_map(function($item){
        $id = $item->get_product_id();
        return [
          'id' => $id,
        ];
      }, $order->get_items());

      foreach($items as $item){
        $id = $item['id'];
        $tourId = get_field('tour', $id)->ID;
        $downloads = get_field('downloads', $tourId);

        foreach ($downloads as $download) {
          $file = $download['file'];
          if ($file) {
            $path = $file['url'];
            $attachments[] = $path;
          }
        }
      }
    }
    return $attachments;
  }
  add_filter( 'woocommerce_email_attachments', 'attach_to_wc_emails', 10, 3);

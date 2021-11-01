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

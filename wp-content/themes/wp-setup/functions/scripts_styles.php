<?php

//----------------------------------------------------------
function my_theme_styles() {
  wp_enqueue_style('styles', get_template_directory_uri() . '/dist/css/styles.min.css', false, '22');
}
add_action( 'wp_enqueue_scripts', 'my_theme_styles' );
//----------------------------------------------------------

//----------------------------------------------------------
function my_theme_scripts() {
  wp_dequeue_script('jquery');
  wp_dequeue_script('jquery-core');
  wp_dequeue_script('jquery-migrate');
  // wp_enqueue_script('jquery', false, array(), null, true);
  // wp_enqueue_script('jquery-core', false, array(), null, true);
  // wp_enqueue_script('jquery-migrate', false, array(), null, true);
  // wp_enqueue_script('functions', get_template_directory_uri() . '/dist/js/functions.min.js', array( 'jquery' ), '1', true);
  wp_enqueue_script('functions', get_template_directory_uri() . '/dist/js/functions.min.js', null, '10', true);
  wp_localize_script('functions', 'ajaxObject', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ),));
  wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_enqueue_scripts', 'my_theme_scripts' );
//----------------------------------------------------------

//----------------------------------------------------------
function override_acf_styles() {
  wp_enqueue_style('styles', get_template_directory_uri() . '/acf-admin-styles.css', false, '2');
}
add_action( 'admin_enqueue_scripts', 'override_acf_styles', 100 );
//----------------------------------------------------------


// Enqueue block editor CSS
//----------------------------------------------------------
function add_block_editor_assets() {
  $blockPath = '/dist/css/blocks.min.css';

  wp_enqueue_style(
      'add_block_editor_assets',
      get_template_directory_uri() . $blockPath,
      [  ],
      filemtime( get_template_directory() . $blockPath )
  );

}
add_action( 'enqueue_block_editor_assets', 'add_block_editor_assets' );
//----------------------------------------------------------

// Styles-dropdown for TinyMCE-editor
//----------------------------------------------------------
function my_mce_buttons_2( $buttons ) {
  array_unshift( $buttons, 'styleselect' );
  return $buttons;
}
add_filter('mce_buttons_2', 'my_mce_buttons_2');
//----------------------------------------------------------

// MCE Editor Custom Styles
//----------------------------------------------------------
function my_mce_before_init_insert_formats( $init_array ) {
  $style_formats = [
    [
      'title' => 'Button',
      'selector' => 'a',
      'classes' => 'button'
    ]
  ];


  $init_array['style_formats'] = json_encode( $style_formats );
  return $init_array;
}
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );
// add_editor_style( 'editor-style.css' );
add_editor_style( get_template_directory_uri().'/dist/css/editor.min.css' );
//----------------------------------------------------------

// Add admin.min.css to admin
//----------------------------------------------------------
function admin_style() {
  wp_enqueue_style('admin-styles', get_template_directory_uri().'/dist/css/admin.min.css?v=1');
}
add_action('admin_enqueue_scripts', 'admin_style');
//----------------------------------------------------------

// Add login.min.css to admin
//----------------------------------------------------------
function login_style() {
    wp_enqueue_style( 'login-styles', get_stylesheet_directory_uri() . '/dist/css/admin.min.css?v=1' );
}
add_action( 'login_enqueue_scripts', 'login_style' );
//----------------------------------------------------------

// remove dns-prefetch
//----------------------------------------------------------
remove_action( 'wp_head', 'wp_resource_hints', 2 );
//----------------------------------------------------------


// remove wp blocks stylesheets
//----------------------------------------------------------
function smartwp_remove_wp_block_library_css(){
 wp_dequeue_style( 'wp-block-library' );
 wp_dequeue_style( 'wp-block-library-theme' );
 wp_dequeue_style( 'wc-block-style' );
}
add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );
//----------------------------------------------------------


// Disable REST API link tag
//----------------------------------------------------------
remove_action('wp_head', 'rest_output_link_wp_head', 10);
//----------------------------------------------------------

// Disable oEmbed Discovery Links
//----------------------------------------------------------
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
//----------------------------------------------------------

// Disable REST API link in HTTP headers
//----------------------------------------------------------
remove_action('template_redirect', 'rest_output_link_header', 11, 0);
//----------------------------------------------------------


?>

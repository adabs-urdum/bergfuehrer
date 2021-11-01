<?php

if ( ! function_exists('write_log')) {
   function write_log ( $log )  {
      if ( is_array( $log ) || is_object( $log ) ) {
         error_log( print_r( $log, true ) );
      } else {
         error_log( $log );
      }
   }
}

// Admin link to adabs
//----------------------------------------------------------
function adabs_link( $wp_admin_bar ) {
  $args = array(
    'id'    => '',
    'title' => '',
    'href'  => 'https://adabs.ch',
    'meta'  => array( 'target' => '_blank', 'rel' => 'noopener' ),
    'parent' => 'top-secondary'
  );
	$wp_admin_bar->add_node( $args );
}
add_action( 'admin_bar_menu', 'adabs_link', 999 );
//----------------------------------------------------------

// Register title tag
//----------------------------------------------------------
add_theme_support('title-tag');
//----------------------------------------------------------

//Download Plugins without providing FTP Info
// ----------------------------------------------------------
define('FS_METHOD', 'direct');
//----------------------------------------------------------

include_once( get_stylesheet_directory() . '/functions/scripts_styles.php' );
include_once( get_stylesheet_directory() . '/functions/menu.php' );
include_once( get_stylesheet_directory() . '/functions/disable.php' );
include_once( get_stylesheet_directory() . '/functions/image_sizes.php' );
include_once( get_stylesheet_directory() . '/functions/custom_posttypes.php' );
include_once( get_stylesheet_directory() . '/functions/options.php' );
include_once( get_stylesheet_directory() . '/functions/login.php' );
include_once( get_stylesheet_directory() . '/functions/wp_mail.php' );
include_once( get_stylesheet_directory() . '/functions/ninja_forms.php' );
include_once( get_stylesheet_directory() . '/functions/blocks.php' );
include_once( get_stylesheet_directory() . '/functions/ajax.php' );
include_once( get_stylesheet_directory() . '/functions/woocommerce.php' );

?>

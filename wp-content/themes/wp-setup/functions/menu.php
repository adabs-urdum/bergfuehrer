<?php

// Register menu
//----------------------------------------------------------
function register_menu() {
  register_nav_menu( 'menu_main', 'Hauptmenü' );
}
add_action( 'after_setup_theme', 'register_menu' );
//----------------------------------------------------------

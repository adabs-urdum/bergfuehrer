<?php

// Register Custom Post Types
//----------------------------------------------------------
function register_custom_post_types() {

    $labels = array(
        'name'                => __( 'Mitarbeiter', 'wp-setup' ),
        'singular_name'       => __( 'Mitarbeiter', 'wp-setup' ),
        'menu_name'           => __( 'Mitarbeiter', 'wp-setup' ),
        'parent_item_colon'   => __( 'Mitarbeiter', 'wp-setup' ),
        'all_items'           => __( 'Alle Mitarbeiter', 'wp-setup' ),
        'view_item'           => __( 'Mitarbeiter ansehen', 'wp-setup' ),
        'add_new_item'        => __( 'Mitarbeiter hinzufügen', 'wp-setup' ),
        'add_new'             => __( 'Neue hinzufügen', 'wp-setup' ),
        'edit_item'           => __( 'Mitarbeiter bearbeiten', 'wp-setup' ),
        'update_item'         => __( 'Mitarbeiter aktualisieren', 'wp-setup' ),
        'search_items'        => __( 'Mitarbeiter suchen', 'wp-setup' ),
        'not_found'           => __( 'Nicht gefunden', 'wp-setup' ),
        'not_found_in_trash'  => __( 'Nicht im Papierkorb gefunden', 'wp-setup' ),
    );
    $args = array(
        'label'               => __( 'team', 'wp-setup' ),
        'description'         => __( 'Mitarbeiter Detail Info', 'wp-setup' ),
        'labels'              => $labels,
        // 'supports'            => array('editor'),
        // 'supports'            => array('title'),
        'supports'            => false,
        'taxonomies'          => [],
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        // 'show_in_rest'        => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-universal-access',
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'team', $args );

    $labels = array(
        'name'                => __( 'Touren', 'wp-setup' ),
        'singular_name'       => __( 'Tour', 'wp-setup' ),
        'menu_name'           => __( 'Touren', 'wp-setup' ),
        'parent_item_colon'   => __( 'Touren', 'wp-setup' ),
        'all_items'           => __( 'Alle Touren', 'wp-setup' ),
        'view_item'           => __( 'Touren ansehen', 'wp-setup' ),
        'add_new_item'        => __( 'Tour hinzufügen', 'wp-setup' ),
        'add_new'             => __( 'Neue hinzufügen', 'wp-setup' ),
        'edit_item'           => __( 'Tour bearbeiten', 'wp-setup' ),
        'update_item'         => __( 'Tour aktualisieren', 'wp-setup' ),
        'search_items'        => __( 'Tour suchen', 'wp-setup' ),
        'not_found'           => __( 'Nicht gefunden', 'wp-setup' ),
        'not_found_in_trash'  => __( 'Nicht im Papierkorb gefunden', 'wp-setup' ),
    );
    $args = array(
        'label'               => __( 'tour', 'wp-setup' ),
        'description'         => __( 'Tour Detail Info', 'wp-setup' ),
        'labels'              => $labels,
        // 'supports'            => array('editor'),
        // 'supports'            => array('title'),
        'supports'            => false,
        'taxonomies'          => [],
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        // 'show_in_rest'        => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-universal-access',
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'tour', $args );

    flush_rewrite_rules();

}

add_action( 'init', 'register_custom_post_types', 0 );
//----------------------------------------------------------


// Register custom taxonomy
//----------------------------------------------------------
function registerEmployeeCategory() {

  $labels = [
    'name' => _x( 'Sportarten', 'taxonomy general name' ),
    'singular_name' => _x( 'Sportart', 'taxonomy singular name' ),
    'search_items' =>  __( 'Sportarten durchsuchen' ),
    'all_items' => __( 'Alle Sportarten' ),
    'parent_item' => __( 'Übergeordnete Sportart' ),
    'parent_item_colon' => __( 'Parent Sportart:' ),
    'edit_item' => __( 'Sportart bearbeiten' ),
    'update_item' => __( 'Sportart aktualisieren' ),
    'add_new_item' => __( 'Sportart hinzufügen' ),
    'new_item_name' => __( 'Neue Sportart' ),
    'menu_name' => __( 'Sportarten' ),
  ];

  register_taxonomy('Typ',['tour'], [
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => false,
    'query_var' => true,
    'rewrite' => ['slug' => 'type'],
  ]);

  $labels = [
    'name' => _x( 'Orte', 'taxonomy general name' ),
    'singular_name' => _x( 'Ort', 'taxonomy singular name' ),
    'search_items' =>  __( 'Orte durchsuchen' ),
    'all_items' => __( 'Alle Orte' ),
    'parent_item' => __( 'Übergeordneter Ort' ),
    'parent_item_colon' => __( 'Parent Ort:' ),
    'edit_item' => __( 'Ort bearbeiten' ),
    'update_item' => __( 'Ort aktualisieren' ),
    'add_new_item' => __( 'Ort hinzufügen' ),
    'new_item_name' => __( 'Neuer Ort' ),
    'menu_name' => __( 'Orte' ),
  ];

  register_taxonomy('Ortschaft',['tour'], [
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => false,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => ['slug' => 'place'],
  ]);

  $labels = [
    'name' => _x( 'Info', 'taxonomy general name' ),
    'singular_name' => _x( 'Info', 'taxonomy singular name' ),
    'search_items' =>  __( 'Infos durchsuchen' ),
    'all_items' => __( 'Alle Infos' ),
    'parent_item' => __( 'Übergeordnete Info' ),
    'parent_item_colon' => __( 'Parent Info:' ),
    'edit_item' => __( 'Info bearbeiten' ),
    'update_item' => __( 'Info aktualisieren' ),
    'add_new_item' => __( 'Info hinzufügen' ),
    'new_item_name' => __( 'Neue Info' ),
    'menu_name' => __( 'Info' ),
  ];

  register_taxonomy('Info',['tour'], [
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => false,
    'query_var' => true,
    'rewrite' => ['slug' => 'info'],
  ]);

}
add_action( 'init', 'registerEmployeeCategory', 0 );
//----------------------------------------------------------

// Adding ACF Field Event Date to WP admin column
//----------------------------------------------------------
// function add_acf_columns ( $columns ) {
//   return array_merge ( $columns, array (
//     'from' => __('Datum von'),
//     'to' => __('bis'),
//   ) );
// }
// add_filter ( 'manage_event_posts_columns', 'add_acf_columns' );
// /*
//  * Add columns to event post list
//  */
//  function event_custom_column ( $column, $post_id ) {
//    switch ( $column ) {
//      case 'from':
//        echo date('d.m.Y H:i', strtotime(get_post_meta( $post_id, 'from', true )));
//        break;
//      case 'to':
//         if(get_post_meta( $post_id, 'to', true )){
//           echo date('d.m.Y H:i', strtotime(get_post_meta( $post_id, 'to', true )));
//         }
//        break;
//    }
//  }
//  add_action ( 'manage_event_posts_custom_column', 'event_custom_column', 10, 2 );
//----------------------------------------------------------


// Save Name + Lastname as Post Title of PostType Employee
//----------------------------------------------------------
function save_post_handler( $post_id ) {

    if ( get_post_type( $post_id ) == 'team' ) {
        $title = get_field( 'name', $post_id ) . ' ' . get_field( 'lastname', $post_id );
        $data['ID'] = $post_id;
        $data['post_title'] = $title;
        $data['post_name']  = sanitize_title( $title );
        wp_update_post( $data );
    }
    else if ( get_post_type( $post_id ) == 'tour' ) {
        $title = get_field( 'name', $post_id );
        $data['ID'] = $post_id;
        $data['post_title'] = $title;
        $data['post_name']  = sanitize_title( $title );
        wp_update_post( $data );
    }

}
add_action( 'acf/save_post', 'save_post_handler' , 20 );

?>

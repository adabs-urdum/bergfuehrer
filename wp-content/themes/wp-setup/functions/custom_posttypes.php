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

    $labels = array(
        'name'                => __( 'Durchführungen', 'wp-setup' ),
        'singular_name'       => __( 'Durchführung', 'wp-setup' ),
        'menu_name'           => __( 'Durchführungen', 'wp-setup' ),
        'parent_item_colon'   => __( 'Durchführungen', 'wp-setup' ),
        'all_items'           => __( 'Alle Durchführungen', 'wp-setup' ),
        'view_item'           => __( 'Durchführungen ansehen', 'wp-setup' ),
        'add_new_item'        => __( 'Durchführung hinzufügen', 'wp-setup' ),
        'add_new'             => __( 'Neue hinzufügen', 'wp-setup' ),
        'edit_item'           => __( 'Durchführung bearbeiten', 'wp-setup' ),
        'update_item'         => __( 'Durchführung aktualisieren', 'wp-setup' ),
        'search_items'        => __( 'Durchführung suchen', 'wp-setup' ),
        'not_found'           => __( 'Nicht gefunden', 'wp-setup' ),
        'not_found_in_trash'  => __( 'Nicht im Papierkorb gefunden', 'wp-setup' ),
    );
    $args = array(
        'label'               => __( 'conduct', 'wp-setup' ),
        'description'         => __( 'Durchführung Detail Info', 'wp-setup' ),
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
    register_post_type( 'conduct', $args );

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
    'show_ui' => true,
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


/**
 *	Save Name + Lastname as Post Title of PostType Employee
 *
 */
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
    else if ( get_post_type( $post_id ) == 'conduct' ) {
        $tour = get_the_title(get_field('tour', $post_id));
        $date = get_field('conductDate', $post_id);
        $data['ID'] = $post_id;
        $data['post_title'] = $tour . ' - ' . $date;
        $data['post_name']  = sanitize_title( $tour . ' - ' . $date );
        wp_update_post( $data );
    }

}
add_action( 'acf/save_post', 'save_post_handler' , 20 );

/**
 *	ACF Admin Columns
 *
 */
function add_acf_columns_conduct ( $columns ) {
   return array_merge( $columns, array (
     'conductDate' => __ ( 'Durchführung' ),
     'guide' => __ ( 'Bergführer' ),
     'tour' => __ ( 'Tour' ),
     'registrations' => __ ( 'Anmeldungen' ),
   ) );
 }
 add_filter ( 'manage_conduct_posts_columns', 'add_acf_columns_conduct' );

function add_acf_columns_tour ( $columns ) {
   return array_merge( $columns, array (
     'type' => __ ( 'Sportart' ),
   ) );
 }
 add_filter ( 'manage_tour_posts_columns', 'add_acf_columns_tour' );

 /*
 * Add columns to Conduct CPT
 */
 function conduct_custom_column ( $column, $post_id ) {
   switch ( $column ) {
     case 'conductDate':
        echo get_field('conductDate', $post_id);
        break;
     case 'guide':
        echo get_the_title(get_field('guide', $post_id));
        break;
     case 'tour':
        echo get_the_title(get_field('tour', $post_id));
        break;
     case 'registrations':
        $registrations = get_field('registrations', $post_id);
        if(is_array($registrations)){
          $registrations = is_array($registrations) ? array_sum(array_map(function($registration){
            return $registration['people'];
          }, $registrations)) : 0;
        }
        else{
          $registrations = 0;
        }
        $maxRegistrations = get_field('maxRegistrations', $post_id);
        echo $registrations . '/' . $maxRegistrations;
        break;
   }
}
add_action ( 'manage_conduct_posts_custom_column', 'conduct_custom_column', 10, 2 );

 /*
 * Add columns to tour CPT
 */
 function tour_custom_column ( $column, $post_id ) {
   switch ( $column ) {
     case 'type':
        $type = get_field('type', $post_id);
        echo get_term($type)->name;
        break;
   }
}
add_action ( 'manage_tour_posts_custom_column', 'tour_custom_column', 10, 2 );

 /*
 * Add Sortable columns too cpt conduct
 */
function my_column_register_sortable( $columns ) {
	$columns['conductDate'] = 'conductDate';
	$columns['guide'] = 'guide';
	$columns['tour'] = 'tour';
  $columns['registrations'] = 'registrations';
	return $columns;
}
add_filter('manage_edit-conduct_sortable_columns', 'my_column_register_sortable' );

 /*
 * Add Sortable columns too cpt conduct
 */
function my_column_register_sortable_tour( $columns ) {
	$columns['type'] = 'type';
	return $columns;
}
add_filter('manage_edit-tour_sortable_columns', 'my_column_register_sortable_tour' );

/*
 * Orderby acf date field
 */
function my_column_orderby( $query ) {
	if( ! is_admin() )
		return;

	$orderby = $query->get( 'orderby');

	if( $orderby == 'conductDate' ) {
		$query->set('meta_key','conductDate');
		$query->set('orderby','meta_value_num');
	}
	else if( $orderby == 'type' ) {
		$query->set('orderby','name');
    $query->set('orderby','meta_value');
	}
}
add_action( 'pre_get_posts', 'my_column_orderby' );

?>

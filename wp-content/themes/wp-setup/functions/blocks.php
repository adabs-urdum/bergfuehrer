<?php

add_filter( 'block_categories', function( $categories, $post ) {
    return array_merge(
        $categories,
        [
            [
                'slug'  => 'contentelements',
                'title' => 'Inhaltselemente',
            ]
        ]
    );
}, 10, 2 );

function my_acf_block_types() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        acf_register_block_type([
            'name'              => 'text',
            'title'             => __('Text'),
            'description'       => __('Simple Text'),
            'render_template'   => 'blocks/text.php',
            'category'          => 'contentelements',
            'icon'              => 'editor-alignleft',
            'mode'              => 'preview',
            'align'             => 'center',
            'keywords'          => [],
        ]);

        acf_register_block_type([
            'name'              => 'image',
            'title'             => __('Bild'),
            'description'       => __('Einzelbild'),
            'render_template'   => 'blocks/image.php',
            'category'          => 'contentelements',
            'icon'              => 'format-image',
            'mode'              => 'preview',
            'align'             => 'center',
            'keywords'          => [],
        ]);

        acf_register_block_type([
            'name'              => 'imgtxtcombo',
            'title'             => __('Bild Text Kombo'),
            'description'       => __('Bild Text Kombination'),
            'render_template'   => 'blocks/imageTextCombo.php',
            'category'          => 'contentelements',
            'icon'              => 'align-pull-left',
            'mode'              => 'preview',
            'align'             => 'center',
            'keywords'          => [],
        ]);

        acf_register_block_type([
            'name'              => 'gallery',
            'title'             => __('Galerie'),
            'description'       => __('Galerie'),
            'render_template'   => 'blocks/gallery.php',
            'category'          => 'contentelements',
            'icon'              => 'format-gallery',
            'mode'              => 'preview',
            'align'             => 'center',
            'keywords'          => [],
        ]);

        acf_register_block_type([
            'name'              => 'teasers',
            'title'             => __('Teaser'),
            'description'       => __('Teaser'),
            'render_template'   => 'blocks/teasers.php',
            'category'          => 'contentelements',
            'icon'              => 'format-gallery',
            'mode'              => 'preview',
            'align'             => 'center',
            'keywords'          => [],
        ]);

        acf_register_block_type([
            'name'              => 'team',
            'title'             => __('Team'),
            'description'       => __('Team Mitglieder'),
            'render_template'   => 'blocks/team.php',
            'category'          => 'contentelements',
            'icon'              => 'format-gallery',
            'mode'              => 'preview',
            'align'             => 'center',
            'keywords'          => [],
        ]);

        acf_register_block_type([
            'name'              => 'events',
            'title'             => __('Tourenliste'),
            'description'       => __('Touren'),
            'render_template'   => 'blocks/events.php',
            'category'          => 'contentelements',
            'icon'              => 'format-gallery',
            'mode'              => 'preview',
            'align'             => 'center',
            'keywords'          => [],
        ]);

        acf_register_block_type([
            'name'              => 'form',
            'title'             => __('Formular'),
            'description'       => __('Formular'),
            'render_template'   => 'blocks/form.php',
            'category'          => 'contentelements',
            'icon'              => 'format-gallery',
            'mode'              => 'preview',
            'align'             => 'center',
            'keywords'          => [],
        ]);

        acf_register_block_type([
            'name'              => 'bookingform',
            'title'             => __('Buchungsformular'),
            'description'       => __('Buchungsformular'),
            'render_template'   => 'blocks/bookingform.php',
            'category'          => 'contentelements',
            'icon'              => 'format-gallery',
            'mode'              => 'preview',
            'align'             => 'center',
            'keywords'          => [],
        ]);

        acf_register_block_type([
            'name'              => 'checkout',
            'title'             => __('Kasse'),
            'description'       => __('Kasse'),
            'render_template'   => 'blocks/checkout.php',
            'category'          => 'contentelements',
            'icon'              => 'format-gallery',
            'mode'              => 'preview',
            'align'             => 'center',
            'keywords'          => [],
        ]);

        acf_register_block_type([
            'name'              => 'cart',
            'title'             => __('Warenkorb'),
            'description'       => __('Warenkorb'),
            'render_template'   => 'blocks/cart.php',
            'category'          => 'contentelements',
            'icon'              => 'format-gallery',
            'mode'              => 'preview',
            'align'             => 'center',
            'keywords'          => [],
        ]);

        acf_register_block_type([
            'name'              => 'currenttours',
            'title'             => __('Aktuelle Touren'),
            'description'       => __('Aktuelle Touren'),
            'render_template'   => 'blocks/currenttours.php',
            'category'          => 'contentelements',
            'icon'              => 'format-gallery',
            'mode'              => 'preview',
            'align'             => 'center',
            'keywords'          => [],
        ]);
    }
}
add_action('acf/init', 'my_acf_block_types');

function allowed_block_types( $allowed_block_types, $post ) {
    return [
        'acf/text',
        'acf/image',
        'acf/team',
        'acf/events',
        'acf/form',
        'acf/bookingform',
        'acf/checkout',
        'acf/cart',
        'acf/currenttours',
    ];
}
add_filter( 'allowed_block_types', 'allowed_block_types', 10, 2 );

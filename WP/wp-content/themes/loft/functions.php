<?php

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('libs', get_stylesheet_directory_uri() . '/css/libs.min.css', array(), null);
    wp_enqueue_style('main', get_stylesheet_directory_uri() . '/css/main.css', array(), time());
    wp_enqueue_style('media', get_stylesheet_directory_uri() . '/css/media.css');


    wp_enqueue_script('jquery');
    wp_enqueue_script('media', get_stylesheet_directory_uri() . '/js/main.js', array('jquery'), null, true);
});

register_nav_menus(
    array(
        'head_menu' => 'Меню в шапке',
        'fott_menu' => 'Меню в футере'
    )
);

add_theme_support('post-thumbnails', array('post'));


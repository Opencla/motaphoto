<?php
// Fonction pour charger les styles du thème parent
function twentytwenty_child_enqueue_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'twentytwenty_child_enqueue_styles');

function register_footer_menu() {
    register_nav_menus(array(
        'footer-menu' => __('Footer Menu', 'motaphoto'),
    ));
}
add_action('init', 'register_footer_menu');
?>


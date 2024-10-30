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

function motaphoto_assets() {

  wp_enqueue_script( 
        'motaphoto', 
        get_stylesheet_directory_uri() . '/js/script.js', [ 'jquery' ], 
      '1.0', 
      true 
   );

  
}
add_action( 'wp_enqueue_scripts', 'motaphoto_assets' );
add_action( 'wp_ajax_motaphoto_load_post', 'motaphoto_load_post' );
add_action( 'wp_ajax_nopriv_motaphoto_load_post', 'motaphoto_load_post' );

function motaphoto_load_post(){
    $data = $_POST['contenu'];
    var_dump($data);
    wp_send_json_success('le back-end répond : '.$data);
}
?>


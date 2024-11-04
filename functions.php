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

function load_more_photos() {
    // Nombre de photos à charger par page (par exemple, 4)
    $posts_per_page = 4;

    // Page actuelle pour AJAX (si c’est une requête initiale, la page sera 1)
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;

    $args = [
        'post_type'      => 'attachment',
        'post_mime_type' => 'image',
        'posts_per_page' => $posts_per_page,
        'post_status'    => 'inherit',
        'orderby'        => 'date',
        'order'          => 'DESC',
        'paged'          => $paged,  // Utilise la pagination avec le paramètre 'paged'
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $image_url = wp_get_attachment_url(get_the_ID());
            echo '<div class="image-item"><img src="' . esc_url($image_url) . '" alt="' . esc_attr(get_the_title()) . '"></div>';
        }
        wp_reset_postdata();
    } else {
        echo 'no_more_posts'; // Message spécial pour signaler qu'il n'y a plus de photos
    }

    wp_die(); // Stoppe l'exécution de la fonction AJAX
}
add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');

function load_more_photos_script() {
    wp_enqueue_script('load-more-photos', get_template_directory_uri() . '/js/load-more-photos.js', ['jquery'], null, true);

    // Passe l'URL AJAX au script pour que WordPress puisse gérer la requête
    wp_localize_script('load-more-photos', 'ajax_params', [
        'ajax_url' => admin_url('admin-ajax.php'),
    ]);
}
add_action('wp_enqueue_scripts', 'load_more_photos_script');


?>


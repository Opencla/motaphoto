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
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $order = isset($_POST['order']) ? $_POST['order'] : 'DESC';
    $category_slug = $_POST['category'];

    $args = [
        'post_type'         => 'photo', // Type de contenu personnalisé
        'posts_per_page'    => 8,
        'orderby'           => 'date',            // Trier par date
        'order'             => $order,            // Ordre décroissant
        'paged'             => $paged,
    ];     
    
    if ($category_slug !== 'all') {
        $args['tax_query'] = [
            [
                'taxonomy' => 'categorie',
                'field'    => 'slug',
                'terms'    => $category_slug,
            ]
        ];
    };
    
    $query = new WP_Query( $args );
    $html="";
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $image_url = wp_get_attachment_url(get_the_ID());
            $html .= '
            <a href=' . get_permalink(get_the_ID()) . ' class="photo-link">
                <div style="background-image:url(' .  get_the_post_thumbnail_url( get_the_ID(), 'full' )  . ')" class="photo-article">
                    <div class="post-overlay">
                        <span>' . get_the_title() . '</span><span>' . get_the_terms(get_the_ID(),"categorie")[0]->name . '</span>
                    </div>
                </div>
            </a>';
        }
        wp_reset_postdata();
    } else {
        $html = 'no_more_posts'; // Message spécial pour signaler qu'il n'y a plus de photos
    }
    wp_send_json_success($html);
}
?>
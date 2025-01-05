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
    wp_enqueue_script('motaphoto', get_stylesheet_directory_uri() . '/js/script.js', [ 'jquery' ], '1.0', true);
    wp_enqueue_script('motaphoto-lightbox', get_stylesheet_directory_uri() . '/js/lightbox.js', [ 'jquery' ], '1.0', true);
}

add_action( 'wp_enqueue_scripts', 'motaphoto_assets' );
add_action( 'wp_ajax_motaphoto_load_post', 'motaphoto_load_post' );
add_action( 'wp_ajax_nopriv_motaphoto_load_post', 'motaphoto_load_post' );

function motaphoto_load_post(){
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $order = isset($_POST['order']) ? $_POST['order'] : 'DESC';
    $category_slug = $_POST['category'];
    $format_slug = $_POST['format_to_back_end'];

    $args = [
        'post_type'         => 'photo',         // Type de contenu personnalisé
        'posts_per_page'    => 8,
        'orderby'           => 'date',          // Trier par date
        'order'             => $order,          // Ordre décroissant
        'paged'             => $paged,
        'tax_query'         => [],
    ];     

    if ($format_slug !== 'all') {
        $args['tax_query'][] = [
            'taxonomy' => 'format',
            'field'    => 'slug',
            'terms'    => $format_slug,
        ];
    };

    if ($category_slug !== 'all') {
        $args['tax_query'][] = [
            'taxonomy' => 'categorie',
            'field'    => 'slug',
            'terms'    => $category_slug,
        ];
    };

    if (count($args['tax_query']) > 1) {
        $args['tax_query']['relation'] = 'AND';
    }
    
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
                        <button class="js-open-lightbox">
                            <svg xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none" version="1.1" id="svg8" sodipodi:docname="icon-light-box.svg" inkscape:version="1.3.2 (091e20e, 2023-11-25, custom)" inkscape:export-filename="icon-lightbox.png" inkscape:export-xdpi="1445.6471" inkscape:export-ydpi="1445.6471">
                                <defs id="defs8"/>
                                <sodipodi:namedview id="namedview8" pagecolor="#ffffff" bordercolor="#000000" borderopacity="0.25" inkscape:showpageshadow="2" inkscape:pageopacity="0.0" inkscape:pagecheckerboard="0" inkscape:deskcolor="#d1d1d1" inkscape:zoom="28" inkscape:cx="9.0357143" inkscape:cy="17.107143" inkscape:window-width="2400" inkscape:window-height="1284" inkscape:window-x="2391" inkscape:window-y="-9" inkscape:window-maximized="1" inkscape:current-layer="svg8"/>
                                <circle cx="17" cy="17" r="17" fill="black" id="circle1" style="fill:#000000;fill-opacity:1"/>
                                <path style="fill:none;stroke:#ffffff;stroke-width:2;stroke-dasharray:none;stroke-opacity:1" d="M 8.7649269,16.017568 8.727815,9.7271173 14.999709,9.7642291" id="path2"/>
                                <path style="fill:none;stroke:#ffffff;stroke-width:2;stroke-dasharray:none;stroke-opacity:1" d="m 18.890955,9.7681143 6.29045,-0.03711 -0.03711,6.2718937" id="path2-7"/>
                                <path style="fill:none;stroke:#ffffff;stroke-width:2;stroke-dasharray:none;stroke-opacity:1" d="m 25.144315,17.926667 0.03711,6.29045 -6.271894,-0.03711" id="path2-7-0"/>
                                <path style="fill:none;stroke:#ffffff;stroke-width:2;stroke-dasharray:none;stroke-opacity:1" d="m 15.038634,24.108601 -6.29045,0.03711 0.03711,-6.271894" id="path2-7-0-0"/>
                            </svg>
                        </button>
                        <svg class="eye-icon" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
                        </svg>
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
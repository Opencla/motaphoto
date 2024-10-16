<?php
get_header(); 
?>
<main>
    <!--Section pour photographe event-->
    <section class="image">
        <h1>Photographe Event</h1>
    <div class="image-banner">
        <img width="1440" height="962" src="http://localhost/motaphoto/wordpress/wp-content/uploads/2024/10/nathalie-11.jpg">
    </div>
    </section>

    <!--Section pour la galerie des photos-->
    <section class="gallery">
    <?php
    $args = array(
        'post_type' => 'photo', // Type de contenu personnalisé
        'posts_per_page' => 8,
        
    );
    
    $query = new WP_Query( $args );
    var_dump($query);
    if ( $query->have_posts() ) :
        while ( $query->have_posts() ) : $query->the_post();
        the_title();
            // 2.On récupére l'image depuis un champ personnalisé avec ACF
        //    $image = get_field('informations'); // /
        //     if( $image ) {
        //         $image_url = $image['url'];
        //         $image_alt = $image['alt'];
    
        //         // On affiche l'image avec le lien vers l'article
        //         echo '<a href="' . esc_url( get_permalink() ) . '">';
        //         echo '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( $image_alt ) . '" />';
        //         echo '</a>';
        //     }
        endwhile;
    
        wp_reset_postdata();
    else :
        echo 'Aucun contenu trouvé.';
    endif;
    ?>
    </section>
    
<?php
get_footer();
?>

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
    <!--Mes filtres-->
    <select class="first-filter">
        <option value="categories">CATEGORIES</option>
        <option value="réception">Réception</option>
        <option value="télévision">Télévision</option>
        <option value="concert">Concert</option>
        <option value="mariage">Mariage</option>
    </select>
    <select class="second-filter">
        <option value="formats">FORMATS</option>
        <option value="paysage">Paysage</option>
        <option value="portrait">Portrait</option>
    </select>
    <select class="third-filter">
        <option value="trier par">TRIER PAR</option>
        <option value="a partir des plus récentes">A partir des plus récentes</option>
        <option value="a partir des plus anciennes">A partir des plus anciennes</option>
    </select>
    <!--Section pour la galerie des photos-->
    <section class="gallery">
    <?php
    $args = array(
        'post_type' => 'photo', // Type de contenu personnalisé
        'posts_per_page' => 16,
        
    );
    
    $query = new WP_Query( $args );
    
    if ( $query->have_posts() ) :
        while ( $query->have_posts() ) : $query->the_post();
        ?>
        <div style="background-image:url(<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full' ); ?>)" class="photo-article">
        <div><?php the_title();
        echo get_the_terms(get_the_ID(),"categorie")[0]->name;
        ?>
        </div>
        </div>
        <?php
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

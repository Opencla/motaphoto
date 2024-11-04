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
    <section class="filters">
    <div class="filters-cluster">
    <select class="first-filter">
        <option class="categories">CATEGORIES</option>
        <option class="réception">Réception</option>
        <option class="télévision">Télévision</option>
        <option class="concert">Concert</option>
        <option class="mariage">Mariage</option>
    </select>
    <select class="second-filter">
        <option class="formats">FORMATS</option>
        <option class="paysage">Paysage</option>
        <option class="portrait">Portrait</option>
    </select>
    </section>
    <section class="filters2">
    <select class="third-filter">
        <option class="trier par">TRIER PAR</option>
        <option class="a partir des plus récentes">A partir des plus récentes</option>
        <option class="a partir des plus anciennes">A partir des plus anciennes</option>
    </select>
    </section>
    </section>
    <!--Section pour la galerie des photos-->
    <section class="gallery">
    <?php
    $args = array(
        'post_type' => 'photo', // Type de contenu personnalisé
        'posts_per_page' => 6,
        'orderby'        => 'date',            // Trier par date
        'order'          => 'DESC',            // Ordre décroissant
    
        
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
    <button id="load" class="load-more"type="button">Charger plus</button>
    </section>
     
<?php
get_footer();
?>

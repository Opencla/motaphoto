<?php get_header(); ?>
    <div class="main single">
        <?php if (have_posts()): ?>
            <?php while (have_posts()):the_post(); ?>
                <div class="post">
                    <div class="post-content">
                        <div class="single-photo-content">
                            <div class="infos-container">
                                <h1 class="post-title"><?php the_title(); ?></h1>
                                <p> Référence : <span class="ref-value"> <?php echo get_field("reference"); ?></span></p>
                                <p> Catégorie : <?php echo get_the_terms(get_the_ID(), "categorie")[0]->name; ?> </p>
                                <p> Format : <?php echo get_the_terms(get_the_ID(), "format")[0]->name; ?> </p>
                                <p> Type : <?php echo get_field("type"); ?> </p>
                                <p> Année : <?php echo get_the_date("Y"); ?> </p>
                            </div>
                        </div>
                        <div class="photos-container">
                            <?php if (has_post_thumbnail()): ?>
                                <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="Photographie">
                            <?php else: ?>
                                <p>Aucune image mise en avant trouvée.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="contact-content">
                        <div class="contact">
                            <p class="contact-text">Cette photo vous intéresse ?</p>
                            <button class="contact-btn">Contact</button>
                        </div>

                        <!-- 
                            Trouver comment récupérer le permalien et la thumbnail de la photo suivante + trouver comment récupérer 
                            le permalien et le thumbnail de la photo précédente -> dans un second temps de coder en JS le changement de photo
                            au survol des flèches
                         -->
                            <?php
                            $prev_post = get_previous_post();	
                            $next_post = get_next_post();

                            ?>

                            
                         <div class="site__navigation flexrow">
                            <div class="site__navigation image">
                            <?php
											
                                            if($prev_post) {
                                                $prev_post_id = $prev_post->ID;
                                                if (has_post_thumbnail($prev_post_id)){
                                                    ?>
                                                    <div>
                                                        <?php echo get_the_post_thumbnail($prev_post_id, array(77,60));?></div>
                                                    <?php
                                                    }
                                                    else{
                                                        echo '<img src="'. get_stylesheet_directory_uri() .'/images p11/arrow-left.svg" alt="Pas de photo"width="77px" ><br>';
                                                    }							
                                                    
                                                }
                                                if($next_post) {
                                                    $next_post_id = $next_post->ID;
                                                    if (has_post_thumbnail($next_post_id)){
                                                    ?>
                                                        <div><?php echo get_the_post_thumbnail($next_post_id, array(77,60));?></div>
                                                    <?php
                                                    }
                                                    else{
                                                        echo '<img src="'. get_stylesheet_directory_uri() .'/images p11/arrow-right.svg" alt="Pas de photo" width="77px" ><br>';
                                                    }							
                                                  
                                                }
                                                ?>
                            
                            </div>
                    <div class="site__navigation__prev">
                    <?php
											
					if($prev_post) {
						$prev_title = strip_tags(str_replace('"', '', $prev_post->post_title));
						$prev_post_id = $prev_post->ID;
						echo '<a rel="prev" href="' . get_permalink($prev_post_id) . '" title="' . $prev_title. '" class="previous_post">';
						echo '<img src="'. get_stylesheet_directory_uri() .'/images p11/arrow-left.svg" alt="Photo précédente" ></a>';}
						?>
				    </div>
                    

                    <div class="site__navigation__next">
					<!-- next_post_link( '%link', '%title', false );  -->
					<?php
						
						if($next_post) {
							$next_title = strip_tags(str_replace('"', '', $next_post->post_title));
							$next_post_id = $next_post->ID;
							echo  '<a rel="next" href="' . get_permalink($next_post_id) . '" title="' . $next_title. '" class="next_post">';
									
							echo '<img src="'. get_stylesheet_directory_uri() .'/images p11/arrow-right.svg" alt="Photo suivante" ></a>';
						}
					?>
					
				    </div>
			        </div>
		        </div>
                    </div> 
                    <div class="post-comments">
                        <!-- 
                            Trouver comment ajouter les photos "vous aimerez aussi" -> regarder
                            comment requeter auprès de WordPress pour récupérer deux photos ayant les mêmes catégories ou étiquette que la
                            photo actuellement affichée.
                         -->
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
<?php get_footer(); ?>
<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>
			<footer id="site-footer" class="header-footer-group">

				<div class="section-inner">

					<div class="footer-credits">

						
						<?php
						if (has_nav_menu('footer-menu')) {
							wp_nav_menu(array(
								'theme_location' => 'footer-menu',
								'menu_class' => 'footer-menu-class', // Classe CSS pour le menu
								'container' => 'div', // Ou 'nav' selon votre préférence
								'container_class' => 'footer-menu-container', // Classe CSS pour le conteneur
							));
						}
						?>
						<?php
						if ( function_exists( 'the_privacy_policy_link' ) ) {
							the_privacy_policy_link( '<p class="privacy-policy">', '</p>' );
						}
						?>

						

					</div><!-- .footer-credits -->

					

				</div><!-- .section-inner -->

			</footer><!-- #site-footer -->

			<!--La popup est présente dans la page Contact-->
			<?php 
        get_template_part('templates_part/contact'); 		
    ?>

		<?php wp_footer(); ?>

	</body>
</html>

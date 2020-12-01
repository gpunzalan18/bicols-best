<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Foodie_World
 */

?>
		<?php if ( 'page' == get_option('show_on_front') && is_front_page() && get_theme_mod( 'foodie_world_enable_static_page_posts' ) ) : ?>
			<?php get_template_part( 'template-parts/recent-posts/front-recent', 'posts' ); ?>
		<?php endif; ?>

		<?php get_theme_mod( 'foodie_world_featured_content_position' ) ? get_template_part( 'template-parts/featured-content/display', 'featured' ) : ''; ?>

		<?php get_template_part( 'template-parts/testimonials/display', 'testimonial' ) ; ?>

		<?php
		$enable_homepage_posts = foodie_world_enable_homepage_posts();

		if ( $enable_homepage_posts ) : ?>
			</div><!-- .wrapper -->
		</div><!-- #content -->
		<?php endif; ?>

		<footer id="colophon" class="site-footer">
			<?php get_template_part( 'template-parts/footer/footer', 'instagram' ); ?>

			<?php get_template_part( 'template-parts/footer/footer', 'widget' ); ?>

			<?php get_template_part( 'template-parts/footer/site', 'info' ); ?>
		</footer><!-- #colophon -->
	</div> <!-- below-site-header -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>

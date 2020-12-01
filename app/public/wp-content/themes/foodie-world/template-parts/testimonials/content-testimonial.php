<?php
/**
 * The template used for displaying testimonial on front page
 *
 * @package Foodie_World
 */
?>
<div class="review-slide">
	<div class="hentry-wrap">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="testimonial-thumbnail">
					<?php the_post_thumbnail( 'foodie-world-testimonial' ); ?>
				</div>
			<?php endif; ?>

			<div class="entry-container">
				<?php $position = get_post_meta( get_the_id(), 'ect_testimonial_position', true ); ?>

				<?php if ( get_theme_mod( 'foodie_world_testimonial_enable_title', 1 ) || $position ) : ?>
					<header class="entry-header">
						<?php
						if ( get_theme_mod( 'foodie_world_testimonial_enable_title', 1 ) ) {
							the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );
						}

						if ( $position ) {
						echo '<div class="entry-meta"><span class="sep">/</span><span class="position">' . esc_html( $position ) . '</span></div>';
						}
						?>
					</header>
				<?php endif;?>

				<div class="entry-content">
					<?php the_content(); ?>
				</div>

			</div><!-- .entry-container -->
		</article>
	</div><!-- .hentry-wrap -->
</div><!-- review-slide -->

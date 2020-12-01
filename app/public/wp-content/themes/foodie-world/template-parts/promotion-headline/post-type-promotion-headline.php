<?php
/**
 * The template used for displaying promotion_headline content
 *
 * @package Foodie_World
 */
?>

<?php

$type = get_theme_mod( 'foodie_world_promotion_headline_type', 'page' );

if ( 'page' === $type && $id = get_theme_mod( 'foodie_world_promotion_headline_page' ) ) {
	$args['page_id'] = absint( $id );
} elseif ( 'post' === $type && $id = get_theme_mod( 'foodie_world_promotion_headline_post' ) ) {
	$args['p'] = absint( $id );
} elseif ( 'category' === $type && $cat = get_theme_mod( 'foodie_world_promotion_headline_category' ) ) {
	$args['cat']            = absint( $cat );
	$args['posts_per_page'] = 1;
}

// If $args is empty return false
if ( empty( $args ) ) {
	return;
}

// Create a new WP_Query using the argument previously created
$promotion_headline_query = new WP_Query( $args );
if ( $promotion_headline_query->have_posts() ) :
	while ( $promotion_headline_query->have_posts() ) :
		$promotion_headline_query->the_post();

		// Bg image added from function foodie_world_promo_headline_bg_css()
		?>
		<div id="promotion-headline" class="promotion-headline-wrapper section">
			<div class="wrapper">
				<div class="section-content-wrap">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="entry-container">
							<?php
							if ( ! get_theme_mod( 'foodie_world_disable_promotion_headline_title' ) ) {
								the_title( '<header class="entry-header"><h2 class="entry-title">', '</h2></header>' );
							}
							?>
							<?php
								$show_content = get_theme_mod( 'foodie_world_promotion_headline_show', 'excerpt' );

								if ( 'full-content' === $show_content ) {
									echo '<div class="entry-content">';
									the_content();
									echo '</div><!-- .entry-content -->';
								} elseif ( 'excerpt' === $show_content ) {
									echo '<div class="entry-summary">';
									echo '<p>' . get_the_excerpt() . '</p>';
									echo '</div><!-- .entry-summary -->';
								}
							?>
							</div><!-- .entry-content -->

							<?php if ( get_edit_post_link() ) : ?>
								<footer class="entry-footer">
									<?php
										edit_post_link(
											sprintf(
												/* translators: %s: Name of current post */
												esc_html__( 'Edit %s', 'foodie-world' ),
												the_title( '<span class="screen-reader-text">"', '"</span>', false )
											),
											'<span class="edit-link">',
											'</span>'
										);
									?>
								</footer><!-- .entry-footer -->
							<?php endif; ?>
						</div><!-- .entry-container -->
					</article><!-- #post-## -->
				</div><!-- .section-content-wrap -->
			</div> <!-- Wrapper -->
		</div> <!-- promotion_headline-wrapper -->
	<?php
	endwhile;

	wp_reset_postdata();
endif;

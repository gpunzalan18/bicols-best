<?php
/**
 * The template for displaying featured content
 *
 * @package Foodie_World
 */
?>

<?php
$enable_content = get_theme_mod( 'foodie_world_featured_content_option', 'disabled' );

if ( ! foodie_world_check_section( $enable_content ) ) {
	// Bail if featured content is disabled.
	return;
}
	$featured_posts = foodie_world_get_featured_posts();
	if ( empty( $featured_posts ) ) {
		return;
	}

$title     = get_option( 'featured_content_title', esc_html__( 'Contents', 'foodie-world' ) );
$sub_title = get_option( 'featured_content_content' );
?>

<div class="featured-content-section section">
	<div class="wrapper">
		<?php if ( '' !== $title || $sub_title ) : ?>
			<div class="section-heading-wrapper">
				<?php if ( '' !== $title ) : ?>
					<div class="section-title-wrapper">
						<h2 class="section-title"><?php echo wp_kses_post( $title ); ?></h2>
					</div><!-- .page-title-wrapper -->
				<?php endif; ?>

				<?php if ( $sub_title ) : ?>
					<div class="section-description">
						<?php echo wp_kses_post( $sub_title ); ?>
					</div><!-- .section-description -->
				<?php endif; ?>
			</div><!-- .section-heading-wrapper -->
		<?php endif; ?>

		<div class="section-content-wrapper layout-three">

			<?php
				foreach ( $featured_posts as $post ) {
					setup_postdata( $post );

					// Include the featured content template.
					get_template_part( 'template-parts/featured-content/content', 'featured' );


				wp_reset_postdata();
			}
			?>
		</div><!-- .featured-content-wrapper -->
	</div><!-- .wrapper -->
</div><!-- #featured-content-section -->

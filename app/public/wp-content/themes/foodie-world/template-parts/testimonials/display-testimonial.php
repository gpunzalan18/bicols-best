<?php
/**
 * The template for displaying testimonial items
 *
 * @package Foodie_World
 */
?>

<?php
$enable = get_theme_mod( 'foodie_world_testimonial_option', 'disabled' );

if ( ! foodie_world_check_section( $enable ) ) {
	// Bail if featured content is disabled
	return;
}
	// Get Jetpack options for testimonial.
	$jetpack_defaults = array(
		'page-title' => esc_html__( 'Testimonials', 'foodie-world' ),
	);

	// Get Jetpack options for testimonial.
	$jetpack_options = get_theme_mod( 'jetpack_testimonials', $jetpack_defaults );
	//var_dump($jetpack_options); die();
	$headline = isset( $jetpack_options['page-title'] ) ? $jetpack_options['page-title'] : esc_html__( 'Testimonials', 'foodie-world' );

	$subheadline = isset( $jetpack_options['page-content'] ) ? $jetpack_options['page-content'] : '';

$classes[] = 'section testimonial-wrapper';

if ( ! $headline && ! $subheadline ) {
	$classes[] = 'no-headline';
}

?>

<div class="testimonials-content-wrapper <?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">

		<?php if ( $headline || $subheadline ) : ?>
			<div class="section-heading-wrapper">
			<?php if ( $headline ) : ?>
				<div class="section-title-wrapper">
					<h2 class="section-title"><?php echo wp_kses_post( $headline ); ?></h2>
				</div>
			<?php endif; ?>

			<?php if ( $subheadline ) : ?>
				<div class="section-description">
					<?php echo wp_kses_post( $subheadline ); ?>
				</div><!-- .section-description -->
			<?php endif; ?>
			</div><!-- .section-heading-wrap -->
		<?php endif; ?>

		<div class="section-content-wrap <?php echo esc_attr( get_theme_mod( 'foodie_world_testimonial_layout', 'layout-two' ) ); ?>">
			<?php $slider_select = get_theme_mod( 'foodie_world_testimonial_slider', 1 );

			if ( $slider_select ) : ?>
			<div class="cycle-slideshow"
			    data-cycle-log="false"
			    data-cycle-pause-on-hover="true"
			    data-cycle-swipe="true"
			    data-cycle-auto-height=container
			    data-cycle-fx="scrollHorz"
				data-cycle-speed="1000"
				data-cycle-timeout="4000"
				data-cycle-loader=false
				data-cycle-prev= .cycle-prev
				data-cycle-next= .cycle-next
				data-cycle-pager="#testimonial-slider-pager"
				data-cycle-prev="#testimonial-slider-prev"
				data-cycle-next="#testimonial-slider-next"
				data-cycle-slides=".testimonial-slider-wrap"
				>

				<div class="controller">
					<!-- prev link -->
					<button id="testimonial-slider-prev" class="cycle-prev" aria-label="<?php esc_attr_e( 'Previous', 'foodie-world' ); ?>"><span class="screen-reader-text"><?php esc_html_e( 'Previous Slide', 'foodie-world' ); ?></span></button>

					<!-- empty element for pager links -->
					<div id="testimonial-slider-pager" class="cycle-pager"></div>

					<!-- next link -->
					<button id="testimonial-slider-next" class="cycle-next" aria-label="<?php esc_attr_e( 'Next', 'foodie-world' ); ?>"><span class="screen-reader-text"><?php esc_html_e( 'Next Slide', 'foodie-world' ); ?></span></button>
				</div><!-- #controller-->


				<div class="testimonial-slider-wrap">
			<?php endif; ?>
			<?php
				get_template_part( 'template-parts/testimonials/post-types', 'testimonial' );
			?>
				</div><!-- .testimonial-slider-wrap -->
			</div><!-- .cycle-slideshow -->
			<!-- prev/next links -->
			<div class="cycle-prev fa fa-angle-left" aria-label="<?php esc_attr_e( 'Previous', 'foodie-world' ); ?>" aria-hidden="true"><span class="screen-reader-text"><?php esc_html_e( 'Previous Slide', 'foodie-world' ); ?></span></div>
			<div class="cycle-next fa fa-angle-right" aria-label="<?php esc_attr_e( 'Next', 'foodie-world' ); ?>" aria-hidden="true"><span class="screen-reader-text"><?php esc_html_e( 'Next Slide', 'foodie-world' ); ?></span></div>

		</div><!-- .section-content-wrap -->
	</div><!-- .wrapper -->
</div><!-- .testimonials-content-wrapper -->

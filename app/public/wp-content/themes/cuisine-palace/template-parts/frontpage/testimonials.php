<?php
/**
 * Template part file for the frontpage testimonials section.
 *
 * @package cuisine-palace
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cuisine_palace_panel_id   = 'cuisine_palace_frontpage';
$cuisine_palace_section_id = 'cuisine_palace_frontpage_testimonials';

$enable_section = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_section' );

if ( ! $enable_section ) {
	return;
}


$heading     = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'heading' );
$sub_heading = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'sub_heading' );
$content     = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'content' );


$args = array(
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'ignore_sticky_posts' => 1,
	'posts_per_page'      => 4,
	'tax_query'           => array(
		array(
			'taxonomy' => 'category',
			'field'    => 'slug',
			'terms'    => $content,
		),
	),
);


$the_query = new WP_Query( $args );

?>

<!-------------------------- Testimonial ------------------------------------>
<section class="testimonial section">
	<div class="wrapper">

		<?php if ( $heading || $sub_heading ) { ?>
			<div class="section-header">
				<div class="container">
					<div class="section-header-content">

						<?php if ( $heading ) { ?>
							<p class="sub-title"><?php echo esc_html( $heading ); ?></p>
						<?php } ?>

						<?php if ( $sub_heading ) { ?>
							<h2 class="title"><?php echo esc_html( $sub_heading ); ?></h2>
						<?php } ?>

					</div>
				</div>
			</div>
		<?php } ?>


		<?php if ( $content && $the_query->have_posts() ) { ?>
			<div class="section-content">
				<div class="container">
					<div class="testimonial-detail">
						<div class="wrapper">
							<!-- ---------------------testimonial content------------------------- -->
							<div class="slider testimonial-slider-for slider-for">

								<?php
								while ( $the_query->have_posts() ) {
									$the_query->the_post();
									?>

									<div>
										<div class="slider-container">
											<div class="client-saying">
												<?php the_content(); ?>
											</div>
											<div class="client-detail">
												<?php the_title( '<h3 class="client-name">', '</h3>' ); ?>
												<!-- <p class="client-position"> Graphic Desiger</p> -->
											</div>

										</div>
									</div>
									<?php
								}
								?>




							</div>
							<!-- ----------------------------------------------------------- -->

							<!-- ---------------------client thumb------------------------- -->
							<div class="testimonial-slider-nav ">

								<?php
								while ( $the_query->have_posts() ) {
									$the_query->the_post();
									?>
									<div class="slider-thumb">

										<div class="thumb-image-container">
											<?php the_post_thumbnail(); ?>
										</div>

									</div>
									<?php
								}
								?>

							</div>
							<!-- ----------------------------------------------------------- -->

						</div>

					</div>
				</div>
			</div>
		<?php } ?>

	</div>
</section>
<!-- ------------------------------------------------------------------------>
<?php

wp_reset_postdata();

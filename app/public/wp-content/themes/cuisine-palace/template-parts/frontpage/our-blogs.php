<?php

/**
 * Template part file for the frontpage our blogs section.
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
$cuisine_palace_section_id = 'cuisine_palace_frontpage_our_blogs';


$enable_section = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_section' );

if ( ! $enable_section ) {
	return;
}

$heading     = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'heading' );
$sub_heading = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'sub_heading' );
$display_by  = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'display_by' );
$terms       = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'terms' );
$numberposts = (int) cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'numberposts' );


$args = array(
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'ignore_sticky_posts' => 1,
	'posts_per_page'      => $numberposts,
);

if ( 'category' === $display_by ) {

	$args['tax_query'] = array(
		array(
			'taxonomy' => 'category',
			'field'    => 'slug',
			'terms'    => $terms,
		),
	);

}

$the_query = new WP_Query( $args );

?>
<!-------------------------- Blog  ------------------------------------------>
<section class="blog section">
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


		<div class="section-content">
			<div class="container">
				<div class="blog-detail">
					<div class="blog-slider">
						<?php
						while ( $the_query->have_posts() ) {
							$the_query->the_post();

							get_template_part( 'template-parts/frontpage/loops/content', 'our-blogs' );
						}
						?>

					</div>

					<div class="button">
						<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>" class="btn-secondary btn-large btn-prop"><?php esc_html_e( 'Explore More', 'cuisine-palace' ); ?></a>
					</div>

				</div>
			</div>
		</div>

	</div>
</section>
<!-- ------------------------------------------------------------------------>
<?php
wp_reset_postdata();

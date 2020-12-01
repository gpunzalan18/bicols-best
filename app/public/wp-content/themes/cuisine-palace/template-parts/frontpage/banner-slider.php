<?php
/**
 * Template part file for the frontpage banner slider section.
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
$cuisine_palace_section_id = 'cuisine_palace_frontpage_banner_slider';

$enable_section = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_section' );

if ( ! $enable_section ) {
	return;
}

$slider_contents = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'slider_contents' );

$args = array(
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'posts_per_page'      => 4,
	'ignore_sticky_posts' => 1,
	'post__in'            => $slider_contents,
);

$the_query = new WP_Query( $args );
?>
<main class="banner-container">

	<?php if ( $the_query->have_posts() ) { ?>
		<div class="wrapper">

			<!-- ---------------------slider image------------------------- -->
			<div id="content" class="slider banner-slider-for slider-for">
				<?php
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					get_template_part( 'template-parts/frontpage/loops/content', 'banner-slider' );
				}
				?>
			</div>
			<!-- ----------------------------------------------------------- -->

			<!-- ---------------------slider thumb------------------------- -->
			<div class="container">
				<div class="slider slider-nav">
					<?php
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						?>
						<div class="slider-thumb thumb">
							<div class="thumb-image-container">
								<?php the_post_thumbnail(); ?>
							</div>
						</div>
						<?php
					}
					?>
				</div>
			</div>
			
			<!-- ----------------------------------------------------------- -->
		</div>
	<?php } ?>

</main>
<?php
wp_reset_postdata();

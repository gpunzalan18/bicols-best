<?php

/**
 * Template part file for the frontpage contact us section.
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
$cuisine_palace_section_id = 'cuisine_palace_frontpage_contact_us';

$enable_section = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_section' );

if ( ! $enable_section ) {
	return;
}


$content_left     = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'content_left' );
$content_right    = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'content_right' );
$background_type  = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'background_type' );
$location         = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'location' );
$background_image = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'background_image' );

$location_url = "//maps.google.com/maps?q={$location}&t=&z=13&ie=UTF8&iwloc=&output=embed";

?>

<!---------------------------- contact us --------------------------------->
<section class="contact-us">
	<div class="wrapper">

		<div class="section-wrapper">
			<div class="contact-us-content">
				<div class="map">

					<?php if ( 'map' === $background_type ) { ?>
						<div class="mapouter">
							<div class="gmap_canvas">
								<iframe width="100%" height="576" id="gmap_canvas" src="<?php echo esc_url( $location_url ); ?>" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
							</div>
						</div>
					<?php } ?>

					<?php if ( 'image' === $background_type ) { ?>
						<div class="mapouter">
							<div class="gmap_canvas">
								<img class="contact-section-bg-img" src="<?php echo esc_url( $background_image ); ?>" >
							</div>
						</div>
					<?php } ?>

					<div class="contact-detail-container <?php echo esc_attr( $background_type ); ?>">
						<div class="container">
							<div class="grid-box">
								<?php
								$query_left = new WP_Query(
									array(
										'post_type'   => get_post_type( $content_left ),
										'post_status' => 'publish',
										'p'           => $content_left,
									)
								);

								while ( $query_left->have_posts() ) {
									$query_left->the_post();
									?>
									<div class="column">
										<div class="contact-user-detail-container-wrapper  ">
											<?php

											the_title( '<h2 class="title">', '</h2>' );

											the_content();

											?>
										</div>
									</div>
									<?php
								}

								wp_reset_postdata();


								$query_right = new WP_Query(
									array(
										'post_type'   => get_post_type( $content_right ),
										'post_status' => 'publish',
										'p'           => $content_right,
									)
								);

								while ( $query_right->have_posts() ) {
									$query_right->the_post();
									?>
									<div class="column">
										<div class="contact-detail-container-wrapper">
											<?php

											the_title( '<h2 class="title">', '</h2>' );

											the_content();

											?>
										</div>
									</div>
									<?php
								}

								wp_reset_postdata();
								?>

							</div>

						</div>


					</div>

				</div>
			</div>
		</div>
	</div>
</section>
<!-- ------------------------------------------------------------------- -->

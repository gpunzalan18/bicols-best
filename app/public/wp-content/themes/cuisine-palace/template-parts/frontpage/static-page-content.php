<?php
/**
 * This file helps to display the static frontpage content.
 *
 * @package cuisine-palace
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cuisine_palace_panel_id   = 'cuisine_palace_wp_core_homepage_settings';
$cuisine_palace_section_id = 'static_front_page';

if ( ! cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'display_static_content' ) ) {
	return;
}

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		?>
		<section class="section static-frontpage-content">
			<div class="wrapper">
				<?php
				the_title(
					'<div class="section-header"><div class="container"><div class="section-header-content"><h2 class="title">',
					'</h2></div></div></div>'
				);

				if ( get_the_content() ) {
					?>
					<div class="section-content">
						<div class="container">
							<div class="reservation-detail">
								<?php the_content(); ?>
							</div>
						</div>
					</div>
					<?php
				}
				?>
			</div>
		</section>
		<?php
	}
}


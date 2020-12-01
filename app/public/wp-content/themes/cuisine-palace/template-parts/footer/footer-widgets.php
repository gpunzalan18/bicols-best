<?php
/**
 * This file provides the html part for the footer widgets.
 *
 * @package cuisine-palace
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$footer_widget_areas = apply_filters(
	'cuisine_palace_footer_widget_area_ids',
	array(
		'cuisine_palace_footer_one',
		'cuisine_palace_footer_two',
		'cuisine_palace_footer_three',
		'cuisine_palace_footer_four',
	)
);

$enable = cuisine_palace_is_footer_widgets_enabled( $footer_widget_areas );

if ( $enable && is_array( $footer_widget_areas ) && count( $footer_widget_areas ) > 0 ) {
	?>
	<div class="footer-layout-wrapper">
		<?php
		foreach ( $footer_widget_areas as $footer_widget_area ) {
			if ( is_active_sidebar( $footer_widget_area ) ) {
				?>
				<div class="grid-item">
					<?php dynamic_sidebar( $footer_widget_area ); ?>
				</div>
				<?php
			}
		}
		?>
	</div>
	<?php
}

<?php
/**
 * Template file for the theme static front page.
 *
 * @package cuisine-palace
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( 'page' === get_option( 'show_on_front' ) ) {

	get_header();

	?>

	<!-- ----------------theme section-------------------------------------------- -->
	<div class="section-collection">

		<?php

		/**
		 * Hook - cuisine_palace_frontpage
		 *
		 * @see - cuisine_palace_hook_frontpage_sections()
		 */
		do_action( 'cuisine_palace_frontpage' );

		?>

	</div>
	<!-- ----------------theme section-------------------------------------------- -->

	<?php
	get_footer();

} else {
	get_template_part( 'index' );
}

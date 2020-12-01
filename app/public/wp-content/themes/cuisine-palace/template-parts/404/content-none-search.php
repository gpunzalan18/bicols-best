<?php
/**
 * Template part file for content-none.php file.
 * It is used when a search query is not found.
 *
 * @package cuisine-palace
 * @subpackage template-parts/404
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

	<div class="error-404-wrapper">
		<span class="error"><?php esc_html_e( 'Oops!', 'cuisine-palace' ); ?></span>
	</div>

	<div class="error-info">
		<?php

		/* translators: %s is the search query string. */
		printf( '<p>' . esc_html__( 'No results found for "%s"', 'cuisine-palace' ) . '</p>', get_search_query() );

		?>
		<p><?php esc_html_e( 'May be try another search?', 'cuisine-palace' ); ?></p>
	</div>

	<div class="button-item search-404-form">
		<?php get_search_form(); ?>
	</div>

<?php

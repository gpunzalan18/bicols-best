<?php
/**
 * Template part file for content-none.php file.
 * It is used when a page is not found.
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
		<div class="text-404">
			<span class="text-1"><?php esc_html_e( '4', 'cuisine-palace' ); ?></span>
			<span class="text-2">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/four-oh-four.png' ); ?>">
			</span>
			<span class="text-3"><?php esc_html_e( '4', 'cuisine-palace' ); ?></span>
		</div>
		<span class="error"><?php esc_html_e( 'Error.', 'cuisine-palace' ); ?></span>
	</div>

	<div class="error-info">
		<p><?php esc_html_e( 'We could not find the page you are looking for.', 'cuisine-palace' ); ?></p>
	</div>

	<div class="button-item">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-primary btn-large btn-prop own-prop"><?php esc_html_e( 'Back to home', 'cuisine-palace' ); ?></a>
	</div>

<?php

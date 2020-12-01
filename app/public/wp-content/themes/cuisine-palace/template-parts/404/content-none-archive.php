<?php
/**
 * Template part file for content-none.php file.
 * It is used when a category or archive has no posts or content available.
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
		<p>
			<?php esc_html_e( 'No posts available at the moment', 'cuisine-palace' ); ?>
		</p>
	</div>

	<div class="button-item">
		<a href="<?php echo esc_url( get_site_url() ); ?>" class="btn-primary btn-large btn-prop own-prop"><?php esc_html_e( 'Back to home', 'cuisine-palace' ); ?></a>
	</div>

<?php

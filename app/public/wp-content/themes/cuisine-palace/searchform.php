<?php
/**
 * The searchform.php template.
 *
 * Used any time that get_search_form() is called.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cuisine-palace
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'cuisine-palace' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'cuisine-palace' ); ?>" value="<?php echo get_search_query(); ?>" name="s">
	</label>
	<button type="submit" class="search-submit">
		<i class="fas fa-search"></i>
		<span class="screen-reader-text"><?php esc_html_e( 'Search', 'cuisine-palace' ); ?></span>
	</button>
</form>

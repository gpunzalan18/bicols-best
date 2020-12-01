<?php
/**
 * This file provides the sidebar template when the get_sidebar() is called.
 *
 * @see https://developer.wordpress.org/reference/functions/get_sidebar/
 * @package cuisine-palace
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! is_active_sidebar( 'cuisine_palace_sidebar' ) ) {
	return;
}

$cuisine_palace_panel_id   = 'cuisine_palace_theme_options';
$cuisine_palace_section_id = 'cuisine_palace_theme_options_layouts';

$singular_layout            = is_single() ? 'post_layout' : 'page_layout';
$cuisine_palace_layout_type = is_singular() ? $singular_layout : 'archive_layout';
$cuisine_palace_layout      = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, $cuisine_palace_layout_type );

if ( 'has-no-sidebar' === $cuisine_palace_layout ) {
	return;
}

?>
<!-- -------------------------------------------------------- -->
<div id="secondary" class="secondary">
	<div class="secondary-wrapper">
		<?php dynamic_sidebar( 'cuisine_palace_sidebar' ); ?>
	</div>
</div>

<?php
/**
 * The template used for displaying hero content
 *
 * @package Foodie_World
 */
?>

<?php
$enable_section = get_theme_mod( 'foodie_world_hero_content_visibility', 'disabled' );

if ( ! foodie_world_check_section( $enable_section ) ) {
	// Bail if hero content is not enabled
	return;
}
get_template_part( 'template-parts/hero-content/post-type', 'hero' );

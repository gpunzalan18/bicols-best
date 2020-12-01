<?php
/**
 * The template used for displaying promotion_headline content
 *
 * @package Foodie_World
 */
?>

<?php
$enable_section = get_theme_mod( 'foodie_world_promotion_headline_visibility', 'homepage' );

if ( ! foodie_world_check_section( $enable_section ) ) {
	// Bail if promotion_headline content is not enabled
	return;
}

$type = get_theme_mod( 'foodie_world_promotion_headline_type', 'page' );

if ( 'page' === $type || 'post' === $type || 'category' === $type ) :
	get_template_part( 'template-parts/promotion-headline/post-type', 'promotion-headline' );
else :
	get_template_part( 'template-parts/promotion-headline/image', 'promotion-headline' );
endif;

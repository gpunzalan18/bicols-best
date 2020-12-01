<?php
/**
 * The template for displaying food_menu items
 *
 * @package Foodie_World
 */
?>

<?php
$enable = get_theme_mod( 'foodie_world_food_menu_option', 'disabled' );

if ( ! foodie_world_check_section( $enable ) ) {
	// Bail if featured content is disabled
	return;
}


$headline    = get_theme_mod( 'foodie_world_food_menu_headline', esc_html__( 'Our Menu', 'foodie-world' ) );
$subheadline = get_theme_mod( 'foodie_world_food_menu_subheadline' );
?>

<div class="menu-content-wrapper section cpt">
	<div class="wrapper">
		<?php if ( $headline || $subheadline ) : ?>
			<div class="section-heading-wrapper">
			<?php if ( $headline ) : ?>
				<div class="section-title-wrapper">
					<h2 class="section-title"><?php echo wp_kses_post( $headline ); ?></h2>
				</div>
			<?php endif; ?>

			<?php if ( $subheadline ) : ?>
				<div class="section-description">
					<?php echo wp_kses_post( $subheadline ); ?>
				</div><!-- .section-description -->
			<?php endif; ?>
			</div><!-- .section-heading-wrap -->
		<?php endif; ?>

		<div class="section-content-wrapper">
			<?php
				get_template_part( 'template-parts/food-menu/cat-cpt', 'menu' );
			?>

			<?php
			$target = get_theme_mod( 'foodie_world_food_menu_more_target' ) ? '_blank': '_self';
			$link   = get_theme_mod( 'foodie_world_food_menu_more_link', '#' );
			$text   = get_theme_mod( 'foodie_world_food_menu_more_text', esc_html__( 'More', 'foodie-world' ) );

			if ( $text ) : ?>
			<p class="more-button">
				<a class="more-link" target="<?php echo $target; ?>" href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $text ); ?></a>
			</p>
		<?php endif; ?>
		</div><!-- .section-content-wrap -->
	</div><!-- .wrapper -->
</div><!-- .menu-content-wrapper -->

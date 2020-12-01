<?php
/**
 * The template for displaying search form
 *
 * @package Foodie_World
 */
?>

<?php
$unique_id   = esc_attr( uniqid( 'search-form-' ) );
$search_text = get_theme_mod( 'foodie_world_search_text', esc_html__( 'Search ...', 'foodie-world' ) );
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo $unique_id; ?>">
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'foodie-world' ); ?></span>
		<input type="search" id="<?php echo $unique_id; ?>" class="search-field" placeholder="<?php echo esc_attr( $search_text ); ?>" value="<?php the_search_query(); ?>" name="s" title="<?php echo esc_attr( _x( 'Search for:', 'label', 'foodie-world' ) ); ?>">
	</label>
		
	<button type="submit" class="search-submit fa fa-search"></button>
</form>

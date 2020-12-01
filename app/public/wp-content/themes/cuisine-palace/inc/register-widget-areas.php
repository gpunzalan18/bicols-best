<?php
/**
 * We register our widget areas or widget sidebar in this file.
 *
 * @package cuisine-palace
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'cuisine_palace_register_widget_areas' ) ) {

	/**
	 * Register the required sidebar or widget areas.
	 */
	function cuisine_palace_register_widget_areas() {

		register_sidebar(
			array(
				'id'            => 'cuisine_palace_sidebar',
				'name'          => esc_html__( 'Sidebar', 'cuisine-palace' ),
				'description'   => esc_html__( 'Widget area for theme sidebar, it is located in blog page, post archives, single pages and posts.', 'cuisine-palace' ),
				'before_widget' => '<div id="%1$s" class="wordpress-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

		register_sidebar(
			array(
				'id'            => 'cuisine_palace_footer_one',
				'name'          => esc_html__( 'Footer Widget One', 'cuisine-palace' ),
				'description'   => esc_html__( 'First footer widget area.', 'cuisine-palace' ),
				'before_widget' => '<div id="%1$s" class="wordpress-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

		register_sidebar(
			array(
				'id'            => 'cuisine_palace_footer_two',
				'name'          => esc_html__( 'Footer Widget Two', 'cuisine-palace' ),
				'description'   => esc_html__( 'Second footer widget area.', 'cuisine-palace' ),
				'before_widget' => '<div id="%1$s" class="wordpress-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

		register_sidebar(
			array(
				'id'            => 'cuisine_palace_footer_three',
				'name'          => esc_html__( 'Footer Widget Three', 'cuisine-palace' ),
				'description'   => esc_html__( 'Third footer widget area.', 'cuisine-palace' ),
				'before_widget' => '<div id="%1$s" class="wordpress-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

		register_sidebar(
			array(
				'id'            => 'cuisine_palace_footer_four',
				'name'          => esc_html__( 'Footer Widget Four', 'cuisine-palace' ),
				'description'   => esc_html__( 'Fourth footer widget area.', 'cuisine-palace' ),
				'before_widget' => '<div id="%1$s" class="wordpress-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

	}
	add_action( 'widgets_init', 'cuisine_palace_register_widget_areas' );
}

<?php
/**
 * This file hooks and frontpage sections.
 *
 * @package cuisine-palace
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



if ( ! function_exists( 'cuisine_palace_frontpage_banner_slider' ) ) {

	/**
	 * Frontpage banner slider section.
	 */
	function cuisine_palace_frontpage_banner_slider() {
		get_template_part( 'template-parts/frontpage/banner-slider' );
	}
}




if ( ! function_exists( 'cuisine_palace_frontpage_who_we_are' ) ) {

	/**
	 * Frontpage who we are section.
	 */
	function cuisine_palace_frontpage_who_we_are() {
		get_template_part( 'template-parts/frontpage/who-we-are' );
	}
}



if ( ! function_exists( 'cuisine_palace_frontpage_what_we_do' ) ) {

	/**
	 * Frontpage what we do section.
	 */
	function cuisine_palace_frontpage_what_we_do() {
		get_template_part( 'template-parts/frontpage/what-we-do' );
	}
}



if ( ! function_exists( 'cuisine_palace_frontpage_menu_lists' ) ) {

	/**
	 * Frontpage menu lists section.
	 */
	function cuisine_palace_frontpage_menu_lists() {
		get_template_part( 'template-parts/frontpage/menu-lists' );
	}
}



if ( ! function_exists( 'cuisine_palace_frontpage_our_blogs' ) ) {

	/**
	 * Frontpage our blogs section.
	 */
	function cuisine_palace_frontpage_our_blogs() {
		get_template_part( 'template-parts/frontpage/our-blogs' );
	}
}




if ( ! function_exists( 'cuisine_palace_frontpage_book_your_table' ) ) {

	/**
	 * Frontpage book your table section.
	 */
	function cuisine_palace_frontpage_book_your_table() {
		get_template_part( 'template-parts/frontpage/book-your-table' );
	}
}




if ( ! function_exists( 'cuisine_palace_frontpage_testimonials' ) ) {

	/**
	 * Frontpage book your table section.
	 */
	function cuisine_palace_frontpage_testimonials() {
		get_template_part( 'template-parts/frontpage/testimonials' );
	}
}




if ( ! function_exists( 'cuisine_palace_frontpage_contact_us' ) ) {

	/**
	 * Frontpage book your table section.
	 */
	function cuisine_palace_frontpage_contact_us() {
		get_template_part( 'template-parts/frontpage/contact-us' );
	}
}



if ( ! function_exists( 'cuisine_palace_frontpage_static_page_content' ) ) {

	/**
	 * Frontpage book your table section.
	 */
	function cuisine_palace_frontpage_static_page_content() {
		get_template_part( 'template-parts/frontpage/static-page-content' );
	}
}



if ( ! function_exists( 'cuisine_palace_hook_frontpage_sections' ) ) {

	/**
	 * Hooks the frontpage sections to the static frontpage file.
	 */
	function cuisine_palace_hook_frontpage_sections() {

		$callbacks = apply_filters(
			'cuisine_palace_frontpage_callback_sections',
			array(
				'cuisine_palace_frontpage_banner_slider',
				'cuisine_palace_frontpage_who_we_are',
				'cuisine_palace_frontpage_what_we_do',
				'cuisine_palace_frontpage_menu_lists',
				'cuisine_palace_frontpage_our_blogs',
				'cuisine_palace_frontpage_book_your_table',
				'cuisine_palace_frontpage_testimonials',
				'cuisine_palace_frontpage_contact_us',
				'cuisine_palace_frontpage_static_page_content',
			)
		);

		if ( ! empty( $callbacks ) && is_array( $callbacks ) ) {
			$priority = 15;
			foreach ( $callbacks as $callback ) {
				add_action( 'cuisine_palace_frontpage', $callback, $priority );
				$priority = $priority + 5;
			}
		}
	}
	add_action( 'cuisine_palace_after_header_wrapper', 'cuisine_palace_hook_frontpage_sections' );
}

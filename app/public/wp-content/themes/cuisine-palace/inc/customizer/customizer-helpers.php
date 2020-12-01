<?php
/**
 * This file has the important functions required for the customizer.
 *
 * @package cuisine-palace
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Function to register control and setting.
 */
function cuisine_palace_register_option( $wp_customize, $option ) {

	// Initialize Setting.
	$wp_customize->add_setting(
		$option['name'],
		array(
			'sanitize_callback' => $option['sanitize_callback'],
			'default'           => isset( $option['default'] ) ? $option['default'] : '',
			'transport'         => isset( $option['transport'] ) ? $option['transport'] : 'refresh',
			'theme_supports'    => isset( $option['theme_supports'] ) ? $option['theme_supports'] : '',
		)
	);

	$control = array(
		'label'    => $option['label'],
		'section'  => $option['section'],
		'settings' => $option['name'],
	);

	if ( isset( $option['active_callback'] ) ) {
		$control['active_callback'] = $option['active_callback'];
	}

	if ( isset( $option['priority'] ) ) {
		$control['priority'] = $option['priority'];
	}

	if ( isset( $option['choices'] ) ) {
		$control['choices'] = $option['choices'];
	}

	if ( isset( $option['type'] ) ) {
		$control['type'] = $option['type'];
	}

	if ( isset( $option['input_attrs'] ) ) {
		$control['input_attrs'] = $option['input_attrs'];
	}

	if ( isset( $option['description'] ) ) {
		$control['description'] = $option['description'];
	}

	if ( isset( $option['mime_type'] ) ) {
		$control['mime_type'] = $option['mime_type'];
	}

	if ( ! empty( $option['custom_control'] ) ) {
		$wp_customize->add_control( new $option['custom_control']( $wp_customize, $option['name'], $control ) );
	} else {
		$wp_customize->add_control( $option['name'], $control );
	}
}

if ( ! function_exists( 'cuisine_palace_customizer_get_name' ) ) {

	/**
	 * Generates the formated string for the control name attr.
	 *
	 * @param string $panel Customizer panel id.
	 * @param string $section Customizer section id.
	 * @param string $control Customizer control id.
	 */
	function cuisine_palace_customizer_get_name( $panel, $section, $control ) {
		$mod_prefix = 'cuisine_palace_theme_mods';
		return "{$mod_prefix}[{$panel}][$section][{$control}]";
	}
}

if ( ! function_exists( 'cuisine_palace_get_theme_mod' ) ) {

	/**
	 * Returns the theme mod value according to the parameter passed.
	 *
	 * @param string $panel Customizer panel id.
	 * @param string $section Customizer section id.
	 * @param string $control Customizer control id.
	 * @param bool   $ignore_default Pass true if you don't want to get the default value as fallback.
	 */
	function cuisine_palace_get_theme_mod( $panel, $section, $control, $ignore_default = false ) {
		$default = ! $ignore_default ? cuisine_palace_customizer_defaults( $panel, $section, $control ) : false;
		$options = get_theme_mod( 'cuisine_palace_theme_mods' );
		return isset( $options[ $panel ][ $section ][ $control ] ) ? $options[ $panel ][ $section ][ $control ] : $default;
	}
}

if ( ! function_exists( 'cuisine_palace_customizer_get_terms' ) ) {

	/**
	 * Returns the formatted array for terms choices.
	 */
	function cuisine_palace_customizer_get_terms() {

		$items = array();
		$terms = get_terms(
			array(
				'taxonomy'   => 'category',
				'hide_empty' => true,
			)
		);

		$items['none'] = esc_html__( 'No post available', 'cuisine-palace' );

		if ( is_array( $terms ) && count( $terms ) > 0 ) {
			$items['none'] = esc_html__( '---Select---', 'cuisine-palace' );
			foreach ( $terms as $term ) {
				$term_name           = ! empty( $term->name ) ? $term->name : '';
				$term_slug           = ! empty( $term->slug ) ? $term->slug : '';
				$items[ $term_slug ] = $term_name;
			}
		}

		return $items;
	}
}

if ( ! function_exists( 'cuisine_palace_customizer_get_posts' ) ) {

	/**
	 * Returns the array of posts.
	 */
	function cuisine_palace_customizer_get_posts() {

		$data = array();

		$data['none'] = esc_html__( '---Select---', 'cuisine-palace' );

		$query_posts = new WP_Query(
			array(
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
			)
		);
		if ( $query_posts->have_posts() ) {
			$data['optgroup_start_posts'] = esc_html__( 'Posts', 'cuisine-palace' );
			while ( $query_posts->have_posts() ) {
				$query_posts->the_post();
				$data[ get_the_ID() ] = get_the_title();
			}
			$data['optgroup_end_posts'] = '';
		}
		wp_reset_postdata();

		return $data;

	}
}

if ( ! function_exists( 'cuisine_palace_customizer_get_pages' ) ) {

	/**
	 * Returns the array of pages.
	 */
	function cuisine_palace_customizer_get_pages() {
		$data = array();

		$data['none'] = esc_html__( '---Select---', 'cuisine-palace' );

		$query_pages = new WP_Query(
			array(
				'post_type'      => 'page',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
			)
		);
		if ( $query_pages->have_posts() ) {
			$data['optgroup_start_pages'] = esc_html__( 'Pages', 'cuisine-palace' );
			while ( $query_pages->have_posts() ) {
				$query_pages->the_post();
				$data[ get_the_ID() ] = get_the_title();
			}
			$data['optgroup_end_pages'] = '';
		}
		wp_reset_postdata();

		return $data;
	}
}

if ( ! function_exists( 'cuisine_palace_customizer_get_posts_and_pages' ) ) {

	/**
	 * Returns the array of posts for customizer controls.
	 *
	 * @return array $data Post array for customizer.
	 */
	function cuisine_palace_customizer_get_posts_and_pages() {

		$data = array();

		$data['none'] = esc_html__( '---Select---', 'cuisine-palace' );

		$query_posts = new WP_Query(
			array(
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
			)
		);
		if ( $query_posts->have_posts() ) {
			$data['optgroup_start_posts'] = esc_html__( 'Posts', 'cuisine-palace' );
			while ( $query_posts->have_posts() ) {
				$query_posts->the_post();
				$data[ get_the_ID() ] = get_the_title();
			}
			$data['optgroup_end_posts'] = '';
		}
		wp_reset_postdata();

		$query_pages = new WP_Query(
			array(
				'post_type'      => 'page',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
			)
		);
		if ( $query_pages->have_posts() ) {
			$data['optgroup_start_pages'] = esc_html__( 'Pages', 'cuisine-palace' );
			while ( $query_pages->have_posts() ) {
				$query_pages->the_post();
				$data[ get_the_ID() ] = get_the_title();
			}
			$data['optgroup_end_pages'] = '';
		}
		wp_reset_postdata();

		return $data;
	}
}

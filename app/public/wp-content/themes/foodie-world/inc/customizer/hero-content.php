<?php
/**
 * Hero Content Options
 *
 * @package Foodie_World
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function foodie_world_hero_content_options( $wp_customize ) {
	$wp_customize->add_section( 'foodie_world_hero_content_options', array(
			'title' => esc_html__( 'Hero Content', 'foodie-world' ),
			'panel' => 'foodie_world_theme_options',
		)
	);

	foodie_world_register_option( $wp_customize, array(
			'name'              => 'foodie_world_hero_content_visibility',
			'default'           => 'disabled',
			'sanitize_callback' => 'foodie_world_sanitize_select',
			'choices'           => foodie_world_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'foodie-world' ),
			'section'           => 'foodie_world_hero_content_options',
			'type'              => 'select',
		)
	);

	foodie_world_register_option( $wp_customize, array(
			'name'              => 'foodie_world_hero_content',
			'default'           => '0',
			'sanitize_callback' => 'foodie_world_sanitize_post',
			'active_callback'   => 'foodie_world_is_hero_content_active',
			'label'             => esc_html__( 'Page', 'foodie-world' ),
			'section'           => 'foodie_world_hero_content_options',
			'type'              => 'dropdown-pages',
		)
	);

	foodie_world_register_option( $wp_customize, array(
			'name'              => 'foodie_world_disable_hero_content_title',
			'sanitize_callback' => 'foodie_world_sanitize_checkbox',
			'active_callback'   => 'foodie_world_is_hero_content_active',
			'label'             => esc_html__( 'Check to disable title', 'foodie-world' ),
			'section'           => 'foodie_world_hero_content_options',
			'type'              => 'checkbox',
		)
	);

	foodie_world_register_option( $wp_customize, array(
			'name'              => 'foodie_world_hero_content_show',
			'default'           => 'excerpt',
			'sanitize_callback' => 'foodie_world_sanitize_select',
			'active_callback'   => 'foodie_world_is_hero_content_active',
			'choices'           => foodie_world_content_show(),
			'label'             => esc_html__( 'Display Content', 'foodie-world' ),
			'section'           => 'foodie_world_hero_content_options',
			'type'              => 'select',
		)
	);

}
add_action( 'customize_register', 'foodie_world_hero_content_options' );

/** Active Callback Functions **/
if ( ! function_exists( 'foodie_world_is_hero_content_active' ) ) :
	/**
	* Return true if hero content is active
	*
	* @since Foodie World 0.1
	*/
	function foodie_world_is_hero_content_active( $control ) {
		$enable = $control->manager->get_setting( 'foodie_world_hero_content_visibility' )->value();

		//return true only if previewed page on customizer matches the type of content option selected
		return ( foodie_world_check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'foodie_world_is_hero_page_content_active' ) ) :
	/**
	* Return true if hero page content is active
	*
	* @since Foodie World 0.1
	*/
	function foodie_world_is_hero_page_content_active( $control ) {
		$type = $control->manager->get_setting( 'foodie_world_hero_content_type' )->value();

		//return true only if previewed page on customizer matches the type of slider option selected and is not demo slider
		return ( foodie_world_is_hero_content_active( $control ) && 'page' == $type );
	}
endif;

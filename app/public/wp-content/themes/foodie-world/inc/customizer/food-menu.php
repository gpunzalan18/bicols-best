<?php
/**
 * Add Food Menu Settings in Customizer
 *
 * @package Foodie_World
*/

/**
 * Add food_menu options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function foodie_world_food_menu_options( $wp_customize ) {
    $wp_customize->add_section( 'foodie_world_food_menu', array(
            'panel'    => 'foodie_world_theme_options',
            'title'    => esc_html__( 'Food Menus', 'foodie-world' ),
        )
    );

    foodie_world_register_option( $wp_customize, array(
            'name'              => 'foodie_world_foodmenu_note_1',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Foodie_World_Note_Control',
            'active_callback'   => 'foodieworld_is_ect_food_menu_inactive',
            'label'             => sprintf( esc_html__( 'For Food Menu, install %1$sEssential Content Types%2$s Plugin with Food Menu Content Type Enabled', 'foodie-world' ),
                '<a target="_blank" href="https://wordpress.org/plugins/essential-content-types/">',
                '</a>'
            ),
            'section'           => 'foodie_world_food_menu',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    foodie_world_register_option( $wp_customize, array(
            'name'              => 'foodie_world_food_menu_option',
            'default'           => 'disabled',
            'sanitize_callback' => 'foodie_world_sanitize_select',
            'active_callback'   => 'foodieworld_is_ect_food_menu_active',
            'choices'           => foodie_world_section_visibility_options(),
            'label'             => esc_html__( 'Enable on', 'foodie-world' ),
            'section'           => 'foodie_world_food_menu',
            'type'              => 'select',
            'priority'          => 1,
        )
    );

    foodie_world_register_option( $wp_customize, array(
            'name'              => 'foodie_world_food_menu_headline',
            'default'           => esc_html__( 'Our Menu', 'foodie-world' ),
            'sanitize_callback' => 'wp_kses_post',
            'label'             => esc_html__( 'Headline', 'foodie-world' ),
            'active_callback'   => 'foodie_world_is_food_menu_active',
            'section'           => 'foodie_world_food_menu',
            'type'              => 'text',
        )
    );

    foodie_world_register_option( $wp_customize, array(
            'name'              => 'foodie_world_food_menu_subheadline',
            'sanitize_callback' => 'wp_kses_post',
            'label'             => esc_html__( 'Sub headline', 'foodie-world' ),
            'active_callback'   => 'foodie_world_is_food_menu_active',
            'section'           => 'foodie_world_food_menu',
            'type'              => 'text',
        )
    );

    foodie_world_register_option( $wp_customize, array(
            'name'              => 'foodie_world_food_menu_number',
            'default'           => 5,
            'sanitize_callback' => 'foodie_world_sanitize_number_range',
            'active_callback'   => 'foodie_world_is_food_menu_active',
            'label'             => esc_html__( 'No of items', 'foodie-world' ),
            'section'           => 'foodie_world_food_menu',
            'type'              => 'number',
            'input_attrs'       => array(
                'style'             => 'width: 100px;',
                'min'               => 0,
            ),
        )
    );

    $number = get_theme_mod( 'foodie_world_food_menu_number', 5 );

    for ( $i = 1; $i <= $number ; $i++ ) {

        // For CPT - sections
        foodie_world_register_option( $wp_customize, array(
                'name'              => 'foodie_world_food_menu_cpt_' . $i,
                'sanitize_callback' => 'foodie_world_sanitize_select',
                'active_callback'   => 'foodie_world_is_food_menu_active',
                'label'             => esc_html__( 'Menu', 'foodie-world' ) . ' ' . $i ,
                'section'           => 'foodie_world_food_menu',
                'type'              => 'select',
                'choices'           => foodie_world_generate_taxonomy_array( 'ect_food_menu' ),
            )
        );

    } // End for().

    foodie_world_register_option( $wp_customize, array(
            'name'              => 'foodie_world_food_menu_more_text',
            'default'           => esc_html__( 'More', 'foodie-world' ),
            'sanitize_callback' => 'sanitize_text_field',
            'active_callback'   => 'foodie_world_is_food_menu_active',
            'label'             => esc_html__( 'Button Text', 'foodie-world' ),
            'section'           => 'foodie_world_food_menu',
        )
    );

    foodie_world_register_option( $wp_customize, array(
            'name'              => 'foodie_world_food_menu_more_link',
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
            'active_callback'   => 'foodie_world_is_food_menu_active',
            'label'             => esc_html__( 'Button Link', 'foodie-world' ),
            'section'           => 'foodie_world_food_menu',
        )
    );

    foodie_world_register_option( $wp_customize, array(
            'name'              => 'foodie_world_food_menu_more_target',
            'sanitize_callback' => 'foodie_world_sanitize_checkbox',
            'active_callback'   => 'foodie_world_is_food_menu_active',
            'label'             => esc_html__( 'Check to Open Button Link in New Window/Tab', 'foodie-world' ),
            'section'           => 'foodie_world_food_menu',
            'type'              => 'checkbox',
        )
    );
}
add_action( 'customize_register', 'foodie_world_food_menu_options' );

/**
 * Active Callback Functions
 */
if ( ! function_exists( 'foodie_world_is_food_menu_active' ) ) :
    /**
    * Return true if featured content is active
    *
    * @since Foodie World 0.1
    */
    function foodie_world_is_food_menu_active( $control ) {
        $enable = $control->manager->get_setting( 'foodie_world_food_menu_option' )->value();

        return ( foodieworld_is_ect_food_menu_active( $control ) && foodie_world_check_section( $enable ) );
    }
endif;

if ( ! function_exists( 'foodieworld_is_ect_food_menu_inactive' ) ) :
    /**
    * Return true if service is active
    *
    * @since Foodie World 0.1
    */
    function foodieworld_is_ect_food_menu_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Service' ) || class_exists( 'Essential_Content_Pro_Service' ) );
    }
endif;

if ( ! function_exists( 'foodieworld_is_ect_food_menu_active' ) ) :
    /**
    * Return true if service is active
    *
    * @since Foodie World 0.1
    */
    function foodieworld_is_ect_food_menu_active( $control ) {
        return ( class_exists( 'Essential_Content_Service' ) || class_exists( 'Essential_Content_Pro_Service' ) );
    }
endif;

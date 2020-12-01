<?php
/**
 * Lite Manager
 *
 * @package best-food
 * @since 1.0.12
 */


/**
 * About page class
 */
require_once get_stylesheet_directory() . '/custom/ct-about-page/class-ct-about-page.php';

/*
* About page instance
*/
$config = array(
	// Menu name under Appearance.
	'menu_name'           => __( 'About Best Food', 'best-food' ),
	// Page title.
	'page_name'           => __( 'About Best Food', 'best-food' ),
	// Main welcome title
	/* translators: s - theme name */
	'welcome_title'       => sprintf( __( 'Welcome to %s! - Version ', 'best-food' ), 'best-food' ),
	// Main welcome content
	'welcome_content'     => esc_html__( 'Best Food is a clean and beautiful, polished and feature-rich, robust and easy to use, fully responsive premium WordPress theme that is ideal for restaurant, cafe, bakery, cuisine, fast food, pizzerias, drinks and food related business. The theme is loaded with many pre-built home page sections to help you create an amazing modern one-page website without having to write a single line of code. The Best Food free theme displays full screen image banner, About Us section, Service Section, Recent Posts Section and Contact Us form as well as Footer widgets. You have full control including home page section order, font, font size, color, button, opacity of every open section. The theme is optimized for fast loading and extremely responsive with various devices. You can see the demo at http://demos.coothemes.com/?theme-demo=best-food-pro', 'best-food' ),
	/**
	 * Tabs array.
	 *
	 * The key needs to be ONLY consisted from letters and underscores. If we want to define outside the class a function to render the tab,
	 * the will be the name of the function which will be used to render the tab content.
	 */
	'tabs'                => array(
		'getting_started'     => __( 'Getting Started', 'best-food' ),
		/*'recommended_actions' => __( 'Recommended Actions', 'best-food' ),*/
		'recommended_plugins' => __( 'Recommended Plugins', 'best-food' ),
		/*'support'             => __( 'Support', 'best-food' ),*/
		/*'changelog'           => __( 'Changelog', 'best-food' ),*/
		'free_pro'            => __( 'Free vs PRO', 'best-food' ),
	),
	// Support content tab.
	'support_content'     => array(

	),
	// Getting started tab
	'getting_started'     => array(
		'first'  => array(
			'title'               => esc_html__( 'Recommended actions', 'best-food' ),
			'text'                => esc_html__( 'We have compiled a list of steps for you to take so we can ensure that the experience you have using one of our products is very easy to follow.', 'best-food' ),
			'button_label'        => esc_html__( 'Recommended actions', 'best-food' ),
			'button_link'         => esc_url( admin_url( 'themes.php?page=best-food-welcome&tab=recommended_plugins' ) ),
			'is_button'           => false,
			'recommended_actions' => true,
			'is_new_tab'          => false,
		),
		'second' => array(
			'title'               => esc_html__( 'Read full documentation', 'best-food' ),
			'text'                => esc_html__( 'Need more details? Please check our full documentation for detailed information on how to use best-food.', 'best-food' ),
			'button_label'        => esc_html__( 'Documentation', 'best-food' ),
			'button_link'         => 'https://www.coothemes.com/best-food-pro-manual/',
			'is_button'           => false,
			'recommended_actions' => false,
			'is_new_tab'          => true,
		),
		'third'  => array(
			'title'               => esc_html__( 'Go to the Customizer', 'best-food' ),
			'text'                => esc_html__( 'Using the WordPress Customizer you can easily customize every aspect of the theme.', 'best-food' ),
			'button_label'        => esc_html__( 'Go to the Customizer', 'best-food' ),
			'button_link'         => esc_url( admin_url( 'customize.php' ) ),
			'is_button'           => true,
			'recommended_actions' => false,
			'is_new_tab'          => true,
		),
		
		'fourth'  => array(
			'title'        => esc_html__( 'Contact Support', 'best-food' ),
			'text'                => esc_html__( 'We want to make sure you have the best experience using  Best Food, and that is why we have gathered all the necessary information here for you. We hope you will enjoy using  Best Food as much as we enjoy creating great products.', 'best-food' ),
			'button_label'        => esc_html__( 'Contact Support', 'best-food' ),
			'button_link'  => esc_url( 'https://www.coothemes.com/forum/best-food-theme' ),
			'is_button'           => true,
			'recommended_actions' => false,
			'is_new_tab'          => true,
		),
		
		
	),
	// Free vs PRO array.
	'free_pro'            => array(
		'free_theme_name'     => 'best-food',
		'pro_theme_name'      => 'Best Food Pro',
		'pro_theme_link'      => 'https://www.coothemes.com/theme-best-food-pro/',
		/* translators: s - theme name */
		'get_pro_theme_label' => sprintf( __( 'Get %s now!', 'best-food' ), 'Best Food Pro' ),
		'features'            => array(
			array(
				'title'       => __( 'One-page Theme', 'best-food' ),
				//'description' => __( 'Responsive layout. Works on every device.', 'best-food' ),
				'is_in_lite'  => 'true',
				'is_in_pro'   => 'true',
			),
			array(
				'title'       => __( 'Text and Image Logos', 'best-food' ),
				'is_in_lite'  => 'true',
				'is_in_pro'   => 'true',
			),
			
			array(
				'title'       => __( 'Front Page Parallax Image Banner', 'best-food' ),
				'is_in_lite'  => 'true',
				'is_in_pro'   => 'true',
			),			
			
			array(
				'title'       => __( 'Parallax Backgrounds', 'best-food' ),
				'is_in_lite'  => 'true',
				'is_in_pro'   => 'true',
			),			
			
			array(
				'title'       => __( 'Front page section reordering', 'best-food' ),
				'is_in_lite'  => 'true',
				'is_in_pro'   => 'true',
			),
			
			array(
				'title'       => __( 'Full screen front page banner', 'best-food' ),
				'is_in_lite'  => 'true',
				'is_in_pro'   => 'true',
			),			
			
			array(
				'title'       => __( 'Front page about us section', 'best-food' ),
				'is_in_lite'  => 'true',
				'is_in_pro'   => 'true',
			),
						
			array(
				'title'       => __( 'Front page service section', 'best-food' ),
				'is_in_lite'  => 'true',
				'is_in_pro'   => 'true',
			),			
			
			array(
				'title'       => __( 'Front page blog section', 'best-food' ),
				'is_in_lite'  => 'true',
				'is_in_pro'   => 'true',
			),
			
			array(
				'title'       => __( 'Footer copyright editor', 'best-food' ),
				'is_in_lite'  => 'true',
				'is_in_pro'   => 'true',
			),			
			
			array(
				'title'       => __( 'Multiple blog layouts', 'best-food' ),
				'is_in_lite'  => 'true',
				'is_in_pro'   => 'true',
			),			
			
			array(
				'title'       => __( 'Footer widgets', 'best-food' ),
				'is_in_lite'  => 'true',
				'is_in_pro'   => 'true',
			),
			
			array(
				'title'       => __( 'Front page menu section', 'best-food' ),
				'is_in_lite'  => 'false',
				'is_in_pro'   => 'true',
			),			
			
			array(
				'title'       => __( 'Front page reserve now section', 'best-food' ),
				'is_in_lite'  => 'false',
				'is_in_pro'   => 'true',
			),		
						
			array(
				'title'       => __( 'Front page image and video slider', 'best-food' ),
				'is_in_lite'  => 'false',
				'is_in_pro'   => 'true',
			),			
			
			array(
				'title'       => __( 'Front page why choose us section', 'best-food' ),
				'is_in_lite'  => 'false',
				'is_in_pro'   => 'true',
			),	
			
			array(
				'title'       => __( 'Front page team section', 'best-food' ),
				'is_in_lite'  => 'false',
				'is_in_pro'   => 'true',
			),			
			
			array(
				'title'       => __( 'Front page facts section', 'best-food' ),
				'is_in_lite'  => 'false',
				'is_in_pro'   => 'true',
			),	
			
			array(
				'title'       => __( 'Front page gallery section', 'best-food' ),
				'is_in_lite'  => 'false',
				'is_in_pro'   => 'true',
			),			
			
			array(
				'title'       => __( 'Front page testimonial section', 'best-food' ),
				'is_in_lite'  => 'false',
				'is_in_pro'   => 'true',
			),		
						
			array(
				'title'       => __( 'Front page events section', 'best-food' ),
				'is_in_lite'  => 'false',
				'is_in_pro'   => 'true',
			),			
			
			array(
				'title'       => __( 'Google map', 'best-food' ),
				'is_in_lite'  => 'false',
				'is_in_pro'   => 'true',
			),	
			
			array(
				'title'       => __( 'Google fonts', 'best-food' ),
				'is_in_lite'  => 'false',
				'is_in_pro'   => 'true',
			),			
			
			array(
				'title'       => __( 'Shortcode', 'best-food' ),
				'is_in_lite'  => 'false',
				'is_in_pro'   => 'true',
			),				
			
			array(
				'title'       => __( 'Multiple page template', 'best-food' ),
				'is_in_lite'  => 'false',
				'is_in_pro'   => 'true',
			),				
			
			array(
				'title'       => __( 'Woocommerce compatible', 'best-food' ),
				'is_in_lite'  => 'false',
				'is_in_pro'   => 'true',
			),				
			
			array(
				'title'       => __( 'Unlimited color choices', 'best-food' ),
				'is_in_lite'  => 'false',
				'is_in_pro'   => 'true',
			),							
			array(
				'title'       => __( 'Automatic Updates', 'best-food' ),
				'is_in_lite'  => 'true',
				'is_in_pro'   => 'true',
			),				
			
						
		),
	),
	
	// Plugins array.
	'recommended_plugins' => array(
		'already_activated_message' => esc_html__( 'Already activated', 'best-food' ),
		'version_label'             => esc_html__( 'Version: ', 'best-food' ),
		'install_label'             => esc_html__( 'Install and Activate', 'best-food' ),
		'activate_label'            => esc_html__( 'Activate', 'best-food' ),
		'deactivate_label'          => esc_html__( 'Deactivate', 'best-food' ),
		'content'                   => array(
			array(
				'slug' => 'kirki',
			),
			
			
			array(
				'slug' => 'contact-form-7',
			),
			array(
				'slug' => 'wp-google-maps',
			),						
		),
	),

);
Coothemes_About_Page::init( apply_filters( 'best_food_about_page_array', $config ) );


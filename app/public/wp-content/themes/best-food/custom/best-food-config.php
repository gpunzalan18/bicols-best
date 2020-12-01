<?php
/**
 * Kirki Advanced Customizer
 * This is a sample configuration file to demonstrate all fields & capabilities.
 * @package best_food
 */
// Early exit if Kirki is not installed

 $imagepath =  get_stylesheet_directory_uri() . '/custom/images/'; 
 
  if ( !class_exists( 'Kirki' ) ) {
	return;
  }
  

  Kirki::add_config( 'best_food_settings', array(
  	'capability'	 => 'edit_theme_options',
  	'option_type'	 => 'theme_mod',
  ) );
 
 

//==========homepage ==========
//  add panel 
  Kirki::add_panel( 'homepage', array(
  	'priority'	 => 10,
  	'title'		 => __( 'FrontPage Settings', 'best-food' ),
    'description'	 => __( 'Homepage options for Best Food theme', 'best-food' ),
  ) );
  
//  add section 
  // Homepage Layout
  Kirki::add_section( 'homepage_layout', array(
  	'title'		 => __( 'Homepage Layout', 'best-food' ),
  	'panel'		 => 'homepage',
  	'priority'	 => 10,
  ) );

  $sections = array(
	'slider'            => esc_attr__( 'Slider Section', 'best-food' ),
	//'video'      => esc_attr__( 'Video Background Options', 'best-food' ),
	'about'            => esc_attr__( 'About Section', 'best-food' ),	
	'service'            => esc_attr__( 'Service Section', 'best-food' ),			
	
	
	'woocommerce'      => esc_attr__( 'Woocommerce Section', 'best-food' ),
	'advantage'            => esc_attr__( 'Advantage Section', 'best-food' ),	
	'team'            => esc_attr__( 'Team Section', 'best-food' ),			
	
	
	'fact'      => esc_attr__( 'Fact Section', 'best-food' ),
	'gallery'            => esc_attr__( 'Gallery Section', 'best-food' ),	
	'testimonial'            => esc_attr__( 'Testimonial Section', 'best-food' ),		
	
	
	'client'      => esc_attr__( 'Client Section', 'best-food' ),
	'news'            => esc_attr__( 'News Section', 'best-food' ),	
	'contact'            => esc_attr__( 'Contact Section', 'best-food' ),			
	
	'blog'            => esc_attr__( 'Blog Section', 'best-food' ),	
	'map'            => esc_attr__( 'Map Section', 'best-food' ),	
	'tool'            => esc_attr__( 'Footer Tool Section', 'best-food' ),		
			
  );

  foreach ( $sections as $section_id => $section ) {
	//print_r( $section[0]);
	$section_args = array(
		'title'       => $section.' Setting',
		'panel'       => 'homepage',
		'priority'	 => 10,	
	);
	Kirki::add_section( str_replace( '-', '_', $section_id ) . '_section', $section_args );
  }

  Kirki::add_section( 'video_section', array(
  	'title'		 => __( 'video Background Options',  'best-food' ),
  	'panel'		 => 'homepage',
  	'priority'	 => 10,
  ));  
//  add section setting end


//add field
  function cts_add_field( $args ) {
	Kirki::add_field( 'best_food_settings', $args );
  }  
 
  cts_add_field( array(
		'type'			 => 'switch', //toggle
		'settings'		 => 'enable_section_header_menu',
		'label'			 => __( 'Enable section header menu in the feature homepage', 'best-food' ),
		'section'		 => 'header_option',
		'default'		 => 1,
		'priority'		 => 10,
  )); 


  cts_add_field( array(
  	'type'				 => 'custom',
  	'settings'			 => 'front_page_info',
  	'label'				 => __( 'Switch "Front page displays" to "A static page"', 'best-food' ),
  	'section'			 => 'homepage_layout',
  	'description'		 => sprintf( __( 'Your homepage is not static page. In order to set up the home page as shown in the official demo on our website (one page front page with sections), you will need to set up your front page to use a static page instead of showing your latest blog posts. Check the %s page for more informations.', 'best-food' ), '<a href="' . esc_url(admin_url( 'options-reading.php' )) . '"><strong>' . __( 'Theme info', 'best-food' ) . '</strong></a>' ),
  	'priority'			 => 10,
  	'active_callback'	 => array(
  		array(
  			'setting'	 => 'show_on_front',
  			'operator'	 => '!=',
  			'value'		 => 'page',
  		),
  	),
  ) );

// Homepage Layout   sortable 
  cts_add_field( array(
  	'type'		 => 'sortable',
  	'settings'	 => 'home_layout',
  	'label'		 => esc_attr__( 'Homepage Blocks', 'best-food' ),
  	'section'	 => 'homepage_layout',
  	'help'		 => esc_attr__( 'Drag and Drop and enable the homepage blocks.', 'best-food' ),
	'default'     => cts_section_default_order(),
  	'choices'	 => $sections,
  	'priority'	 => 10,	
	
  ) );
  
  if ( !function_exists('best_food_themes_pro')) {   
  cts_add_field( array(
		  'type'			 => 'custom',
		  'settings'		 => 'pro-features',
		  'label'			 => __( 'Best Food PRO', 'best-food' ),
		  'description'	 => __( 'Available in Best Food PRO: Feature Section, Gallery Section, More Service Items, Facts / Number Section, Our Team Section, Pricing Section, Testimonials Section, Clients Section,Contact Us Section,Call out Section, Google Map, Custom Colors, Google Fonts, video(include Youtube) Backgrounds, More Animations Effects and WooCommerce Compatible much more...', 'best-food' ),
		  'section'		 => 'homepage_layout',
		  'default'		 => '<a class="install-now button-primary button" href="' . esc_url( 'http://demos.coothemes.com/?theme-demo=best-food-pro' ) . '" aria-label="Best Food PRO" data-name="Best Food PRO">' . __( 'Discover Best Food PRO', 'best-food' ) . '</a>',
		  'priority'		 => 10,
	  ) ); 
  }
	
  
//slider
  cts_add_field( array(
	  'type'		 => 'text',
	  'settings'	 => 'slider_section_menu_title',
	  'label'		 => __( 'Main Menu Title', 'best-food' ),
	  'default'	 => 'slider',
	  'section'	 => 'slider_section',
	  'priority'	 => 10,
  ) ); 


  cts_add_field( array(
	'type'        => 'number',
	'settings'    => 'slider_video',
	'label'       => esc_attr__( 'Apply background video to this slider', 'best-food' ),
	'description' => esc_attr__( 'If you enable video background, you need to set the setting "video background option" in the homepage settings', 'best-food' ),	
	'section'     => 'slider_section',
	'default'     => 0,
	'choices'     => array(
		'min'  => 0,
		'max'  => 2,
		'step' => 1,
	),
) );


  cts_add_field( array(
  	'type'		 => 'repeater',
  	'label'		 => __( 'Slider', 'best-food' ),

  	'section'	 => 'slider_section',
  	'priority'	 => 10,
  	'settings'	 => 'repeater_slider',
	'default'     => cts_section_content_default('slider'),
  	'fields'	 => array(
  		'slider_page'	 => array(
  			'type'		 => 'dropdown-pages',
  			'label'		 => __( 'Select page', 'best-food' ),
  			'default'	 => '',
  		),

  		'slider_button_text'	 => array(
  			'type'		 => 'text',
  			'label'		 => __( 'Button Text', 'best-food' ),
  			'default'	 => '',
  		),		
  		'slider_url'	 => array(
  			'type'		 => 'text',
  			'label'		 => __( 'URL', 'best-food' ),
  			'default'	 => '',
  		),

  	),
	
    'row_label'			 => array(
  		'type'	 => 'text',
  		'value'	 => __( 'Slide', 'best-food' ),
  	),
  ) ); 

 
 
  cts_add_field( array(
	'type'        => 'number',
	'settings'    => 'slide_time',
	'label'       => esc_attr__( 'Slide Time', 'best-food' ),
	'section'     => 'slider_section',
	'default'     => 5000,
	'choices'     => array(
		'min'  => 0,
		'max'  => 30000,
		'step' => 500,
	),
  ) );    

  cts_add_field( array(
	'type'        => 'typography',
	'settings'    => 'slider_title_typography',
	'label'       => esc_attr__( 'Title Typography', 'best-food' ),
	'section'     => 'slider_section',
	'default'     => array(
		'font-family'    => 'Dancing Script',
		'variant'        => '700',
		'font-size'      => '56px',
		'color'          => '#ffffff',
		'text-transform' => 'Uppercase',
		'text-align'     => 'center'
	),
	'priority'    => 10,


  ) );

  

  cts_add_field( array(
	'type'        => 'typography',
	'settings'    => 'slider_description_typography',
	'label'       => esc_attr__( 'Description Typography', 'best-food' ),
	'section'     => 'slider_section',
	'default'     => array(
		'font-family'    => 'Roboto',
		'variant'        => 'regular',
		'font-size'      => '20px',

		'color'          => '#ffffff',
		'text-transform' => 'none',
		'text-align'     => 'center'
	),
	'priority'    => 10,

  ) );


  cts_add_field( array(
	'type'        => 'color',
	'settings'    => 'slider_button_background',
	'label'       => __( 'Slider Button Background Color', 'best-food' ),
	'section'     => 'slider_section',
	'default'     => THEME_COLOR,
	'priority'    => 10,
	'choices'     => array(
		'alpha' => true,
	),
	
  ) ); 
  
  cts_add_field( array(
	'type'        => 'typography',
	'settings'    => 'slider_button_typography',
	'label'       => esc_attr__( 'Button Text Typography', 'best-food' ),
	'section'     => 'slider_section',
	'default'     => array(
		'font-family'    => 'Roboto',
		'variant'        => '300',
		'font-size'      => '20px',
		'color'          => '#ffffff',
		'text-transform' => 'Uppercase',
		'text-align'     => 'center'
	),
	'priority'    => 10,

  ) );   
//slider end





//==Sections base settings=====
  //$sections in inc.php
  $sections = cts_public_content_default();
  foreach ( $sections as $keys => $values ) { 
    cts_add_field( array(
  		'type'		 => 'text',
  		'settings'	 => $keys . '_section_title',
  		'label'		 => __( 'Section Title', 'best-food' ),
  		'default'	 => $values[ 'title' ],
  		'section'	 => $keys . '_section',
  		'priority'	 => 10,
  	) );
	
	cts_add_field(
		array(
			'type'			 => 'image',
			'settings'		 => $keys.'_iocn_image',
			'label'			 => __( 'Title Iocn', 'best-food' ),
  			'section'		 => $keys . '_section',
			'default'		 => $imagepath.'divider.png',
			'priority'		 => 10,
		)
	);	
	
  	 cts_add_field( array(
  		'type'		 => 'textarea',
  		'settings'	 => $keys . '_section_description',
  		'label'		 => __( 'Section Description', 'best-food' ),
  		'default'	 => $values[ 'description' ],
  		'section'	 => $keys . '_section',
  		'priority'	 => 10,
  	) ); 
 
  	 cts_add_field( array(
  		'type'		 => 'text',
  		'settings'	 => $keys . '_section_menu_title',
  		'label'		 => __( 'Main Menu Title', 'best-food' ),
  		'default'	 => $values[ 'menu' ],
  		'section'	 => $keys . '_section',
  		'priority'	 => 10,
  	) ); 
 

 
    //background_image
     cts_add_field( array(
    	'type'        => 'image',
    	'settings'    => $keys . '_section_background_image',
    	'label'       => __( 'Section Background Image', 'best-food' ),
    	'section'	 => $keys . '_section',
    	'default'     => $values[ 'img' ],
    	'priority'    => 10,

    ) );
	
	
    //background_color
  	 cts_add_field( array(
  		'type'		 => 'color',
  		'settings'	 => $keys . '_section_background_color',
  		'label'		 => __( 'Section Background Color', 'best-food' ),
  		'section'	 => $keys . '_section',
  		'default'	 => $values[ 'color' ],
  		'priority'	 => 10,
  	) ); 
 	
	
	//background_opacity
	 cts_add_field( array(
		'type'        => 'slider',
		'settings'    => $keys . '_section_background_opacity',
		'label'       => __( 'Section Background Opacity', 'best-food' ),
    	'section'	 => $keys . '_section',
		'default'     => $values[ 'opacity' ],
		'choices'     => array(
			'min'  => '0',
			'max'  => '1',
			'step' => '0.1',
		),
	) );
	
	//padding
	 cts_add_field( array(
		'type'        => 'spacing',
		'settings'	 => $keys . '_section_padding',
		'label'       => __( 'Section Padding Control', 'best-food' ),
		'section'	 => $keys . '_section',
		'default'     => array(
			'top'    => $values[ 'padding_top' ],
			'bottom' => $values[ 'padding_bottom' ],
			'left'   => '0',
			'right'  => '0',
		),
		'priority'    => 10,
	) );
	
	//mobile padding
	 cts_add_field( array(
		'type'        => 'spacing',
		'settings'	 => $keys . '_section_mobile_padding',
		'label'       => __( 'Section Mobile Padding Control', 'best-food' ),
		'section'	 => $keys . '_section',
		'default'     => array(
			'top'    => $values[ 'padding_top' ],
			'bottom' => $values[ 'padding_bottom' ],
			'left'   => '0',
			'right'  => '0',
		),
		'priority'    => 10,
	) );

	
	cts_add_field(
		array(
			'type'			 => 'switch', //toggle
			'settings'		 => $keys.'_enable_animate',
			'label'			 => __( 'Enable Animate', 'best-food' ),
  			'section'		 => $keys . '_section',
			'default'		 => 1,
			'priority'		 => 10,
		)
	);	
	
	cts_add_field(
		array(
			'type'			 => 'switch', //toggle
			'settings'		 => $keys.'_enable_parallax_background',
			'label'			 => __( 'Enable Parallax Background', 'best-food' ),
  			'section'		 => $keys . '_section',
			'default'		 => 0,
			'priority'		 => 10,	 			
			
		)
	);		
	


  	 cts_add_field( array(
  		'type'			 => 'toggle',
  		'settings'		 => $keys . '_typography_setting_enable',
  		'label'			 => __( 'Title / Description Typography Setting', 'best-food' ),
  		'description'	 => __( 'Enable or disable Title / Description Typography', 'best-food' ),
  		'section'		 => $keys . '_section',
  		'default'		 => 1,
  		'priority'		 => 10,
  	) );
	
	//title_typography
	 cts_add_field( array(
	  'type'        => 'typography',
	  'settings'    => $keys . '_title_typography',
	  'label'       => $keys . esc_attr__( ' Title Typography', 'best-food' ),
  	  'section'	    => $keys . '_section',
	  'default'     => cts_get_default_title_font($keys),
	  'priority'    => 10,
	  'output'      => array(
		array(
			'element' => 'section.ct_'.$keys.' .section_title',
		),
	  ), 
	  'required'	 => array(
		  array(
			  'setting'	 => $keys . '_typography_setting_enable',
			  'operator'	 => '==',
			  'value'		 => 1,
		  ),
	  )
	  
	) );
  
    //description_typography
	 cts_add_field( array(
	  'type'        => 'typography',
	  'settings'    => $keys . '_description_typography',
	  'label'       => $keys .esc_attr__( ' Description Typography', 'best-food' ),
  	  'section'	    => $keys . '_section',
	  'default'     => cts_get_description_font($keys),
	  'priority'    => 10,
	  
	  
	  'output'      => array(
		array(
			'element' => 'section.ct_'.$keys.' .section_content,section.ct_'.$keys.' p',
		),
	  ),
	  
	  'required'	 => array(
		  array(
			  'setting'	 => $keys . '_typography_setting_enable',
			  'operator'	 => '==',
			  'value'		 => 1,
		  ),
	  )	  
	  	  
	  
	  
	) );
  }  
//==Sections base settings end=====  



//about  
  cts_add_field( array(
  	'type'		 => 'dropdown-pages',
	'settings'    => 'about_page',	
  	'label'		 => __( 'About Us Content Select', 'best-food' ),
  	'section'	 => 'about_section',
	'default'     =>'',
	'priority'    => 10,
	

  ) );
    
  cts_add_field( array(
	  'type'        => 'image',
	  'settings'    => 'about_image',
	  'label'       => __( 'About Image', 'best-food' ),
	  'section'	 => 'about_section',
	  'default'     => esc_url($imagepath.'about-us.jpg'),
	  'priority'    => 10,

  ) );  

  cts_add_button_field( cts_button_default_arr('about') );
  
  
  
//service
  cts_add_field( array(
  	'type'		 => 'repeater',
  	'label'		 => __( 'Service', 'best-food' ),
  	'section'	 => 'service_section',
  	'priority'	 => 10,
  	'settings'	 => 'repeater_service',
    'sanitize_callback' => 'esc_attr',
	//'description'	=> sprintf(__('Note: <br>Find fontawesome icon: <a href="%1$s" target="_blank">http://fontawesome.io/icons/</a>, Example: <a href="%2$s" target="_blank">http://fontawesome.io/examples/</a>', 'best-food'),esc_url('http://fontawesome.io/icons/'),esc_url('http://fontawesome.io/examples/')),
	
	'default'     =>  cts_section_content_default('service'),
  	'fields'	 => array(
  		'service_icon'	 => array(
  			'type'		 => 'text',
  			'label'		 => __( 'Service Icon Image', 'best-food' ),
  			'default'	 =>'',
  		),	

  		'service_icon_hover'	 => array(
  			'type'		 => 'text',
  			'label'		 => __( 'Service Icon Hover Image', 'best-food' ),
  			'default'	 => '',
  		),	

  		'service_url'	 => array(
  			'type'		 => 'text',
  			'label'		 => __( 'URL', 'best-food' ),
  			'default'	 => '',
  		),

  		'service_title'	 => array(
  			'type'		 => 'text',
  			'label'		 => __( 'Item Title', 'best-food' ),
  			'default'	 => '',
  		),
  		'service_description'	 => array(
  			'type'		 => 'text',
  			'label'		 => __( 'Item Description', 'best-food' ),
  			'default'	 => '',
  		),
		
  	),
	
    'row_label'			 => array(
  		'type'	 => 'text',
  		'value'	 => __( 'Service Item', 'best-food' ),
  	),
  ) );  

	//service title_typography
	 cts_add_field( array(
	  'type'        => 'typography',
	  'settings'    => 'service_item_title_typography',
	  'label'       => esc_attr__( 'Item Title Typography', 'best-food' ),
  	  'section'	    => 'service_section',
	  'default'     => array(
		  'font-family'    => 'Dancing Script',
		  'variant'        => '700',
		  'font-size'      => '26px',
		  'color'          => '#ffffff',
		  'text-transform' => 'none',
		  'text-align'     => 'center'
	  ),
	  'priority'    => 10,
	  'output'      => array(
		array(
			'element' => 'section.ct_service .service_content_container h4 a',
		),
	  ), 

	  
	) );

//blog//,
  // Pull all the categories into an array
  $options_categories = array();
  $options_categories_obj = get_categories();

  foreach ($options_categories_obj as $category) {
	$options_categories[$category->cat_name] = $category->cat_name;
  }			  
     
  cts_add_field( array(
	'type'        => 'select',
	'settings'    => 'blog_article_number',
	'label'			 => __( 'Displays the number of articles', 'best-food' ),
	'section'     => 'blog_section',
	'default'     => '3',
	'priority'    => 10,

	'choices'     => array(
		'3' => 3,
		'6' => 6,
		'9' => 9,
		'12' => 12,
	),
  ) );  

  cts_add_field( array(
	'type'        => 'multicheck',
	'settings'    => 'blog_categories',
	'label'		  => __( 'The following catagories will display on Blog section in the Homepage.', 'best-food' ),
	'section'     => 'blog_section',
	'default'     => '',
	'priority'    => 10,
	'choices'     => $options_categories,
	
  ) );    
   
  cts_add_field( array(
	'type'        => 'image',
	'settings'    => 'blog_feature_img',
	'label'       => __( 'Homepage Article Default Feature image', 'best-food' ),
	'section'     => 'blog_section',
	'default'     => esc_url($imagepath.'default-thumbnail.jpg'),
	'priority'    => 10,
  ) );
 
  cts_add_button_field( cts_button_default_arr('blog') ); 

//contact  

  cts_add_button_field( cts_button_default_arr('contact') ); 

function best_food_customize_register( $wp_customize ) {
    $wp_customize->add_setting( 'contact_cf7_shortcode', array(
        'default'   => '',
        "transport" => "postMessage",
		'sanitize_callback' => 'best_food_sanitize_text',
        'type'      => 'option'
    ) );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'contact_cf7_shortcode', array(
         'label'      => __( 'Contact Form Shortcode', 'best-food' ),
		'description'	=> wp_kses_post( 'Paste the contact form shortcode. For example the Contact Form 7 plugin shortcode: <code>[contact-form-7 id="xxx" title="Contact form 1"]</code>', 'best-food' ),
         'section'   => 'contact_section'
    ) ) );
	
	
}
add_action( 'customize_register', 'best_food_customize_register' );

function best_food_sanitize_text( $str ) {
    return sanitize_text_field( $str );
} 

//tool

  cts_add_field( array(
	'type'        => 'image',
	'settings'    => 'tool_1_logo',
	'label'       => __( 'Footer Logo', 'best-food' ),
	'section'     => 'tool_section',
	'default'     => esc_url($imagepath.'logo.png'),
	'priority'    => 10,
  ) );
 

  cts_add_field( array(
	  'type'		 => 'textarea',
	  'settings'	 => 'tool_1_description',
	  'label'		 => __( 'Tool 1 Description', 'best-food' ),
	  'default'	     => __( 'Donec at eui smod nibh, eu bibendum quam. Nullam  non gravida pDonec at eui smod nibh, eu bibendum quam. Nullam  non gravida peu bibendum quam. Nullam  non gravida peu bibendum quam. Nullam  non gravida p', 'best-food' ),
	  'section'	 => 'tool_section',
	  'priority'	 => 10,
  ) );


  cts_add_field( array(
	  'type'		 => 'text',
	  'settings'	 => 'tool_2_title',
	  'label'		 => __( 'Tool 2 Title', 'best-food' ),
	  'default'	 => __( 'Contact Us', 'best-food' ),
	  'section'	 => 'tool_section',
	  'priority'	 => 10,
  ) );


  cts_add_field( array(
  	'type'		 => 'repeater',
  	'label'		 => __( 'Tool 2 Information', 'best-food' ),
  	'section'	 => 'tool_section',
  	'priority'	 => 10,
  	'settings'	 => 'repeater_tool_2',
    'sanitize_callback' => 'esc_attr',
	'description'	=> sprintf(__('Note: <br>Find fontawesome icon: <a href="%1$s" target="_blank">http://fontawesome.io/icons/</a>, Example: <a href="%2$s" target="_blank">http://fontawesome.io/examples/</a>', 'best-food'),esc_url('http://fontawesome.io/icons/'),esc_url('http://fontawesome.io/examples/')),
	
	'default'     => cts_section_content_default('tool'),
  	'fields'	 => array(
  		'tool_2_icon'	 => array(
  			'type'		 => 'text',
  			'label'		 => __( 'tool 2 Fontawesome Icon', 'best-food' ),
  			'default'	 =>'',
  		),
  		'tool_2_text'	 => array(
  			'type'		 => 'text',
  			'label'		 => __( 'Tool 2 Text', 'best-food' ),
  			'default'	 =>'',
  		),
  	),
	
    'row_label'			 => array(
  		'type'	 => 'text',
  		'value'	 => __( 'Tool 2 Contact Item', 'best-food' ),
  	),
  ) );

  cts_add_field( array(
	  'type'		 => 'text',
	  'settings'	 => 'tool_3_title',
	  'label'		 => __( 'Tool 3 Title', 'best-food' ),
	  'default'	 => __( 'Opening Hours', 'best-food' ),
	  'section'	 => 'tool_section',
	  'priority'	 => 10,
  ) );


  cts_add_field( array(
  	'type'		 => 'repeater',
  	'label'		 => __( 'Tool 3 Information', 'best-food' ),
  	'section'	 => 'tool_section',
  	'priority'	 => 10,
  	'settings'	 => 'repeater_tool_3',
    'sanitize_callback' => 'esc_attr',

	'default'     => array(
			array(
				'tool_3_text' => esc_attr__( 'Monday-Friday: 08:00AM - 10:00PM', 'best-food' ),//====pro====													
			),
	
			array(
				'tool_3_text' => esc_attr__( 'Saturday-Sunday: 10:00AM - 11:00PM', 'best-food' ),												
			),
	
		),
  	'fields'	 => array(
  		'tool_3_text'	 => array(
  			'type'		 => 'text',
  			'label'		 => __( 'Tool 3 Text', 'best-food' ),
  			'default'	 =>'',
  		),
  	),
	
    'row_label'			 => array(
  		'type'	 => 'text',
  		'value'	 => __( 'Tool 3 Contact Item', 'best-food' ),
  	),
  ) );

//footer
  cts_add_field( array(
		'type'        => 'editor',
		'settings'    => 'footer_copy_code',
		'label'       => esc_attr__( 'Footer Copyright 2', 'best-food' ),
		'section'     => 'footer_option',
		'default'     => __('Powered by <a href="http://wordpress.org/">WordPress</a>. Best Food theme by <a href="https://www.coothemes.com/">CooThemes.com</a>.','best-food')


  )); 

 
  cts_add_field( array(
	  'type'		 => 'text',
	  'settings'	 => 'facebook_link',
	  'label'		 => __( 'Facebook Link', 'best-food' ),
	  'default'	 => '#',
	  'section'	 => 'footer_option',
	  'priority'	 => 10,
  ) ); 
  
  cts_add_field( array(
	  'type'		 => 'text',
	  'settings'	 => 'twitter_link',
	  'label'		 => __( 'Twitter Link', 'best-food' ),
	  'default'	 => '#',
	  'section'	 => 'footer_option',
	  'priority'	 => 10,
  ) );   
  
  cts_add_field( array(
	  'type'		 => 'text',
	  'settings'	 => 'youtube_link',
	  'label'		 => __( 'Youtube Link', 'best-food' ),
	  'default'	 => '#',
	  'section'	 => 'footer_option',
	  'priority'	 => 10,
  ) );   
  
  cts_add_field( array(
	  'type'		 => 'text',
	  'settings'	 => 'pinterest_link',
	  'label'		 => __( 'Pinterest Link', 'best-food' ),
	  'default'	 => '#',
	  'section'	 => 'footer_option',
	  'priority'	 => 10,
  ) ); 
  
  cts_add_field( array(
	  'type'		 => 'text',
	  'settings'	 => 'google_plus_link',
	  'label'		 => __( 'Google Plus Link', 'best-food' ),
	  'default'	 => '#',
	  'section'	 => 'footer_option',
	  'priority'	 => 10,
  ) );   
  
  cts_add_field( array(
	  'type'		 => 'text',
	  'settings'	 => 'instagram_link',
	  'label'		 => __( 'Instagram Link', 'best-food' ),
	  'default'	 => '#',
	  'section'	 => 'footer_option',
	  'priority'	 => 10,
  ) );       
//==========homepage end==========



function cts_add_button_field( $button_arr) {
  $key = $button_arr['key'];

  cts_add_field( array(
  		'type'		 => 'text',
  		'settings'	 => $key.'_button_text',
  		'label'		 => __( 'Button Text', 'best-food' ),
  		'default'	 => $button_arr['button_text'],
  		'section'	 => $key.'_section',
  		'priority'	 => 10,
  	) ); 
	
	  
  cts_add_field( array(
  		'type'		 => 'text',
  		'settings'	 => $key.'_button_url',
  		'label'		 => __( 'Button URL', 'best-food' ),
  		'default'	 => '#',
  		'section'	 => $key.'_section',
  		'priority'	 => 10,
  	) );   
  
  
  cts_add_field( array(
	'type'        => 'color',
	'settings'    => $key.'_button_background',
	'label'       => __( 'Button Background Color', 'best-food' ),
	'section'     => $key.'_section',
	'default'     => THEME_COLOR,
	'priority'    => 10,
	'choices'     => array(
		'alpha' => true,
	),
	
  ) ); 
  
  
	//button_opacity
	 cts_add_field( array(
		'type'        => 'slider',
		'settings'    => $key . '_button_opacity',
		'label'       => __( 'Button Background Opacity', 'best-food' ),
    	'section'	 => $key . '_section',
		'default'     => $button_arr['opacity'],
		'choices'     => array(
			'min'  => '0',
			'max'  => '1',
			'step' => '0.1',
		),
	) );
	  
  
  
  
  cts_add_field( array(
	'type'        => 'typography',
	'settings'    => $key.'_button_typography',
	'label'       => esc_attr__( 'Button Text Typography', 'best-food' ),
	'section'     => $key.'_section',
	'default'     => $button_arr['button_font'],
	'priority'    => 10,
	
	'output'      => array(
	  array(
		  'element' => 'section.ct_'.$key.' .btn-primary',
	  ),
	),	
  

  ) ); 
  
  cts_add_field( array(
	'type'        => 'number',
	'settings'    => $key.'_button_radius',
	'label'       => esc_attr__( 'Button Border Radius', 'best-food' ),
	'section'     => $key.'_section',
	'default'     => $button_arr['button_radius'],
	'choices'     => array(
		'min'  => 0,
		'max'  => 50,
		'step' => 1,
	),
  ) );  
  
  cts_add_field( array(
	  'type'        => 'spacing',
	  'settings'	 => $key.'_button_padding',
	  'label'       => __( 'Section Button Padding Control', 'best-food' ),
	  'section'	 => $key.'_section',
	  'default'     => $button_arr['button_spacing'],
	  'priority'    => 10,
  ) ); 
}  
 
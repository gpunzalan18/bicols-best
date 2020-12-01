<?php

//default data
function cts_section_default_order() 
{
	$section_default = array( 	
		'slider',//free
		'about',//free			
		'service',//free
					
		'blog',//free
		'contact',//free
		'tool',//free
				
	);		
	return $section_default;
}


if ( !function_exists( 'cts_get_default_title_font' ) ){
  function cts_get_default_title_font($key)
  {  
  
	switch($key){
		case 'advantage'://pro		
		case 'service':
		case 'testimonial':	//pro end
		case 'contact':		
		  $section_title_default_font     = array(
				  'font-family'    => 'Dancing Script',
				  'variant'        => '700',
				  'font-size'      => '36px',
				  'color'          => '#ffffff',
				  'text-transform' => 'Uppercase',
				  'text-align'     => 'center'
			  ); 
		  break;	
		case 'tool':		
		  $section_title_default_font     = array(
				  'font-family'    => 'Dancing Script',
				  'variant'        => '700',
				  'font-size'      => '30px',
				  'color'          => '#ffffff',
				  'text-transform' => 'none',
				  'text-align'     => 'left'
			  ); 
		  break;	
		
		case 'blog':
		  $section_title_default_font     = array(
				  'font-family'    => 'Dancing Script',
				  'variant'        => '700',
				  'font-size'      => '36px',
				  'color'          => '#000000',
				  'text-transform' => 'Uppercase',
				  'text-align'     => 'center'
			  ); 
		  break;	
		
	
		default:
		  $section_title_default_font     = array(
				  'font-family'    => 'Dancing Script',
				  'variant'        => '700',
				  'font-size'      => '36px',
				  'color'          => '#000000',
				  'text-transform' => 'Uppercase',
				  'text-align'     => 'center'
			  ); 
	}
	return $section_title_default_font;	
  
		 
  }
}

if ( !function_exists( 'cts_get_description_font' ) ){
  function cts_get_description_font($key)
  {  
	switch($key){
	case 'about':
	  $section_description_default_font     = array(
			  'font-family'    => 'Roboto',
			  'variant'        => 'regular',
			  'font-size'      => '16px',
			  'color'          => '#1c1c1c',
			  'text-transform' => 'none',
			  'text-align'     => 'left'
		  ); 
	  break;
	  
	case 'contact':	  
	case 'testimonial':	//pro		
	case 'service':		
	case 'advantage':
	case 'fact':	//pro end
	  $section_description_default_font     = array(
			  'font-family'    => 'Roboto',
			  'variant'        => 'regular',
			  'font-size'      => '16px',
			  'color'          => '#ffffff',
			  'text-transform' => 'none',
			  'text-align'     => 'center'
		  );
	  break;
	case 'tool':	
	  $section_description_default_font     = array(
			  'font-family'    => 'Roboto',
			  'variant'        => 'regular',
			  'font-size'      => '16px',
			  'color'          => '#dedede',
			  'text-transform' => 'none',
			  'text-align'     => 'left'
		  );
	  break;
	default:
	  $section_description_default_font     = array(
			  'font-family'    => 'Roboto',
			  'variant'        => 'regular',
			  'font-size'      => '14px',
			  'color'          => '#999999',
			  'text-transform' => 'none',
			  'text-align'     => 'center'
		);   
	}
	return $section_description_default_font;
	 
  }
}
	   

  //section public set
  
function cts_public_content_default()//section public css
{ 
  $imagepath =  get_stylesheet_directory_uri() . '/custom/images/';    
  return $sections_default = array(
 
    'about'		 => array(
		'title'		 => __( 'About Us', 'best-food' ),
		'description'	=> '',
  		'menu'		 => 'about',				
  		'color'		 => '#ffffff',
  		'opacity'		 => 1,
  		'parallax'		 => 0,				
  		'img'	 => '',
  		'padding_top'	 => '70px',
  		'padding_bottom'	 => '90px',
		
  	),
	
   	'service'		 => array(
		'title'		 => __( 'Services We Offer', 'best-food' ),
		'description'	=> __( 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere c.Etiam ut dui eVestibulum ante ipsum primi', 'best-food' ),
  		'menu'		 => 'service',				
  		'color'		 => '#000000',
  		'opacity'		 => 0.5,
  		'parallax'		 => 1,				
  		'img'	 => esc_url($imagepath.'service.jpg'),
  		'padding_top'	 => '80px',
  		'padding_bottom'	 => '100px',	
  	), 		
   	'contact'		 => array(
		'title'		 => __( 'Contact Us', 'best-food' ),
		'description'	=> __( 'You can write a description of the section here!', 'best-food' ),
  		'menu'		 => 'contact',				
  		'color'		 => '#000000',
  		'opacity'		 => 0.3,
  		'parallax'		 => 1,				
  		'img'	 => esc_url($imagepath.'contact.jpg'),
  		'padding_top'	 => '100px',
  		'padding_bottom'	 => '80px',
		
  	), 
	
   	'blog'		 => array(
		'title'		 => __( 'From The Blog', 'best-food' ),
		'description'	=> __( 'You can write a description of the section here!', 'best-food' ),
  		'menu'		 => 'blog',				
  		'color'		 => '#ffffff',
  		'opacity'		 => 1,	
  		'parallax'		 => 0,		
  		'img'	 => '',
  		'padding_top'	 => '100px',
  		'padding_bottom'	 => '80px',
		
  	), 
	
   	'tool'		 => array(
		'title'		 => '',
		'description'	=> '',
  		'menu'		 => 'tool',				
  		'color'		 => '#252425',
  		'opacity'		 => 1,	
  		'parallax'		 => 0,	
  		'img'	 => '',
  		'padding_top'	 => '60px',
  		'padding_bottom'	 => '40px',
		
  	),		



 	
  );
}

function cts_section_content_default($key)
{  
  $imagepath =  get_stylesheet_directory_uri() . '/custom/images/'; 
  switch($key){

	case 'slider':	
	  $default     = array(
		array(
			'slider_page' => '',		
			'slider_button_text'  => esc_html__( 'Check it out', 'best-food' ),			
			'slider_url'  => '#',
		),
		
		array(
			'slider_page' => '',	
			'slider_button_text'  => esc_html__( 'Downlaod Now', 'best-food' ),			
			'slider_url'  => '#',
		),		
		
		array(
			'slider_page' => '',
			'slider_button_text'  => esc_html__( 'Check it out', 'best-food' ),			
			'slider_url'  => '#',		
		),
	  );
 	  break;
	  
	case 'service':
	  $default     = array(
		array(
			'service_icon' => esc_url($imagepath.'service/s-1.png'),
			'service_icon_hover' => esc_url($imagepath.'service/s-1-v.png'),		
			'service_url'  => '',
			'service_title' => esc_attr__( 'Service One', 'best-food' ),
			'service_description'  => esc_attr__( 'Duis sit amet nulla id quam faucibus sagittis. Mauris id tempus tortor. Mauris nibh purus, maximus non porttitor et, varius non tortor. ', 'best-food' ),					
		),
		
		array(
			'service_icon' => esc_url($imagepath.'service/s-2.png'),
			'service_icon_hover' => esc_url($imagepath.'service/s-2-v.png'),		
			'service_url'  => '',
			'service_title' => esc_attr__( 'Service Two', 'best-food' ),
			'service_description'  => esc_attr__( 'Duis sit amet nulla id quam faucibus sagittis. Mauris id tempus tortor. Mauris nibh purus, maximus non porttitor et, varius non tortor. ', 'best-food' ),					
		),
				
		array(
			'service_icon' => esc_url($imagepath.'service/s-3.png'),
			'service_icon_hover' => esc_url($imagepath.'service/s-3-v.png'),		
			'service_url'  => '',
			'service_title' => esc_attr__( 'Service Three', 'best-food' ),
			'service_description'  => esc_attr__( 'Duis sit amet nulla id quam faucibus sagittis. Mauris id tempus tortor. Mauris nibh purus, maximus non porttitor et, varius non tortor. ', 'best-food' ),					
		),
				
		array(
			'service_icon' => esc_url($imagepath.'service/s-4.png'),
			'service_icon_hover' => esc_url($imagepath.'service/s-4-v.png'),		
			'service_url'  => '',
			'service_title' => esc_attr__( 'Service Four', 'best-food' ),
			'service_description'  => esc_attr__( 'Duis sit amet nulla id quam faucibus sagittis. Mauris id tempus tortor. Mauris nibh purus, maximus non porttitor et, varius non tortor. ', 'best-food' ),					
		),
				
		array(
			'service_icon' => esc_url($imagepath.'service/s-5.png'),
			'service_icon_hover' => esc_url($imagepath.'service/s-5-v.png'),		
			'service_url'  => '',
			'service_title' => esc_attr__( 'Service Five', 'best-food' ),
			'service_description'  => esc_attr__( 'Duis sit amet nulla id quam faucibus sagittis. Mauris id tempus tortor. Mauris nibh purus, maximus non porttitor et, varius non tortor. ', 'best-food' ),					
		),
				
		array(
			'service_icon' => esc_url($imagepath.'service/s-6.png'),
			'service_icon_hover' => esc_url($imagepath.'service/s-6-v.png'),		
			'service_url'  => '',
			'service_title' => esc_attr__( 'Service Six', 'best-food' ),
			'service_description'  => esc_attr__( 'Duis sit amet nulla id quam faucibus sagittis. Mauris id tempus tortor. Mauris nibh purus, maximus non porttitor et, varius non tortor. ', 'best-food' ),					
		),
				
		
		
	  );
 	  break;

	case 'tool':	
		$default     = array(
			array(
				'tool_2_icon' => 'fa-home',
				'tool_2_text' => esc_attr__( '383 Waterview Lane, Las Vegas, US', 'best-food' ),//====pro====													
			),
	
			array(
				'tool_2_icon' => 'fa-phone',
				'tool_2_text' => esc_attr__( '+1 123 456 789', 'best-food' ),												
			),
	
			array(
				'tool_2_icon' => 'fa-envelope-o',
				'tool_2_text' => 'support@example.com',	//====pro====											
			),
	
	
			array(
				'tool_2_icon' => 'fa-internet-explorer',
				'tool_2_text' => esc_url('https://www.example.com'),	//====pro====												
			),
	
		);
 	  break;


	default:
	  $default     = array();	
	  	  

  }
  return $default;
}


function cts_button_default_arr($key) 
{
	$default     = array();	
 switch($key){

	case 'about':	
	  $default     = array(
		'key'=>'about',
		'button_text'=>__( 'Read More', 'best-food' ),
		'opacity'=>1,
		'button_font'=>array(
				'font-family'    => 'Roboto',
				'variant'        => '300',
				'font-size'      => '16px',
				'color'          => '#ffffff',
				'text-transform' => 'Uppercase',
				'text-align'     => 'center'
			),
		'button_radius'=>30,	
			
		'button_spacing'=>array(
				  'top'    => '6px',
				  'bottom' => '6px',
				  'left'   => '16px',
				  'right'  => '16px',
			  )
	  );
 	  break;
	  
	case 'contact':	
	  $default     = array(
		'key'=>'contact',
		'button_text'=>__( 'View All Events', 'best-food' ),
		'opacity'=>1,
		'button_font'=>array(
				'font-family'    => 'Roboto',
				'variant'        => '300',
				'font-size'      => '16px',
				'color'          => '#ffffff',
				'text-transform' => 'Uppercase',
				'text-align'     => 'center'
			),
		'button_radius'=>4,	
			
		'button_spacing'=>array(
				  'top'    => '12px',
				  'bottom' => '12px',
				  'left'   => '30px',
				  'right'  => '30px',
			  )
	  );
 	  break;
	  
	case 'blog':	
	  $default     = array(
		'key'=>'blog',
		'button_text'=>__( 'View The Blog', 'best-food' ),
		'opacity'=>0,
		'button_font'=>array(
				'font-family'    => 'Roboto',
				'variant'        => '300',
				'font-size'      => '16px',
				'color'          => THEME_COLOR,
				'text-transform' => 'Uppercase',
				'text-align'     => 'center'
			),
		'button_radius'=>30,	
			
		'button_spacing'=>array(
				  'top'    => '12px',
				  'bottom' => '12px',
				  'left'   => '30px',
				  'right'  => '30px',
			  )
	  );
 	  break;
	  

	
	default:
	  $default     = array();	
	  	  

  }
  return $default;
}

?>
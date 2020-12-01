<?php

function theta_themes_pro(){
	//theta pro
}
$template_directory = get_template_directory();


function cts_generate_public_css($key,$default){
	
	$imagepath =  get_stylesheet_directory_uri() . '/custom/images/';

	$custom_css = '';

	// section title hr		
	$title_iocn_image = get_theme_mod( $key.'_iocn_image', $imagepath.'divider.png' ) ;	
	$custom_css .='section.ct_'.$key.' .section_title{background-image:url('.$title_iocn_image.');background-position:center bottom; background-repeat:no-repeat;padding-bottom: 30px;}';
	  
	//background color and  opacity  
	$section_background_color     = get_theme_mod( $key.'_section_background_color',$default['color']); 
	$section_background_opacity     = get_theme_mod( $key.'_section_background_opacity',$default['opacity']); 
  
	$background                    = theta_get_background( $section_background_color , $section_background_opacity );	
	$custom_css .='section.ct_section_'.$key.' {'.$background.' background-size: 100% auto;}';  

	$enable_parallax_background = get_theme_mod( $key.'_enable_parallax_background',$default['parallax']); 

	if(!$enable_parallax_background){	
		// background_image 
		$section_background_image     = get_theme_mod( $key.'_section_background_image',$default['img']); 
		if ( $section_background_image != '' ){$custom_css .='section.ct_section_'.$key.' {background-image:url('.$section_background_image.');}';  } 
	}
		
	if ( defined( 'ISMOBILE' ) && ISMOBILE ) {
		//padding 
		$padding_default = array( 'top' => '60px' ,'bottom' => '60px' ,'left' => '0' ,'right' => '0' );
		$section_padding     = get_theme_mod( $key.'_section_moblie_padding',$padding_default);
		  
		$custom_css .='section.ct_section_'.$key.' .section_content{padding:'.$section_padding['top'].' '.$section_padding['right'].' '.$section_padding['bottom'].' '.$section_padding['left'].';}'; 		  
	}else{	  
		//padding 
		$padding_default = array( 'top' => $default['padding_top'] ,'bottom' => $default['padding_bottom'] ,'left' => '0' ,'right' => '0' );
		$section_padding     = get_theme_mod( $key.'_section_padding',$padding_default);
		  
		$custom_css .='section.ct_section_'.$key.' .section_content{padding:'.$section_padding['top'].' '.$section_padding['right'].' '.$section_padding['bottom'].' '.$section_padding['left'].';}';  
	}
  
	//$button_arr = array();
	$button_arr  = cts_button_default_arr($key);
	  
	if( !empty($button_arr) ){
	  
	  $button_background = esc_attr(get_theme_mod( $key.'_button_background', THEME_COLOR ));  
	  
	  $button_background_hover = theta_change_color($button_background,0.8);
	  $button_background_font_hover = theta_change_color($button_background,0.1);	  

	  $button_opacity = esc_attr(get_theme_mod( $key.'_button_opacity', $button_arr['opacity'] )); 
	  $button_background_rbg = theta_get_background($button_background,$button_opacity);	
	  
	  $button_radius = esc_attr(get_theme_mod( $key.'_button_radius', $button_arr['button_radius'] ));  
	  
	  $section_padding     = get_theme_mod( $key.'_button_padding',$button_arr['button_spacing']);	  
	  	    
	  $custom_css .='.ct_'.$key.' a.btn-primary{margin-top:40px;  '.$button_background_rbg.' border-color:'.$button_background_hover.';border-radius: '.$button_radius.'px;padding:'.$section_padding['top'].' '.$section_padding['right'].' '.$section_padding['bottom'].' '.$section_padding['left'].';}
	  .ct_'.$key.' a:hover.btn-primary{ background-color:'.$button_background_hover.'; color:'.$button_background_font_hover.';}';	
	}
	//--------------public css set end----------------
		
	return $custom_css;
}


function best_food_section_live_css($key){
  $custom_css ='';
    	
  switch($key){

	case 'slider':	
	  //slider css	
	  $key = 'slider';
	  
	  $default_content = cts_section_content_default($key);
	
	  $slider_title_typography_default     = array(
		  'font-family'    => 'Dancing Script',
		  'variant'        => '700',
		  'font-size'      => '56px',
		  'color'          => '#ffffff',
		  'text-transform' => 'Uppercase',
		  'text-align'     => 'center'
	  );
	  $slider_description_typography_default     = array(
			'font-family'    => 'Roboto',
			'variant'        => 'regular',
			'font-size'      => '20px',
			'color'          => '#ffffff',
			'text-transform' => 'none',
			'text-align'     => 'center'
		);	
	  $slider_button_typography_default     = array(
			'font-family'    => 'Roboto',
			'variant'        => '300',
			'font-size'      => '20px',
			'color'          => '#ffffff',
			'text-transform' => 'Uppercase',
			'text-align'     => 'center'
		);
		
	  $slider_title_typography = theta_get_typography( 'slider_title_typography', $slider_title_typography_default );
	  $slider_description_typography = theta_get_typography( 'slider_description_typography', $slider_description_typography_default );  
	  $slider_button_typography = theta_get_typography( 'slider_button_typography', $slider_button_typography_default );  
	  
	  $slider_button_background = esc_attr(get_theme_mod( 'slider_button_background', THEME_COLOR ));  
	  
	  $slider_button_background_hover = theta_change_color($slider_button_background,0.8);;
	
	
	  $j=0;

	
	  $custom_css .=".ct_slider .ct_slider_warp .carousel-caption h1.slider_title{ $slider_title_typography font-weight: lighter;}.ct_slider .ct_slider_warp .carousel-caption p.ct_slider_text{  $slider_description_typography font-weight: lighter;}.ct_slider .ct_slider_warp  a.btn{ $slider_button_typography background-color: $slider_button_background; border-color:$slider_button_background_hover;border-radius: 4px;font-weight: lighter; }.ct_slider .ct_slider_warp a:hover.btn{ background-color:$slider_button_background_hover;}";
	
	  
	  $repeater_value = get_theme_mod( 'repeater_slider',$default_content);	
	  if ( ! empty( $repeater_value ) ) :	
		foreach ( $repeater_value as $row ) : 
		  if ( isset( $row[ 'slider_page' ] ) && !empty( $row[ 'slider_page' ] ) ) :
			$sliders = best_food_get_slider_details($row[ 'slider_page' ]);
			
			$slide_image = $sliders['images'];
			
			$custom_css .=".ct_slider .ct_slider_item_".($j+1)."{background-image: url(".esc_url($slide_image).");background-size:auto 100%;background-position: center;}.ct_slider .ct_slider_item_".($j+1).":after {content: '';position: absolute;width: 100%;height: 100%;top: 0;left: 0;background-color: rgba(37, 46, 53, 0.5);}";
	
	 
		  endif;
		  
		  $j++;
		endforeach;	
	  endif;
	  //slider css end 
 	  break;


	case 'about':
	  //about

	  $key = 'about';

	  //--------------public css set-------------------
	  $sections = cts_public_content_default(); 
	  $default = $sections[$key];
	  
	  $custom_css .= cts_generate_public_css($key,$default);
	  //--------------public css set end----------------
	  
 	  break;


	case 'service':
	  //service

	  $key = 'service';

	  //--------------public css set-------------------
	  $sections = cts_public_content_default(); 
	  $default = $sections[$key];
	  
	  $custom_css .= cts_generate_public_css($key,$default);
	  //--------------public css set end----------------

	  $default_content = cts_section_content_default($key);  
	  $repeater_value = get_theme_mod( 'repeater_'.$key,$default_content);		
  	  
	  $k = 0;
		if ( ! empty( $repeater_value ) ) :	
		  foreach ( $repeater_value as $row ) : 
			if ( isset( $row[ 'service_icon' ] ) && !empty( $row[ 'service_icon' ] ) ) :
	  			$k++;
	 			$custom_css .='.service_content_'.$k.' a.ct_icon{background-image:url('.esc_url($row[ 'service_icon' ]).');width: 100%; height: 100%; min-height: 100px;display: block;    background-position: center; background-repeat: no-repeat;}.service_content_'.$k.' a:hover.ct_icon{background-image:url('.esc_url($row[ 'service_icon_hover' ]).');}';
				

			endif;
		  endforeach;	
		endif;
            	  
 	  break;

	  
	case 'contact':
	  $key = 'contact';

	  //--------------public css set-------------------
	  $sections = cts_public_content_default(); 
	  $default = $sections[$key];
	  
	  $custom_css .= cts_generate_public_css($key,$default);
	  //--------------public css set end----------------
	  
	  
	  $button_arr  = cts_button_default_arr($key);
	  
	if( !empty($button_arr) ){
	  
	  $button_background = esc_attr(get_theme_mod( $key.'_button_background', THEME_COLOR ));  
	  
	  $button_background_hover = theta_change_color($button_background,0.8);
	  $button_background_font_hover = theta_change_color($button_background,0.1);	  

	  $button_opacity = esc_attr(get_theme_mod( $key.'_button_opacity', $button_arr['opacity'] )); 
	  $button_background_rbg = theta_get_background($button_background,$button_opacity);	
	  
	  $button_radius = esc_attr(get_theme_mod( $key.'_button_radius', $button_arr['button_radius'] ));  
	  
	  $section_padding     = get_theme_mod( $key.'_button_padding',$button_arr['button_spacing']);	  
	  	    
	  $custom_css .='.ct_contact .wpcf7-submit{margin-top:40px;  '.$button_background_rbg.' border-color:'.$button_background_hover.';border-radius: '.$button_radius.'px;padding:'.$section_padding['top'].' '.$section_padding['right'].' '.$section_padding['bottom'].' '.$section_padding['left'].';}';	
	}	  
	  
 	  break;		  
	  		  
  
	case 'blog':
	  $key = 'blog';

	  //--------------public css set-------------------
	  $sections = cts_public_content_default(); 
	  $default = $sections[$key];
	  
	  $custom_css .= cts_generate_public_css($key,$default);
	  //--------------public css set end----------------
	  
 	  break;			  
	  
	  
	case 'tool':
	  $key = 'tool';

	  //--------------public css set-------------------
	  $sections = cts_public_content_default(); 
	  $default = $sections[$key];
	  
	  $custom_css .= cts_generate_public_css($key,$default);
	  //--------------public css set end----------------


	  $title_typography_value = get_theme_mod( $key.'_title_typography',cts_get_default_title_font($key) );

	  
	  $description_typography_value = get_theme_mod( $key.'_title_typography',cts_get_description_font($key) );	  
	  $description_hr_color  = theta_change_color($description_typography_value['color'],0.8);	  
	  
	  $custom_css .='.ct_tool_row h2{ font-family:'.$title_typography_value['font-family'].'; color:'.$title_typography_value['color'].';text-transform:'.$title_typography_value['text-transform'].';text-align:'.$title_typography_value['text-align'].';font-size:'.$title_typography_value['font-size'].';font-weight:'.$title_typography_value['variant'].'; }
.tool-content-1 .tool-1-text,.tool-content-2 ul li{ font-family:'.$description_typography_value['font-family'].'; color:'.$description_typography_value['color'].';text-transform:'.$description_typography_value['text-transform'].';text-align:'.$description_typography_value['text-align'].';font-size:'.$description_typography_value['font-size'].';font-weight:'.$description_typography_value['variant'].'; }	  
	  
	  ';


	  
 	  break;		  
	  


		
	default:
	  $custom_css  = '';	
	  	  

  }
  
  return $custom_css;	
}



function best_food_section_live_js($key){
  $custom_js ='';
    	
  switch($key){

	case 'slider': 
	
	  $custom_js .= 'var height_all = jQuery(window).height();
		jQuery(".ct_slider .carousel-inner .item").css("height",height_all);	

		jQuery(window).resize(function() {
			var height_all = jQuery(window).height();
			jQuery(".ct_slider .carousel-inner .item").css("height",height_all);
		});';	
		
		$enable_slider = best_food_section_check_enabled('slider');	
		$slider_video = get_theme_mod( 'slider_video',0);	
		if( $enable_slider && $slider_video>0){		
		  $custom_js .= 'jQuery(".ct_slider_video").YTPlayer({align:"center,center"});';
		}
 	  break;


	case 'about':	
	if(get_theme_mod( 'about_enable_animate',1)){
	  $custom_js .= 'var waypoint = new Waypoint({
		  element: jQuery(".ct_about"),
		  handler: function(direction) {
			jQuery(".ct_about .col-md-6 img").addClass("animated rotateIn"); 
		  },
		  offset: "80%"
		});';
	}
 	  break;	


	case 'blog':	
		
	  $custom_js .= 'var waypoint = new Waypoint({
		  element: jQuery(".ct_blog"),
		  handler: function(direction) {
			jQuery(".ct_blog .ct_post_img").addClass("animated rotateIn"); 
		  },
		  offset: "80%"
		});';
 	  break;	
	  
	  
	  
	default:
	  $custom_js  = '';	

  }
  return $custom_js;	

	
}

//Detect whether a scene is enabled
function best_food_section_check_enabled($key){
	
  $section_default = cts_section_default_order();
  
  $sortable_value = maybe_unserialize( get_theme_mod( 'home_layout',$section_default ) );
 
  $return = false;
  
  if ( ! empty( $sortable_value ) ) : 
	foreach ( $sortable_value as $checked_value ) :
	
	
	  if($key ==$checked_value ){$return = true;break;}
	  
	  
	endforeach;
  endif; 	
	
	
  return $return;	
	
}
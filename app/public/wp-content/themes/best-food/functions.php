<?php
define( 'THEME_COLOR', '#ffb606' );

function best_food_setup(){

	require_once( get_stylesheet_directory().'/custom/inc.php');	
	require_once( get_stylesheet_directory().'/custom/best-food-config.php');	
	require_once( get_stylesheet_directory() . '/custom/setup.php');
		
	if ( !function_exists('best_food_themes_pro')) {  
		require_once( get_stylesheet_directory().'/custom/customizer-pro/class-customize.php');		
	}
	
	load_child_theme_textdomain( 'best-food', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'best_food_setup' );
	
function theta_about_page(){
	require_once( get_stylesheet_directory().'/custom/ct-about-page/about-page.php');	
}
add_action( 'after_setup_theme', 'theta_about_page' );	
	
function best_food_custom_scripts()
{
	$theme_info = wp_get_theme();
	
		
	wp_enqueue_style('theta-style',  get_template_directory_uri() .'/style.css',array('theta-base','font-awesome','bootstrap'),$theme_info->get( 'Version' ), false);
	wp_enqueue_style('best-food-style', get_stylesheet_uri(),array('theta-style'), $theme_info->get( 'Version' ) );	

	wp_enqueue_style(
		'best-food-custom-style',
		get_template_directory_uri() . '/css/custom_script.css'
	);
	
	$custom_css = '';
	$color = THEME_COLOR;
		
	//header css
 	if ( get_theme_mod( 'theme_color',$color) ){
		$color = esc_attr(get_theme_mod( 'theme_color',$color)) ;
	}	
				
	$color_hover = theta_change_color($color,0.8);
	$color_rbg = theta_hex2rgb( $color );

	$header_color_rbg = theta_hex2rgb( '#ffffff' );
	
	$custom_css .= '.ct_woocommerce .nav-tabs>li>a{  border: 1px solid '.$color.';   border-bottom-color:'.$color.';}	
					.ct_woocommerce .nav-tabs>li.active>a,.ct_woocommerce  .nav-tabs>li.active>a:focus,.ct_woocommerce  .nav-tabs>li.active>a:hover {
						background-color: '.$color.';border: 1px solid '.$color.';border-bottom-color:'.$color.' ;}
					section.ct_news p.ct_news_a a{color: '.$color.';}section.ct_news p.ct_news_a a:hover{color: '.$color_hover.';}';	

	
	if( is_front_page() ){	
		$custom_css .= '	
		#theta-top-search span.theta-close-search-field{ color:'.$color.';}#theta-top-search .theta-search-form input{ color:#EFEFEF;}
		header.fixed{background-color:transparent;}
		header.changeh{background-color:rgba(0,0,0,0.5) ;	}
		';
	}

	// get sction live css
	$sortable_value = maybe_unserialize( get_theme_mod( 'home_layout', cts_section_default_order() ) );
	

	if ( ! empty( $sortable_value ) ) : 
	  foreach ( $sortable_value as $checked_value ) :
	  
		$custom_css .= best_food_section_live_css($checked_value);

	  endforeach;
	endif; 

    wp_add_inline_style( 'best-food-custom-style', $custom_css );

	wp_enqueue_script('waypoints', get_stylesheet_directory_uri().'/custom/js/jquery.waypoints.min.js', array( 'jquery' ), '4.0.0', false );
	wp_enqueue_script('parallax', get_stylesheet_directory_uri().'/custom/js/parallax.min.js', array( 'jquery' ), '1.5', false );	

			
	wp_enqueue_script('best-food-main', get_stylesheet_directory_uri().'/custom/js/main.js', array( 'jquery','bootstrap','theta-main' ),$theme_info->get( 'Version' ), true );	
	wp_add_inline_script( 'best-food-main', best_food_script_method() );
				
}

add_action( 'wp_enqueue_scripts', 'best_food_custom_scripts' );



function best_food_script_method() {	
	$custom_js = 'jQuery(document).ready(function($){';
	
	//front-page
	$custom_js .= 'var height = jQuery(window).height();
	var width = jQuery(window).width();';

	if(is_front_page() ){
		// get sction live js
		$sortable_value = maybe_unserialize( get_theme_mod( 'home_layout', cts_section_default_order() ) );
		
	
		if ( ! empty( $sortable_value ) ) : 
		  foreach ( $sortable_value as $checked_value ) :
		  
			$custom_js .= best_food_section_live_js($checked_value);
	
		  endforeach;
		endif; 
	}	
	
	
	$custom_js .= '});';
	

	return $custom_js;
}



if ( ! function_exists( 'best_food_get_section_menu' ) ) {
	function best_food_get_section_menu(){
		$section_menu = '';
		$sortable_value = maybe_unserialize( get_theme_mod( 'home_layout',cts_section_default_order() ) );	
		if ( ! empty( $sortable_value ) ) : 
		  foreach ( $sortable_value as $checked_value ) :

			
		  if( get_theme_mod( $checked_value.'_section_menu_title',$checked_value) != '' ){
			$section_menu = '<li data-menuanchor="'.$checked_value.'"><a href="'.home_url('/').'#'.$checked_value.'">'.ucfirst(esc_html(get_theme_mod( $checked_value.'_section_menu_title',$checked_value) )).'</a></li>'.$section_menu;
			}			
		  endforeach;
		endif; 
	
		return $section_menu;
	}

}


/* this function gets thumbnail from Post Thumbnail or Custom field or First post image */
if ( ! function_exists( 'best_food_get_blog_thumbnail' ) ) {
	function best_food_get_blog_thumbnail($post_id)
	{
		if(has_post_thumbnail())
		{
			
			$ct_post_thumbnail_fullpath=wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), "Full");
			$thumb_array['fullpath'] = $ct_post_thumbnail_fullpath[0];
		
		}else{
			$post_content = get_post($post_id)->post_content;
			$thumb_array['fullpath'] = theta_catch_that_image($post_content);
		}	
		
		if($thumb_array['fullpath']=="" )
		{
			$thumb_array['fullpath'] = esc_url(get_theme_mod( 'blog_feature_img',get_stylesheet_directory_uri()."/custom/images/default.jpg"));		
		}		

		return $thumb_array;
		
	}
}

function best_food_get_slider_details($page_id)
{
	$slider = array();
 	$page_data = get_page( $page_id ); 	
	
	$slider['title'] = $page_data->post_title;
	$slider['content'] = $page_data->post_content;	
	
	$ct_post_thumbnail_fullpath=wp_get_attachment_image_src( get_post_thumbnail_id( $page_id ), "Full");
	$slider['images'] = $ct_post_thumbnail_fullpath[0];
	
	return 	$slider;
}


function best_food_get_page_details($page_id , $type)
{
	$return = '';
 	$page_data = get_post( $page_id ); 	
	
	if($type == 'title'){
		$return = $page_data->post_title;
	}
	if($type == 'content'){	
		$return = $page_data->post_content;	
	}
	if($type == 'image'){	
		$ct_post_thumbnail_fullpath=wp_get_attachment_image_src( get_post_thumbnail_id( $page_id ), "Full");
		$return = $ct_post_thumbnail_fullpath[0];
	}
	
	if($type == 'url'){	

		$return = $page_data->guid;	

	}	
	
	
	return 	$return;
}

function best_food_get_testimonial_details($page_id)
{
	$testimonial = array();
	
	$page_data = get_page($page_id);
	$author_id = $page_data->post_author;	

	$testimonial['name'] = get_the_author_meta( 'user_nicename' ,$author_id );
	$testimonial['user_email'] = get_the_author_meta( 'user_email' ,$author_id );

	$testimonial['content'] = $page_data->post_content;	
	
	return 	$testimonial;
}

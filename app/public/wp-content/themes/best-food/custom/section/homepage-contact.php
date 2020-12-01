<?php
  $key = 'contact';
  $custom_css = '';
  //--------------public css set-------------------
  $sections = cts_public_content_default(); 
  $default = $sections[$key];

  //--------------section css set-------------------
	
  $imagepath =  get_stylesheet_directory_uri() . '/custom/images/'; 

  $enable_parallax_background = get_theme_mod( $key.'_enable_parallax_background',$default['parallax']); 
  
  $section_background_image     = esc_url(get_theme_mod( $key.'_section_background_image', $imagepath.'contact.jpg')); 
  
  $parallax_str = '';
  
  if($enable_parallax_background && $section_background_image !=''){  
	  $parallax_str ='data-parallax="scroll" data-image-src="'.$section_background_image.'" '; 
  }
  
  
  $contact_cf7_shortcode = get_theme_mod( 'contact_cf7_shortcode','[contact-form-7 id="222" title="Contact form 1"]');   
  
  $button_arr  = cts_button_default_arr($key);  
  $button_url = esc_url(get_theme_mod( $key.'_button_url',''));  
  $button_text = esc_html(get_theme_mod( $key.'_button_text',$button_arr['button_text']));  

?>
<section id="ct_<?php echo $key;?>" class="ct_section ct_<?php echo $key;?> ct_section_<?php echo $key;?> ">
	<div  id="<?php echo $key;?>" class="section_content "   <?php echo $parallax_str;?> >
    	
        <div class="ct-title container">
        	<?php if ( get_theme_mod( $key.'_section_title', $default['title'] ) != '' ) : ?>
            <h1 class="section_title "><?php echo esc_html( get_theme_mod( $key.'_section_title', $default['title'] ) );  ?></h1>
           
			<?php endif; ?>
			<?php if ( get_theme_mod( $key.'_section_description', $default['description'] ) != '' ) : ?>
				<p class="section_text"><?php echo esc_html( get_theme_mod( $key.'_section_description', $default['description'] ) ); ?></p>
			<?php endif; ?>
            
        </div>


        <div class="ct_<?php echo $key;?>_list container">
          	<div class="row">

			<?php
				//echo do_shortcode( wp_kses_post($contact_cf7_shortcode));
				echo do_shortcode( wp_kses_post(get_option('contact_cf7_shortcode')));
				//echo get_option('header_bzms'); 
            ?>
            
            
          	</div>

        </div><!--div class="ct_gallery_list "-->
        

	</div>
	<div class="clear"></div>
</section>
<?php

  $key = 'about';
  $custom_css = '';
  //--------------public css set-------------------
  $sections = cts_public_content_default(); 
  $default = $sections[$key];

  //--------------section css set-------------------

  $about_page = get_theme_mod( $key.'_page','');  
  
  $imagepath =  get_stylesheet_directory_uri() . '/custom/images/'; 

  $enable_parallax_background = get_theme_mod( $key.'_enable_parallax_background',0); 
  
  $section_background_image     = ''; 
  
  $parallax_str = '';
  
  if($enable_parallax_background && $section_background_image !=''){
	  
	  $parallax_str ='data-parallax="scroll" data-image-src="'.$section_background_image.'" ';
	  
	}
	
	
	$about_button_text_str =  __( 'Read More', 'best-food' );
  
?>
<section id="ct_<?php echo $key;?>" class="ct_section ct_<?php echo $key;?> ct_section_<?php echo $key;?> ">
	<div  id="<?php echo $key;?>" class="section_content "   <?php echo $parallax_str;?> >
    	
        <div class="ct-title container">
        <div class="col-md-6">
        	<?php if ( get_theme_mod( $key.'_section_title', $default['title'] ) != '' ) : ?>
            <h1 class="section_title "><?php echo esc_html( get_theme_mod( $key.'_section_title', $default['title'] ) );  ?></h1>
          
			<?php endif; ?>
			<?php if ( get_theme_mod( $key.'_section_description', $default['description'] ) != '' ) : ?>
				<p class="section_text"><?php echo esc_html( get_theme_mod( $key.'_section_description', $default['description'] ) ); ?></p>
			<?php endif; ?>
         </div>   
        </div>

        <div class="ct_<?php echo $key;?>_list container">
        
			<div class="col-md-6">
            <?php  
				echo best_food_get_page_details($about_page , 'content');
            ?> 
            <p><a class="btn btn-lg btn-primary" href="<?php echo esc_url( get_theme_mod( 'about_button_url','#') ); ?>" role="button">
            	<?php if(get_theme_mod( 'about_button_text','' ) !='' ){ echo  esc_html(get_theme_mod( 'about_button_text','' )) ;}else{ echo __( 'Read More', 'best-food' );} ?> 
            </a></p>
                                  
            </div>
            <div class="col-md-6">
            	<img src="<?php echo esc_url(get_theme_mod( 'about_image','' )); ?>" />
            </div>
            
            
        </div> 

	</div>
	<div class="clear"></div>
</section>

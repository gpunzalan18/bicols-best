<?php

  $key = 'service';
  $custom_css = '';
  //--------------public css set-------------------
  $sections = cts_public_content_default(); 
  $default = $sections[$key];

  //--------------section css set-------------------
  $default_content = cts_section_content_default($key);  
  $repeater_value = get_theme_mod( 'repeater_service',$default_content);	

	
  $imagepath =  get_stylesheet_directory_uri() . '/custom/images/'; 

  $enable_parallax_background = get_theme_mod( $key.'_enable_parallax_background',1); 
  
  $section_background_image     = esc_url(get_theme_mod( $key.'_section_background_image', $imagepath.'service.jpg')); 
  
  $parallax_str = '';
  
  if($enable_parallax_background && $section_background_image !=''){	  
	  $parallax_str ='data-parallax="scroll" data-image-src="'.$section_background_image.'" ';  
  }

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

        <div class="ct_service_list container">

            <?php  
              $k=0;

              if ( ! empty( $repeater_value ) ) :	
                foreach ( $repeater_value as $row ) : 
                  if ( isset( $row[ 'service_icon' ] ) && !empty( $row[ 'service_icon' ] ) ) :
				  
				   if( $k%3 == 0  ){echo '<div class="row ct_service_row'.(($k+3)/3).'"> ';} 
             ?>
             
            	<div class="col-md-4 service<?php echo $k+1;?>">
					<div class="service_content_<?php echo $k+1;?>">	
						<div class="service_content">
							<div class="service_content_image">
                                    <a href="<?php if ( isset( $row[ 'service_url' ] ) && !empty( $row[ 'service_url' ] ) ){echo esc_url( $row[ 'service_url' ] ); } ?>" class="ct_icon">&nbsp;
                                    </a>
                         	</div>
							<div class="service_content_container">

                                
									<?php if ( isset( $row[ 'service_title' ] ) && !empty( $row[ 'service_title' ] ) ) : ?>
                                        <h4><a href="<?php if ( isset( $row[ 'service_url' ] ) && !empty( $row[ 'service_url' ] ) ){echo esc_url( $row[ 'service_url' ] ); } ?>">
                                            <?php echo esc_html( $row[ 'service_title' ] ); ?>
                                        </a></h4>
                                    <?php endif; ?>                                       
									<?php if ( isset( $row[ 'service_description' ] ) && !empty( $row[ 'service_description' ] ) ) : ?>
                                        <p class="feature_sub_text"><?php echo esc_html( $row[ 'service_description' ] ); ?></p>
                                    <?php endif; ?>                                
                                
							</div>
						</div> <!-- .service_content -->
                   	</div>
               	</div>	             
             

                			
			 <?php
			 
				  if( $k%3 ==2 ){echo '</div>';}
				  
				  
				  $k++;

                  endif;
                endforeach;	
              endif;
            ?> 
        </div> 

	</div>
	<div class="clear"></div>
</section>
<?php
	$key = 'slider';	
	$default_content = cts_section_content_default($key);
 
  	$video_select_enable = get_theme_mod( 'video_select_enable','youtube');
  
    $slider_video = get_theme_mod( 'slider_video',0);
  
	//youtube video
	if($video_select_enable =='youtube'){
		$video_youtobe_id = esc_html(get_theme_mod( 'video_youtobe_id','e1c-n1dRxwc'));	  
		$video_mute = get_theme_mod( 'video_mute',0);	
		if($video_mute == ''){ $video_mute =0;}
		  
		$video_addraster = get_theme_mod( 'video_addraster',1);	
		if($video_addraster == ''){ $video_addraster =0;}
		
		  
		$video_bottom_controls_bar = get_theme_mod( 'video_bottom_controls_bar','1');	
		if($video_bottom_controls_bar == ''){ $video_bottom_controls_bar =0;}	
			
		$video_auto_play = get_theme_mod( 'video_auto_play',1);	
		if($video_auto_play == ''){ $video_auto_play =0;}	
		  
		$video_loop = get_theme_mod( 'video_loop','1');	
		if($video_loop == ''){ $video_loop =0;}	
			
		  
		$video_default_volum = get_theme_mod( 'video_default_volum',40);	
		$video_seeks_to = get_theme_mod( 'video_seeks_to',0);	
		if($video_seeks_to == ''){ $video_seeks_to =0;}  
		$video_stop_time = get_theme_mod( 'video_stop_time',0);
		if($video_stop_time == ''){ $video_stop_time =0;}
		
		$video_opacity = get_theme_mod( 'video_opacity',1);	
		if($video_opacity == ''){ $video_opacity =0;}	
			  
	  }
	
	$youtube_str ='';
	if($video_select_enable == 'youtube'){ 
		$youtube_str = 'data-property="{videoURL:\''.$video_youtobe_id.'\', mute:'.$video_mute.',quality:\'default\',opacity:'.$video_opacity.',containment:\'.ct_slider_video\', loop:'.$video_loop.',showControls:'.$video_bottom_controls_bar.',  vol:'.$video_default_volum.',startAt:'.$video_seeks_to.',stopAt:'.$video_stop_time.',autoPlay:'.$video_auto_play.', addRaster:'.$video_addraster.', optimizeDisplay:true, stopMovieOnBlur:true }" ';
	}
	//youtube video end


	$repeater_value = get_theme_mod( 'repeater_slider',$default_content); 
	$slider_li = '';
	$str_active = '';
	
	$j=0;
	
	if ( ! empty( $repeater_value ) ) :	
	  foreach ( $repeater_value as $row ) : 
		if ( isset( $row[ 'slider_page' ] ) && !empty( $row[ 'slider_page' ] ) && $row[ 'slider_page' ]>0 ) :
		
		  if($j==0){ $str =  'class="active"';}
		  $slider_li .= '<li data-target="#myCarousel" data-slide-to="'.$j.'" '.$str_active.'></li>';
		  $sliders[$j] = best_food_get_slider_details($row[ 'slider_page' ]);
		  
		  $j++;
		endif;

	  endforeach;
	endif;
	
	if( !empty($sliders)){
?>
<section id="ct_slider" class="ct_section ct_slider ct_section_1">

<div  class="section_slider ">
  <!-- Carousel================================================== -->
  <div id="myCarousel" class="carousel slide ct_slider_warp" data-ride="carousel"  data-interval="<?php echo esc_attr(get_theme_mod( 'slide_time','5000')); ?> " >
  <!-- Indicators 
  
  	<?php   if($j > 1){  ?>
    <ol class="carousel-indicators">
	<?php
	  echo $slider_li;
    ?>
    </ol>
  	<?php  }   ?>   
     -->
    <div class="carousel-inner" role="listbox">
	<?php  
      $k=0;
	 // $slide_image =array();
      
      if ( ! empty( $repeater_value ) ) :	
        foreach ( $repeater_value as $row ) : 
          if ( isset( $row[ 'slider_page' ] ) && !empty( $row[ 'slider_page' ] ) ) :

     ?>       
            
      <div class="item ct_slider_item_<?php echo $k+1;?>  <?php if($k==0){echo 'active';}?> " >
          
             
             <?php if( $slider_video == ($k+1) && $video_select_enable =='youtube'){?> 
             <div class="ct_slider_video player"    <?php echo $youtube_str;?> >
			 <?php }?>            
             
             
              <div class="carousel-caption">
                  <div class="carousel_caption_warp">

                      <div class="slider_text">
						<?php if ( isset( $sliders[$k][ 'title' ] ) && !empty( $sliders[$k][ 'title' ] ) ) : ?>
                            <h1 class="slider_title">
                                <?php echo esc_html( $sliders[$k][ 'title' ] ); ?>
                            </h1>
                        <?php endif; ?>                      

						<?php if ( isset( $sliders[$k][ 'content' ] ) && !empty($sliders[$k][ 'content' ] ) ) : ?>
                            <p class="ct_slider_text">
                                <?php echo esc_html( $sliders[$k][ 'content' ] ); ?>
                            </p>
                        <?php endif; ?>
                      </div>
					  
                      <p><a class="btn btn-lg btn-primary" href="<?php if ( isset( $row[ 'slider_url' ] ) && !empty( $row[ 'slider_url' ] ) ){echo esc_url( $row[ 'slider_url' ] ); } ?>" role="button">
                        <?php if ( isset( $row[ 'slider_button_text' ] ) && !empty( $row[ 'slider_button_text' ] ) ){echo esc_html( $row[ 'slider_button_text' ] ); }else{esc_html_e( 'Download Now', 'best-food' );} ?> 
                      </a></p>


                  </div>
                  <div class="clear"></div>
                  <?php if(  $slider_video == ($k+1) && $video_select_enable =='youtube'){?>  </div><?php }?>
              </div>
          
      </div><!--div class="item ct_slider_item  -->           
        
        
     <?php
	 		$k++;
          endif;
          
          
        endforeach;	
      endif;
    ?>

    </div>
   	<?php   if($j > 1){  ?>   
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <i class="fa fa-angle-left fa-2x" aria-hidden="true"></i>
        <span class="sr-only"><?php esc_html_e('Previous', 'best-food');?></span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <i class="fa fa-angle-right fa-2x" aria-hidden="true"></i>
        <span class="sr-only"><?php esc_html_e('Next', 'best-food');?></span>
    </a>  
  	<?php   }  ?>    
  </div><!-- /.carousel -->

</div>
<div class="clear"></div>
</section>

<?php } ?>
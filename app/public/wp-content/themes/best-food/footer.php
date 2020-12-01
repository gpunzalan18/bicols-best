 
  	<footer id="footer" class="footer">
         
    	<div class="footer-bottom container">
        	<?php if( is_page_template( 'template/template-home.php' ) ){ ?>
        	<hr />
         	<?php 
				}else{echo '<br />';}
			
			
			?>           
            <?php 
			 	if(  get_theme_mod( 'facebook_link', '#' ) !=''  || get_theme_mod( 'twitter_link', '#' ) !='' || get_theme_mod( 'youtube_link', '#' ) !='' || get_theme_mod( 'pinterest_link', '#' ) !='' || get_theme_mod( 'google_plus_link', '#' ) !='' || get_theme_mod( 'instagram_link', '#' ) !='' ){
			?>
        	<p class="ct_footer_follow"><?php echo __('Follow Us On','best-food')?></p>
            <p class="ct_footer_bookmarks">
                <?php
                    if(  get_theme_mod( 'facebook_link', '#' ) !='' ){
                ?>  
                <a href="<?php echo esc_url(get_theme_mod( 'facebook_link', '#' )) ?>" class="tooltip-test fb" data-toggle="tooltip"  title="Facebook">
                    <i class="fa fa-facebook">&nbsp;</i>
                </a>   
                <?php
                    }
                    if( get_theme_mod( 'twitter_link', '#' ) !=''  ){
                ?>             	
                <a href="<?php echo esc_url(get_theme_mod( 'twitter_link', '#' )) ?>" class="tooltip-test tw" data-toggle="tooltip"  title="Twitter">
                    <i class="fa fa-twitter">&nbsp;</i>
                </a>
                
                <?php
                    }
                    if( get_theme_mod( 'youtube_link', '#' ) !='' ){
                ?>                                  
                
                <a href="<?php echo esc_url(get_theme_mod( 'youtube_link', '#' )) ?>" class="tooltip-test yt" data-toggle="tooltip"  title="Youtube">
                    <i class="fa fa-youtube">&nbsp;</i>
                </a>
                <?php
                    }
                    if(get_theme_mod( 'pinterest_link', '#' ) !=''){
                ?>                                 
                
                <a href="<?php echo esc_url(get_theme_mod( 'pinterest_link', '#' )) ?>" class="tooltip-test pt" data-toggle="tooltip"  title="Pinterest">
                    <i class="fa fa-pinterest">&nbsp;</i>
                </a>			
                <?php
                    }
                    if(get_theme_mod( 'google_plus_link', '#' ) !=''){
                ?>                                 
                
                <a href="<?php echo esc_url(get_theme_mod( 'google_plus_link', '#' )) ?>" class="tooltip-test pt" data-toggle="tooltip"  title="Google Plus">
                    <i class="fa fa-google-plus">&nbsp;</i>
                </a>			
                <?php
                    }
                    if(get_theme_mod( 'instagram_link', '#' ) !=''){
                ?>                                 
                
                <a href="<?php echo esc_url(get_theme_mod( 'instagram_link', '#' )) ?>" class="tooltip-test pt" data-toggle="tooltip"  title="Instagram">
                    <i class="fa fa-instagram">&nbsp;</i>
                </a>			
                <?php
                    }
                ?>                                 	
            </p>       
 
            <?php 
			
				}
			?>
        
      		<p class="copyright">
			<?php 
				if( get_theme_mod( 'footer_code','')!='' ){
					echo html_entity_decode(esc_html(get_theme_mod( 'footer_code','')));
				}
			
				echo html_entity_decode(esc_html(get_theme_mod( 'footer_copy_code',__('Powered by <a href="http://wordpress.org/">WordPress</a>. Best Food theme by <a href="https://www.coothemes.com/">CooThemes.com</a>.','best-food'))));

			
			?></p>
        </div>
    </footer>
    
    
    <?php if( get_theme_mod( 'enable_return_top',1) ){echo '<div id="gotoTop"><i class="fa fa-angle-up" aria-hidden="true"></i></div>';}?> 

    
    <?php wp_footer(); ?>    
</body>
</html>      
   
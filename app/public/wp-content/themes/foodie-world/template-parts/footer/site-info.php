<div id="site-generator" class="site-info small">
	<div class="wrapper">
		<div class="footer-content">
			<?php
		        $theme_data = wp_get_theme();

		        $def_footer_text = sprintf( _x( 'Copyright &copy; %1$s %2$s. All Rights Reserved. %3$s', '1: Year, 2: Site Title with home URL, 3: Privacy Policy Link', 'foodie-world' ), '[the-year]', '[site-link]', '[privacy-policy-link]' ) . ' &#124; ' . esc_html( $theme_data->get( 'Name') ) . '&nbsp;' . esc_html__( 'by', 'foodie-world' ). '&nbsp;<a target="_blank" href="'. esc_url( $theme_data->get( 'AuthorURI' ) ) .'">'. esc_html( $theme_data->get( 'Author' ) ) .'</a>';

		        $footer_text = get_theme_mod( 'foodie_world_footer_content', $def_footer_text );

		        $search = array( '[the-year]', '[site-link]', '[privacy-policy-link]' );

		        $replace = array( esc_attr( date_i18n( __( 'Y', 'foodie-world' ) ) ), '<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a>', get_the_privacy_policy_link() );

		        $footer_text =  str_replace( $search, $replace, $footer_text );

		        echo wp_kses_post( $footer_text );
		    ?>
		</div> <!-- .footer-content -->
	</div> <!-- .wrapper -->
</div><!-- .site-info -->

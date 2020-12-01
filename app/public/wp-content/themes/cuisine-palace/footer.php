<?php
/**
 * The template for displaying our theme footer contents.
 *
 * @package cuisine-palace
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cuisine_palace_copyright_html  = '<div class="credit-defined">';
$cuisine_palace_copyright_html .= '<p>' . esc_html__( ' © All rights reserved | Cuisine Palace by', 'cuisine-palace' ) . ' <a target="_blank" href="' . esc_url( 'https://thecodechime.com/' ) . '">' . esc_html__( 'The Code Chime', 'cuisine-palace' ) . '</a> | ' . esc_html__( 'Proudly powered by', 'cuisine-palace' ) . ' <a target="_blank" href="' . esc_url( 'https://wordpress.org/' ) . '">' . esc_html__( 'WordPress', 'cuisine-palace' ) . '</a></p>';
$cuisine_palace_copyright_html .= '</div>';

$cuisine_palace_copyright = apply_filters( 'cuisine_palace_copyright_html', $cuisine_palace_copyright_html );

?>
	<!-- -----------------------scroll up btn -------------------------- -->
	<div id="btn-scrollup">
		<a class="scrollup" href="#"></a>
	</div>

	<!-- ------------------------------------------------------------------>

	<footer class="footer section">
		<div class="wrapper">
			<div class="container">

				<div class="section-wrapper">

					<div class="footer-layout">
						<?php

						/**
						 * Hook - cuisine_palace_before_footer_credits
						 *
						 * @see - cuisine_palace_get_footer_widgets()
						 */
						do_action( 'cuisine_palace_before_footer_credits' );
						?>

						<div class="footer-credit">
							<div class="footer-credit-wrapper">

								<?php
								cuisine_palace_get_site_identity( true );

								echo wp_kses_post( $cuisine_palace_copyright );
								?>
							</div>
						</div>

						<?php

						/**
						 * Hook - cuisine_palace_after_footer_credits
						 */
						do_action( 'cuisine_palace_after_footer_credits' );
						?>

					</div>
				</div>

			</div>
		</div>
	</footer>

</div> <!-- Our div for #<?php cuisine_palace_get_main_container_id( true ); ?> ends here -->

<!-- Our scripts and styles that are needed at footer. -->
<?php
		/**
		 * This function automatically hooks the styles and scripts
		 * that are needed before </body>
		 *
		 * It is also used my other plugins or child theme developer.
		 */
		wp_footer();
?>
</body>

</html>

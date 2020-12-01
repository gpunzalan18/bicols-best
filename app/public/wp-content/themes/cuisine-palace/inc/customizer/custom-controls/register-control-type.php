<?php
/**
 * Register the misc custom controls and some js rendered controls from here.
 *
 * @package cuisine-palace
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'cuisine_palace_customizer_add_misc_controls' ) ) {

	/**
	 * Register misc custom controls.
	 *
	 * @param object $wp_customize WP customizer object.
	 */
	function cuisine_palace_customizer_add_misc_controls( $wp_customize ) {

		if ( ! class_exists( 'Cuisine_Palace_Customizer_Group_Heading_Control' ) ) {
			/**
			 * Class for creating the controls group heading in customizer.
			 */
			class Cuisine_Palace_Customizer_Group_Heading_Control extends WP_Customize_Control {

				/**
				 * The type of customize control.
				 *
				 * @access public
				 * @since  1.0.0
				 * @var    string
				 */
				public $type = 'group_label';

				/**
				 * Create control template.
				 *
				 * @access public
				 * @since  1.0.0
				 * @return void
				 */
				public function render_content() {
					$content  = '';
					$content .= $this->control_styles();
					$content .= '<div class="customizer-control-group-heading">';
					$content .= '<hr>';
					$content .= '<h2 class="customizer-control-group-heading-label">';
					$content .= ! empty( $this->label ) ? $this->label : '';
					$content .= '</h2>';
					$content .= '</div>';

					echo $content; //phpcs:ignore
				}

				/**
				 * Returns controls styles.
				 */
				private function control_styles() {

					ob_start();
					?>
					<style>
						div.customizer-control-group-heading {
							border-bottom: 2px solid;
						}

						div.customizer-control-group-heading .customizer-control-group-heading-label {
							color:#555d66;
						}
					</style>
					<?php
					return ob_get_clean();
				}
			}
		}

	}
	add_action( 'customize_register', 'cuisine_palace_customizer_add_misc_controls' );
}

if ( ! function_exists( 'cuisine_palace_customizer_register_control_type' ) ) {

	/**
	 * Register the js rendered controls.
	 *
	 * @param object $wp_customize WP customizer object.
	 */
	function cuisine_palace_customizer_register_control_type( $wp_customize ) {
		$wp_customize->register_control_type( 'Cuisine_Palace_Customizer_Toggle_Control' );
	}
	add_action( 'customize_register', 'cuisine_palace_customizer_register_control_type' );
}

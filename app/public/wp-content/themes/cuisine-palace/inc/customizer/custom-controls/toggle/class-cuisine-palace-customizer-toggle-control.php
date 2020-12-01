<?php
/**
 * Custom toggle control for the customizer.
 *
 * @link https://richtabor.com/customizer-toggle-control/
 * @package cuisine-palace
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Exit if WP_Customize_Control does not exists.
 */
if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return;
}

if ( ! class_exists( 'Cuisine_Palace_Customizer_Toggle_Control' ) ) {

	/**
	 * Class for toggle control in customizer.
	 */
	class Cuisine_Palace_Customizer_Toggle_Control extends WP_Customize_Control {

		/**
		 * The type of customize control.
		 *
		 * @access public
		 * @since  1.0.0
		 * @var    string
		 */
		public $type = 'cuisine_palace_toggle';

		/**
		 * Enqueue scripts and styles.
		 *
		 * @access public
		 * @since  1.0.0
		 * @return void
		 */
		public function enqueue() {
			$path   = get_template_directory_uri() . '/inc/customizer/custom-controls/toggle';
			$handle = 'cuisine-palace-customizer-toggle-control';
			wp_enqueue_style( "{$handle}-style", "{$path}/toggle.css", false, '1.0.0', 'all' );
			wp_enqueue_script( "{$handle}-script", "{$path}/toggle.js", array( 'jquery' ), '1.0.0', true );
		}

		/**
		 * Add custom parameters to pass to the JS via JSON.
		 *
		 * @access public
		 * @since 1.0.0
		 * @return void
		 */
		public function to_json() {
			parent::to_json();

			// The setting value.
			$this->json['id']           = $this->id;
			$this->json['value']        = $this->value();
			$this->json['link']         = $this->get_link();
			$this->json['defaultValue'] = $this->setting->default;
		}

		/**
		 * Don't render the content via PHP.  This control is handled with a JS template.
		 *
		 * @access public
		 * @since  1.0.0
		 * @return void
		 */
		public function render_content() {}

		/**
		 * An Underscore (JS) template for this control's content.
		 *
		 * Class variables for this control class are available in the `data` JS object;
		 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
		 *
		 * @see    WP_Customize_Control::print_template()
		 *
		 * @access protected
		 * @since  1.0.0
		 * @return void
		 */
		protected function content_template() {
			?>
			<label class="toggle">
				<div class="toggle--wrapper">
					<# if ( data.label ) { #>
						<span class="customize-control-title">{{ data.label }}</span>
					<# } #>
					<input id="toggle-{{ data.id }}" type="checkbox" class="toggle--input" value="{{ data.value }}" {{{ data.link }}} <# if ( data.value ) { #> checked="checked" <# } #> />
					<label for="toggle-{{ data.id }}" class="toggle--label"></label>
				</div>
				<# if ( data.description ) { #>
					<span class="description customize-control-description">{{ data.description }}</span>
				<# } #>
			</label>
			<?php
		}

	}
}

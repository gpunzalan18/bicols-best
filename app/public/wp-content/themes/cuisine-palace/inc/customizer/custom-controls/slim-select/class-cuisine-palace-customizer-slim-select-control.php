<?php
/**
 * Custom slim select control for the customizer.
 *
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

if ( ! class_exists( 'Cuisine_Palace_Customizer_Slim_Select_Control' ) ) {

	/**
	 * Class for slim-select control in customizer.
	 *
	 * @see https://slimselectjs.com/ for reference.
	 */
	class Cuisine_Palace_Customizer_Slim_Select_Control extends WP_Customize_Control {

		/**
		 * The type of customize control.
		 *
		 * @access public
		 * @since  1.0.0
		 * @var    string
		 */
		public $type = 'cuisine_palace_slim_select';

		/**
		 * Enqueue scripts and styles.
		 *
		 * @access public
		 * @since  1.0.0
		 * @return void
		 */
		public function enqueue() {
			$path   = get_template_directory_uri() . '/inc/customizer/custom-controls/slim-select';
			$handle = 'cuisine-palace-customizer-slim-select-control';
			$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '.' : '.min.';
			wp_enqueue_style( "{$handle}-style", "{$path}/slimselect{$suffix}css", false, '1.26.0', 'all' );
			wp_enqueue_script( "{$handle}-script", "{$path}/slimselect{$suffix}js", array(), '1.26.0', true );
			wp_enqueue_script( "{$handle}-control-script", "{$path}/slimselect-control.js", array( "{$handle}-script" ), '1.0.0', true );
		}

		/**
		 * Create control template.
		 *
		 * @access public
		 * @since  1.0.0
		 * @return void
		 */
		public function render_content() {
			$id       = ! empty( $this->id ) ? $this->id : '';
			$label    = ! empty( $this->label ) ? $this->label : '';
			$choices  = ! empty( $this->choices ) ? $this->choices : array();
			$attrs    = ! empty( $this->input_attrs ) ? $this->input_attrs : array();
			$link     = $this->get_link();
			$multiple = ! empty( $attrs['multiple'] ) ? 'multiple="multiple"' : '';
			$limit    = $multiple && ! empty( $attrs['limit'] ) ? 'data-limit=' . $attrs['limit'] : false;

			$description = ! empty( $this->description ) ? $this->description : '';
			?>
			<label class="customizer-slim-select">
				<div class="customizer-slim-select--wrapper">
					<?php if ( $label ) { ?>
						<span class="customize-control-title"><?php echo esc_html( $label ); ?></span>
					<?php } ?>
					<?php if ( ! empty( $description ) ) { ?>
						<span class="description customize-control-description"><?php echo esc_html( $description ); ?></span>
					<?php } ?>
					<select <?php echo esc_attr( $link ); ?> id="slim-select-<?php echo esc_attr( $id ); ?>" <?php echo esc_attr( $multiple ); ?> <?php echo esc_attr( $limit ); ?> class="customizer-slim-select-dropdown">
					<?php if ( is_array( $choices ) && count( $choices ) > 0 ) { ?>
						<?php foreach ( $choices as $opt_value => $opt_label ) { ?>
							<?php if ( 'none' === $opt_value ) { ?>
								<option data-placeholder="true"><?php echo esc_html( $opt_label ); ?></option>
							<?php } else { ?>
								<?php if ( strstr( $opt_value, 'optgroup_start' ) ) { ?>
									<optgroup label="<?php echo esc_attr( $opt_label ); ?>">
								<?php } else { ?>
									<option value="<?php echo esc_attr( $opt_value ); ?>"><?php echo esc_html( $opt_label ); ?></option>
								<?php } ?>
								<?php if ( strstr( $opt_value, 'optgroup_end' ) ) { ?>
									</optgroup>
								<?php } ?>
							<?php } ?>
						<?php } ?>
					<?php } ?>
					</select>
				</div>
			</label>
			<?php
		}

	}
}

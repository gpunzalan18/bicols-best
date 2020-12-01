<?php
/**
 * The template for displaying meta box in page/post
 *
 * This adds Select Sidebar, Header Featured Image Options, Single Page/Post Image Layout
 * This is only for the design purpose and not used to save any content
 *
 * @package Foodie_World
 */



/**
 * Class to Renders and save metabox options
 *
 * @since Foodie World 0.1
 */
class foodie_world_metabox {
	private $meta_box;

	private $fields;

	/**
	* Constructor
	*
	* @since Foodie World 0.1
	*
	* @access public
	*
	*/
	public function __construct( $meta_box_id, $meta_box_title, $post_type ) {

		$this->meta_box = array (
							'id' 		=> $meta_box_id,
							'title' 	=> $meta_box_title,
							'post_type' => $post_type,
							);

		$this->fields = array(
			'foodie-world-header-image',
			'foodie-world-featured-image',
		);


		// Add metaboxes
		add_action( 'add_meta_boxes', array( $this, 'add' ) );

		add_action( 'save_post', array( $this, 'save' ) );
	}

	/**
	* Add Meta Box for multiple post types.
	*
	* @since Foodie World 0.1
	*
	* @access public
	*/
	public function add( $post_type ) {
		add_meta_box( $this->meta_box['id'], $this->meta_box['title'], array( $this, 'show' ), $post_type, 'side', 'high' );
	}

	/**
	* Renders metabox
	*
	* @since Foodie World 0.1
	*
	* @access public
	*/
	public function show() {
		global $post;

		$header_image_options 	= array(
			'default' => esc_html__( 'Default', 'foodie-world' ),
			'enable'  => esc_html__( 'Enable', 'foodie-world' ),
			'disable' => esc_html__( 'Disable', 'foodie-world' ),
		);

		$featured_image_options	= array(
			'disabled'                 => esc_html__( 'Disabled', 'foodie-world' ),
			'default'                  => esc_html__( 'Default', 'foodie-world' ),
			'post-thumbnail'           => esc_html__( 'Post Thumbnail (1060x596)', 'foodie-world' ),
			'foodie-world-featured' => esc_html__( 'Featured (664x373)', 'foodie-world' ),
			'full'                     => esc_html__( 'Original Image Size', 'foodie-world' ),
		);


		// Use nonce for verification
		wp_nonce_field( basename( __FILE__ ), 'foodie_world_custom_meta_box_nonce' );

		// Begin the field table and loop  ?>
		<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="foodie-world-header-image"><?php esc_html_e( 'Header Featured Image Options', 'foodie-world' ); ?></label></p>
		<select class="widefat" name="foodie-world-header-image" id="foodie-world-header-image">
			 <?php
				$meta_value = get_post_meta( $post->ID, 'foodie-world-header-image', true );
				
				if ( empty( $meta_value ) ){
					$meta_value='default';
				}
				
				foreach ( $header_image_options as $field =>$label ) {	
				?>
					<option value="<?php echo esc_attr( $field ); ?>" <?php selected( $meta_value, $field ); ?>><?php echo esc_html( $label ); ?></option>
				<?php
				} // end foreach
			?>
		</select>
		<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="foodie-world-featured-image"><?php esc_html_e( 'Single Page/Post Image', 'foodie-world' ); ?></label></p>
		<select class="widefat" name="foodie-world-featured-image" id="foodie-world-featured-image">
			 <?php
				$meta_value = get_post_meta( $post->ID, 'foodie-world-featured-image', true );
				
				if ( empty( $meta_value ) ){
					$meta_value='default';
				}
				
				foreach ( $featured_image_options as $field =>$label ) {	
				?>
					<option value="<?php echo esc_attr( $field ); ?>" <?php selected( $meta_value, $field ); ?>><?php echo esc_html( $label ); ?></option>
				<?php
				} // end foreach
			?>
		</select>
		<?php
	}

	/**
	 * Save custom metabox data
	 *
	 * @action save_post
	 *
	 * @since Foodie World 0.1
	 *
	 * @access public
	 */
	public function save( $post_id ) {
		global $post_type;

		$post_type_object = get_post_type_object( $post_type );

		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                      // Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )        // Check Revision
		|| ( ! in_array( $post_type, $this->meta_box['post_type'] ) )                  // Check if current post type is supported.
		|| ( ! check_admin_referer( basename( __FILE__ ), 'foodie_world_custom_meta_box_nonce') )    // Check nonce - Security
		|| ( ! current_user_can( $post_type_object->cap->edit_post, $post_id ) ) )  // Check permission
		{
		  return $post_id;
		}

		foreach ( $this->fields as $field ) {
			$new = $_POST[ $field ];

			delete_post_meta( $post_id, $field );

			if ( '' == $new || array() == $new ) {
				return;
			} else {
				if ( ! update_post_meta ( $post_id, $field, sanitize_key( $new ) ) ) {
					add_post_meta( $post_id, $field, sanitize_key( $new ), true );
				}
			}
		} // end foreach
	}
}

$foodie_world_metabox = new foodie_world_metabox(
	'foodie-world-options', 					//metabox id
	esc_html__( 'Foodie World Options', 'foodie-world' ), //metabox title
	array( 'page', 'post' )				//metabox post types
);

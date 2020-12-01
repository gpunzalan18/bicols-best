<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Foodie_World
 */

/**
 * Sets up the WordPress core custom header and custom background features.
 *
 * @since Foodie World Pro 1.0
 *
 * @see foodie_world_header_style()
 */
function foodie_world_custom_header_and_background() {
	/**
	 * Filter the arguments used when adding 'custom-background' support in Foodie World.
	 *
	 * @since Foodie World Pro 1.0
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 *
	 *     @type string $default-color Default color of the background.
	 * }
	 */
	add_theme_support( 'custom-background', apply_filters( 'foodie_world_custom_background_args', array(
		'default-color' => '#1a1a1a',
	) ) );

	/**
	 * Filter the arguments used when adding 'custom-header' support in Foodie World.
	 *
	 * @since Foodie World Pro 1.0
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type string $default-text-color Default color of the header text.
	 *     @type int      $width            Width in pixels of the custom header image. Default 1200.
	 *     @type int      $height           Height in pixels of the custom header image. Default 280.
	 *     @type bool     $flex-height      Whether to allow flexible-height header images. Default true.
	 *     @type callable $wp-head-callback Callback function used to style the header image and text
	 *                                      displayed on the blog.
	 * }
	 */
	add_theme_support( 'custom-header', apply_filters( 'foodie_world_custom_header_args', array(
		'default-image'      	 => get_parent_theme_file_uri( '/assets/images/header.jpg' ),
		'default-text-color'     =>'#ff6b08',
		'width'                  => 1920,
		'height'                 => 400,
		'flex-height'            => true,
		'flex-height'            => true,
		'wp-head-callback'       => 'foodie_world_header_style',
		'video'                  => true,
	) ) );

	$default_headers_args = array(
		'main' => array(
			'thumbnail_url' => get_stylesheet_directory_uri() . '/assets/images/header-thumb.jpg',
			'url'           => get_stylesheet_directory_uri() . '/assets/images/header.jpg',
		),
	);

	register_default_headers( $default_headers_args );
}
add_action( 'after_setup_theme', 'foodie_world_custom_header_and_background' );

if ( ! function_exists( 'foodie_world_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see foodie_world_custom_header_setup().
	 */
	function foodie_world_header_style() {
		$header_text_color = get_header_textcolor();

		$header_image = foodie_world_featured_overall_image();

	    if ( $header_image ) : ?>
	        <style type="text/css" rel="header-image">
	            .custom-header:before {
	                background-image: url( <?php echo esc_url( $header_image ); ?>);
					background-position: center;
					background-repeat: no-repeat;
					background-size: cover;
	            }
	        </style>
	    <?php
	    endif;

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
		?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
		<?php
			// If the user has set a custom color for the text use that.
			else :
		?>
			.site-title a {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;

if ( ! function_exists( 'foodie_world_featured_image' ) ) :
	/**
	 * Template for Featured Header Image from theme options
	 *
	 * To override this in a child theme
	 * simply create your own foodie_world_featured_image(), and that function will be used instead.
	 *
	 * @since Foodie World 0.1
	 */
	function foodie_world_featured_image() {
		$thumbnail = is_front_page() ? 'foodie-world-header-inner' : 'foodie-world-slider';

		if ( is_post_type_archive( 'jetpack-testimonial' ) ) {
			$jetpack_options = get_theme_mod( 'jetpack_testimonials' );

			if ( isset( $jetpack_options['featured-image'] ) && '' !== $jetpack_options['featured-image'] ) {
				$image = wp_get_attachment_image_src( (int) $jetpack_options['featured-image'], $thumbnail );
				return $image[0];
			} else {
				return false;
			}
		} elseif ( is_post_type_archive( 'jetpack-portfolio' ) ) {
			$jetpack_portfolio_featured_image = get_option( 'jetpack_portfolio_featured_image' );

			if ( '' !== $jetpack_portfolio_featured_image ) {
				$image = wp_get_attachment_image_src( (int) $jetpack_portfolio_featured_image, $thumbnail );
				return $image[0];
			} else {
				return false;
			}
		} elseif ( is_header_video_active() && has_header_video() ) {
			return true;
		} else {
			return get_header_image();
		}
	} // foodie_world_featured_image
endif;

if ( ! function_exists( 'foodie_world_featured_page_post_image' ) ) :
	/**
	 * Template for Featured Header Image from Post and Page
	 *
	 * To override this in a child theme
	 * simply create your own foodie_world_featured_imaage_pagepost(), and that function will be used instead.
	 *
	 * @since Foodie World 0.1
	 */
	function foodie_world_featured_page_post_image() {
		if ( ! has_post_thumbnail() ) {
			return foodie_world_featured_image();
		}

		$thumbnail = is_front_page() ? 'foodie-world-header-inner' : 'foodie-world-slider';

		return get_the_post_thumbnail_url( get_the_id(), $thumbnail );
	} // foodie_world_featured_page_post_image
endif;

if ( ! function_exists( 'foodie_world_featured_overall_image' ) ) :
	/**
	 * Template for Featured Header Image from theme options
	 *
	 * To override this in a child theme
	 * simply create your own foodie_world_featured_pagepost_image(), and that function will be used instead.
	 *
	 * @since Foodie World 0.1
	 */
	function foodie_world_featured_overall_image() {
		global $post, $wp_query;
		$enable = get_theme_mod( 'foodie_world_header_media_option', 'exclude-home-page-post' );

		// Get Page ID outside Loop
		$page_id = absint( $wp_query->get_queried_object_id() );

		$page_for_posts = absint( get_option( 'page_for_posts' ) );

		// Check Enable/Disable header image in Page/Post Meta box
		if ( is_singular() ) {
			//Individual Page/Post Image Setting
			$individual_featured_image = get_post_meta( $post->ID, 'foodie-world-header-image', true );

			if ( 'disable' === $individual_featured_image || ( 'default' === $individual_featured_image && 'disable' === $enable ) ) {
				return;
			} elseif ( 'enable' == $individual_featured_image && 'disable' === $enable ) {
				return foodie_world_featured_page_post_image();
			}
		}

		// Check Homepage
		if ( 'homepage' === $enable ) {
			if ( is_front_page() || ( is_home() && $page_for_posts !== $page_id ) ) {
				return foodie_world_featured_image();
			}
		} elseif ( 'exclude-home' === $enable ) {
			// Check Excluding Homepage
			if ( is_front_page() || ( is_home() && $page_for_posts !== $page_id ) ) {
				return false;
			} else {
				return foodie_world_featured_image();
			}
		} elseif ( 'exclude-home-page-post' === $enable ) {
			if ( is_front_page() || ( is_home() && $page_for_posts !== $page_id ) ) {
				return false;
			} elseif ( is_singular() ) {
				return foodie_world_featured_page_post_image();
			} else {
				return foodie_world_featured_image();
			}
		} elseif ( 'entire-site' === $enable ) {
			// Check Entire Site
			return foodie_world_featured_image();
		} elseif ( 'entire-site-page-post' === $enable ) {
			// Check Entire Site (Post/Page)
			if ( is_singular() || ( is_home() && $page_for_posts === $page_id ) ) {
				return foodie_world_featured_page_post_image();
			} else {
				return foodie_world_featured_image();
			}
		} elseif ( 'pages-posts' === $enable ) {
			// Check Page/Post
			if ( is_singular() ) {
				return foodie_world_featured_page_post_image();
			}
		}

		return false;
	} // foodie_world_featured_overall_image
endif;

if ( ! function_exists( 'foodie_world_header_media_text' ) ):
	/**
	 * Display Header Media Text
	 *
	 * @since Foodie World 0.1
	 */
	function foodie_world_header_media_text() {
		if ( ! foodie_world_has_header_media_text() ) {
			// Bail early if header media text is disabled
			return false;
		}
		?>
		<div class="custom-header-content">
			<header class="entry-header">
				<?php 
					if ( is_singular() ) {
						echo '<h1 class="entry-title">';
						foodie_world_header_title(); 
						echo '</h1>';
					} else {
						echo '<h2 class="entry-title">';
						foodie_world_header_title(); 
						echo '</h2>';
					}
				?>
			</header>
			<div class="entry-summary">
				<?php foodie_world_header_text(); ?>

				<?php if ( is_front_page() && $header_media_url = get_theme_mod( 'foodie_world_header_media_url', '' ) ) : ?>
				<span class="more-button"><a href="<?php echo esc_url( $header_media_url ); ?>" target="<?php echo esc_attr( get_theme_mod( 'foodie_world_header_url_target' ) ) ? '_blank' : '_self'; ?>" class="more-link"><?php echo esc_html( get_theme_mod( 'foodie_world_header_media_url_text' ) ); ?><span class="screen-reader-text"><?php echo wp_kses_post( get_theme_mod( 'foodie_world_header_media_title' ) ); ?></span></a></span>
				<?php endif; ?>
			</div>
		</div> <!-- entry-container -->
		<?php
	} // foodie_world_header_media_text.
endif;

if ( ! function_exists( 'foodie_world_has_header_media_text' ) ):
	/**
	 * Return Header Media Text fro front page
	 *
	 * @since Foodie World 0.1
	 */
	function foodie_world_has_header_media_text() {
		$header_media_title    = get_theme_mod( 'foodie_world_header_media_title' );
		$header_media_text     = get_theme_mod( 'foodie_world_header_media_text' );
		$header_media_url      = get_theme_mod( 'foodie_world_header_media_url', '' );
		$header_media_url_text = get_theme_mod( 'foodie_world_header_media_url_text' );

		$header_image = foodie_world_featured_overall_image();

		if ( ( is_front_page() && ! $header_media_title && ! $header_media_text && ! $header_media_url && ! $header_media_url_text ) || ( ( is_singular() || is_archive() || is_search() || is_404() ) && ! $header_image ) ) {
			// Header Media text Disabled
			return false;
		}

		return true;
	} // foodie_world_has_header_media_text.
endif;

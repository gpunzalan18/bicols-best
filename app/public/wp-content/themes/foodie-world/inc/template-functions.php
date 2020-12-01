<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Foodie_World
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function foodie_world_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

		$classes[] = 'navigation-classic';

	// Adds a class with respect to layout selected.
	$layout  = foodie_world_get_theme_layout();
	$sidebar = foodie_world_get_sidebar_id();

	if ( 'no-sidebar' === $layout ) {
		$classes[] = 'no-sidebar content-width-layout';
	}
	elseif ( 'no-sidebar-full-width' === $layout ) {
		$classes[] = 'no-sidebar full-width-layout';
	} elseif ( 'left-sidebar' === $layout ) {
		if ( '' !== $sidebar ) {
			$classes[] = 'two-columns-layout content-right';
		}
	} elseif ( 'right-sidebar' === $layout ) {
		if ( '' !== $sidebar ) {
			$classes[] = 'two-columns-layout content-left';
		}
	}

	// Adds a class of (full-width|box) to blogs.
	if ( 'boxed' === get_theme_mod( 'foodie_world_layout_type' ) ) {
		$classes[] = 'boxed-layout';
	} else {
		$classes[] = 'fluid-layout';
	}

	$header_media_title    = get_theme_mod( 'foodie_world_header_media_title' );
	$header_media_text     = get_theme_mod( 'foodie_world_header_media_text' );
	$header_media_url      = get_theme_mod( 'foodie_world_header_media_url', '' );
	$header_media_url_text = get_theme_mod( 'foodie_world_header_media_url_text' );

	if ( is_front_page() && ! $header_media_title && ! $header_media_text && ! $header_media_url && ! $header_media_url_text ) {
		$classes[] = 'no-header-media-text';
	}

	$header_image = foodie_world_featured_overall_image();

	if ( '' == $header_image ) {
		$classes[] = 'no-header-media-image';
	}

	$header_text_enabled = foodie_world_has_header_media_text();

	if ( ! $header_text_enabled ) {
		$classes[] = 'no-header-media-text';
	}

	return $classes;
}
add_filter( 'body_class', 'foodie_world_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function foodie_world_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'foodie_world_pingback_header' );

if ( ! function_exists( 'foodie_world_comment_form_fields' ) ) :
	/**
	 * Modify Comment Form Fields
	 *
	 * @uses comment_form_default_fields filter
	 * @since Personal Trainer Pro 1.0
	 */
	function foodie_world_comment_form_fields( $fields ) {
		$disable_website = get_theme_mod( 'foodie_world_website_field' );

		if ( isset( $fields['url'] ) && $disable_website ) {
			unset( $fields['url'] );
		}

		return $fields;
	}
endif; // foodie_world_comment_form_fields.
add_filter( 'comment_form_default_fields', 'foodie_world_comment_form_fields' );

/**
 * Adds Promotion Headline BG CSS
 */
function foodie_world_promo_headline_bg_css() {
	$enable_section = get_theme_mod( 'foodie_world_promotion_headline_visibility', 'homepage' );

	if ( ! foodie_world_check_section( $enable_section ) ) {
		// Bail if promotion_headline content is not enabled
		return;
	}

	$type = get_theme_mod( 'foodie_world_promotion_headline_type', 'page' );
	$css = '';

	if ( 'page' === $type || 'post' === $type || 'category' === $type ) {
		if ( 'page' === $type && $id = get_theme_mod( 'foodie_world_promotion_headline_page' ) ) {
			$id = absint( $id );
		} elseif ( 'post' === $type && $id = get_theme_mod( 'foodie_world_promotion_headline_post' ) ) {
			$id = absint( $id );
		} elseif ( 'category' === $type && $cat = get_theme_mod( 'foodie_world_promotion_headline_category' ) ) {
			$args['cat']            = absint( $cat );
			$args['posts_per_page'] = 1;

			$post_id = get_posts( $args );

			$id = $post_id[0]->ID;
		}

		if ( has_post_thumbnail( $id ) ) {
			$css = '
				#promotion-headline {
					background: url(\'' . get_the_post_thumbnail_url( $id, 'foodie-world-slider' ) . '\');
					background-attachment: fixed;
					background-repeat: no-repeat;
					background-size: cover;
					background-position: center center;
				}';
		}

	} else {
		$image = get_theme_mod( 'foodie_world_promotion_headline_image' );

		if ( $image ) {
			$css = '
				#promotion-headline {
					background: url(\'' . esc_url($image ) . '\');
					background-attachment: fixed;
					background-repeat: no-repeat;
					background-size: cover;
					background-position: center center;
				}';
		}
	}

	wp_add_inline_style( 'foodie-world-style', $css );
}
add_action( 'wp_enqueue_scripts', 'foodie_world_promo_headline_bg_css', 11 );

/**
 * Remove first post from blog as it is already show via recent post template
 */
function foodie_world_alter_home( $query ) {
	if ( $query->is_home() && $query->is_main_query() ) {
		$cats = get_theme_mod( 'foodie_world_front_page_category' );

		if ( is_array( $cats ) && ! in_array( '0', $cats ) ) {
			$query->query_vars['category__in'] = $cats;
		}

		if ( get_theme_mod( 'foodie_world_exclude_slider_post' ) ) {
			$quantity = get_theme_mod( 'foodie_world_slider_number', 4 );

			$post_list	= array();	// list of valid post ids

			for( $i = 1; $i <= $quantity; $i++ ){
				if ( get_theme_mod( 'foodie_world_slider_post_' . $i ) && get_theme_mod( 'foodie_world_slider_post_' . $i ) > 0 ) {
					$post_list = array_merge( $post_list, array( get_theme_mod( 'foodie_world_slider_post_' . $i ) ) );
				}
			}

			if ( ! empty( $post_list ) ) {
				$query->query_vars['post__not_in'] = $post_list;
			}
		}
	}
}
add_action( 'pre_get_posts', 'foodie_world_alter_home' );

/**
 * Function to add Scroll Up icon
 */
function foodie_world_scrollup() {
	$disable_scrollup = get_theme_mod( 'foodie_world_disable_scrollup' );

	if ( $disable_scrollup ) {
		return;
	}

	echo '
		<div class="scrollup">
			<a href="#masthead" id="scrollup" class="fa fa-sort-asc" aria-hidden="true"><span class="screen-reader-text">' . esc_html__( 'Scroll Up', 'foodie-world' ) . '</span></a>
		</div>' ;
}
add_action( 'wp_footer', 'foodie_world_scrollup', 1 );

if ( ! function_exists( 'foodie_world_content_nav' ) ) :
	/**
	 * Display navigation/pagination when applicable
	 *
	 * @since Personal Trainer Pro 1.0
	 */
	function foodie_world_content_nav() {
		global $wp_query;

		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) ) {
			return;
		}

		$pagination_type = get_theme_mod( 'foodie_world_pagination_type', 'default' );

		/**
		 * Check if navigation type is Jetpack Infinite Scroll and if it is enabled, else goto default pagination
		 * if it's active then disable pagination
		 */
		if ( ( 'infinite-scroll' === $pagination_type ) && class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) {
			return false;
		}

		if ( 'numeric' === $pagination_type && function_exists( 'the_posts_pagination' ) ) {
			the_posts_pagination( array(
				'prev_text'          => esc_html__( 'Previous', 'foodie-world' ),
				'next_text'          => esc_html__( 'Next', 'foodie-world' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'foodie-world' ) . ' </span>',
			) );
		} else {
			the_posts_navigation();
		}
	}
endif; // foodie_world_content_nav

/**
 * Check if a section is enabled or not based on the $value parameter
 * @param  string $value Value of the section that is to be checked
 * @return boolean return true if section is enabled otherwise false
 */
function foodie_world_check_section( $value ) {
	global $wp_query;

	// Get Page ID outside Loop
	$page_id = absint( $wp_query->get_queried_object_id() );

	// Front page displays in Reading Settings
	$page_for_posts = absint( get_option( 'page_for_posts' ) );

	return ( 'entire-site' == $value  || ( ( is_front_page() || ( is_home() && $page_for_posts !== $page_id ) ) && 'homepage' == $value ) );
}

/**
 * Return the first image in a post. Works inside a loop.
 * @param [integer] $post_id [Post or page id]
 * @param [string/array] $size Image size. Either a string keyword (thumbnail, medium, large or full) or a 2-item array representing width and height in pixels, e.g. array(32,32).
 * @param [string/array] $attr Query string or array of attributes.
 * @return [string] image html
 *
 * @since Personal Trainer Pro 1.0
 */

function foodie_world_get_first_image( $postID, $size, $attr, $src = false ) {
	ob_start();

	ob_end_clean();

	$image 	= '';

	$output = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', get_post_field( 'post_content', $postID ) , $matches );

	if( isset( $matches[1][0] ) ) {
		//Get first image
		$first_img = $matches[1][0];

		if ( $src ) {
			//Return url of src is true
			return $first_img;
		}

		return '<img class="pngfix wp-post-image" src="' . $first_img . '">';
	}

	return false;
}

function foodie_world_get_theme_layout() {
	$layout = '';

	if ( is_page_template( 'templates/no-sidebar.php' ) ) {
		$layout = 'no-sidebar';
	} elseif ( is_page_template( 'templates/full-width-page.php' ) ) {
		$layout = 'no-sidebar-full-width';
	} elseif ( is_page_template( 'templates/left-sidebar.php' ) ) {
		$layout = 'left-sidebar';
	} elseif ( is_page_template( 'templates/right-sidebar.php' ) ) {
		$layout = 'right-sidebar';
	} else {
		$layout = get_theme_mod( 'foodie_world_default_layout', 'right-sidebar' );

		if ( is_home() || is_archive() || is_search() ) {
			$layout = get_theme_mod( 'foodie_world_homepage_archive_layout', 'no-sidebar-full-width' );
		}
	}

	return $layout;
}

function foodie_world_get_sidebar_id() {
	$sidebar = '';

	$layout = foodie_world_get_theme_layout();

	$sidebaroptions = '';

	if ( 'no-sidebar-full-content-width' === $layout || 'no-sidebar-full-width' === $layout || 'no-sidebar' === $layout ) {
		return $sidebar;
	}

	if ( is_active_sidebar( 'sidebar-1' ) ) {
		$sidebar = 'sidebar-1'; // Primary Sidebar.
	}

	return $sidebar;
}

/**
 * Featured content posts
 */
function foodie_world_get_featured_posts() {

	$number = get_theme_mod( 'foodie_world_featured_content_number', 3 );

	$post_list    = array();

	$args = array(
		'posts_per_page'      => $number,
		'post_type'           => 'featured-content',
		'ignore_sticky_posts' => 1, // ignore sticky posts.
	);

	// Get valid number of posts.
		for ( $i = 1; $i <= $number; $i++ ) {
			$post_id = '';
			$post_id = get_theme_mod( 'foodie_world_featured_content_cpt_' . $i );

			if ( $post_id && '' !== $post_id ) {
				$post_list = array_merge( $post_list, array( $post_id ) );
			}
		}

		$args['post__in'] = $post_list;
		$args['orderby']  = 'post__in';

	$featured_posts = get_posts( $args );

	return $featured_posts;
}


/**
 * Services content posts
 */
function foodie_world_get_services_posts() {
	$number = get_theme_mod( 'foodie_world_services_number', 2 );

	$post_list    = array();

	$args = array(
		'posts_per_page'      => $number,
		'post_type'           => 'post',
		'ignore_sticky_posts' => 1, // ignore sticky posts.
	);

	$args['post_type'] = 'ect-service';

	for ( $i = 1; $i <= $number; $i++ ) {
		$post_id = get_theme_mod( 'foodie_world_services_cpt_' . $i );

		if ( $post_id && '' !== $post_id ) {
			$post_list = array_merge( $post_list, array( $post_id ) );
		}
	}

	$args['post__in'] = $post_list;
	$args['orderby']  = 'post__in';

	$services_posts = get_posts( $args );

	return $services_posts;
}

if ( ! function_exists( 'foodie_world_enable_homepage_posts' ) ) :
	/**
	 * Determine Homepage Content disabled or not
	 * @return boolean
	 */
	function foodie_world_enable_homepage_posts() {
	   if ( ! ( get_theme_mod( 'foodie_world_disable_homepage_posts' ) && is_front_page() ) ) {
			return true;
		}
		return false;
	}
endif; // foodie_world_enable_homepage_posts.

/**
 * Remove Jetpack custom added actions
 */
function foodie_world_remove_actions() {
	remove_filter( 'template_include', array( 'Nova_Restaurant', 'setup_menu_item_loop_markup__in_filter' ) );
}
//add_action( 'after_setup_theme', 'foodie_world_remove_actions' );

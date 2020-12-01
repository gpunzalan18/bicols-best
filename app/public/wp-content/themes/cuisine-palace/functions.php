<?php
/**
 * Theme functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
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
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function cuisine_palace_body_classes( $classes ) {

	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

	$user_agent = ! empty( $_SERVER['HTTP_USER_AGENT'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) ) : '';

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	/**
	 * Check browser type.
	 */
	if ( $is_lynx ) {
		$classes[] = 'lynx';
	} elseif ( $is_gecko ) {
		$classes[] = 'gecko';
	} elseif ( $is_opera ) {
		$classes[] = 'opera';
	} elseif ( $is_NS4 ) {
		$classes[] = 'ns4';
	} elseif ( $is_safari ) {
		$classes[] = 'safari';
	} elseif ( $is_chrome ) {
		$classes[] = 'chrome';
	} elseif ( $is_IE ) {
		$classes[] = 'ie';
	} else {
		$classes[] = 'unknown-browser';
	}

	/**
	 * Check platform or os type.
	 */
	if ( $is_iphone ) {
		$classes[] = 'iphone';
	}
	if ( stristr( $user_agent, 'mac' ) ) {
		$classes[] = 'mac';
	} elseif ( stristr( $user_agent, 'linux' ) ) {
		$classes[] = 'linux';
	} elseif ( stristr( $user_agent, 'windows' ) ) {
		$classes[] = 'windows';
	}

	return $classes;
}
add_filter( 'body_class', 'cuisine_palace_body_classes' );


if ( ! function_exists( 'cuisine_palace_get_main_container_id' ) ) {

	/**
	 * Returns the string for the main container id
	 *
	 * For $reset_query @see https://developer.wordpress.org/themes/basics/conditional-tags/#in-the-themes-footer-php-file
	 *
	 * @param bool $reset_query Whether to reset or not the query.
	 * @param bool $echo Whether to echo or return string.
	 */
	function cuisine_palace_get_main_container_id( $reset_query = false, $echo = true ) {

		$type = '';

		/**
		 * Reset the query for footer
		 * as mentioned in wporg.
		 *
		 * @see https://developer.wordpress.org/themes/basics/conditional-tags/#in-the-themes-footer-php-file
		 */
		if ( $reset_query ) {
			wp_reset_postdata();
		}

		$show_on_front = get_option( 'show_on_front' );
		if ( is_front_page() && 'page' === $show_on_front ) {
			$type = 'static-front-page';
		} elseif ( is_home() && 'posts' === $show_on_front ) {
			$type = 'blog-page home';
		} elseif ( is_home() && 'page' === $show_on_front ) {
			$type = 'blog-page page';
		} elseif ( is_archive() ) {
			$type = 'blog-page archive';
		} elseif ( is_page() ) {
			$type = 'single page';
		} elseif ( is_single() ) {
			$type = 'single post';
		} elseif ( is_search() ) {
			$type = 'search';
		} elseif ( is_404() ) {
			$type = 'page-not-found';
		}

		$wrapper_id = "main-container ${type}";

		if ( ! $echo ) {
			return $wrapper_id;
		}

		echo esc_attr( $wrapper_id );
	}
}

if ( ! function_exists( 'cuisine_palace_menu_fallback' ) ) {

	/**
	 * If no navigation menu is assigned, this function will be used for the fallback.
	 *
	 * @see https://developer.wordpress.org/reference/functions/wp_nav_menu/ for available $args arguments.
	 * @param  mixed $args Menu arguments.
	 * @return string $output Return or echo the add menu link.
	 */
	function cuisine_palace_menu_fallback( $args ) {
		if ( ! current_user_can( 'edit_theme_options' ) ) {
			return;
		}

		$link  = $args['link_before'];
		$link .= '<a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '" title="' . esc_attr__( 'Opens in new tab', 'cuisine-palace' ) . '" target="__blank">' . $args['before'] . esc_html__( 'Add a menu', 'cuisine-palace' ) . $args['after'] . '</a>';
		$link .= $args['link_after'];

		if ( false !== stripos( $args['items_wrap'], '<ul' ) || false !== stripos( $args['items_wrap'], '<ol' ) ) {
			$link = "<li class='menu-item'>{$link}</li>";
		}

		$output = sprintf( $args['items_wrap'], $args['menu_id'], $args['menu_class'], $link );

		if ( ! empty( $args['container'] ) ) {
			$output = sprintf( '<%1$s class="%2$s" id="%3$s">%4$s</%1$s>', $args['container'], $args['container_class'], $args['container_id'], $output );
		}

		if ( $args['echo'] ) {
			echo wp_kses_post( $output );
		}

		return $output;

	}
}


if ( ! function_exists( 'cuisine_palace_add_submenu_toggle_button' ) ) {

	/**
	 * Add a Sub Nav Toggle to the Expanded Menu and Mobile Menu.
	 *
	 * @param stdClass $args An array of arguments.
	 * @param WP_POST  $item Menu item.
	 * @param int      $depth Depth of the current menu item.
	 *
	 * @return stdClass $args An object of wp_nav_menu() arguments.
	 */
	function cuisine_palace_add_submenu_toggle_button( $args, $item, $depth ) {

		$theme_location = ! empty( $args->theme_location ) ? $args->theme_location : false;

		if ( ! $theme_location ) {
			return $args;
		}

		$toggle_button = '<button class="btn_submenu_dropdown"><span><i class="drop-down-icon"></i></span></button>';
		$item_classes  = ! empty( $item->classes ) ? $item->classes : array();

		if ( 'primary-menu' === $theme_location ) {
			// Add sub menu icons to the primary menu without toggles.
			if ( in_array( 'menu-item-has-children', $item_classes, true ) ) {
				$args->after = $toggle_button;
			} else {
				$args->after = '';
			}
		}

		return $args;
	}
	add_filter( 'nav_menu_item_args', 'cuisine_palace_add_submenu_toggle_button', 12, 3 );

}


if ( ! function_exists( 'cuisine_palace_is_footer_widgets_enabled' ) ) {

	/**
	 * Checks if footer widgets area can be displayed or not.
	 *
	 * @param array $footer_widgets Array of footer widget ids.
	 */
	function cuisine_palace_is_footer_widgets_enabled( $footer_widgets = array() ) {

		$enable = false;

		if ( ! cuisine_palace_get_theme_mod( 'cuisine_palace_theme_options', 'cuisine_palace_theme_options_footer', 'enable_footer_widgets' ) ) {
			return $enable;
		}

		if ( is_array( $footer_widgets ) && count( $footer_widgets ) > 0 ) {
			foreach ( $footer_widgets as $footer_widget ) {
				if ( is_active_sidebar( $footer_widget ) ) {
					$enable = true;
				}
			}
		}

		return $enable;
	}
}

if ( ! function_exists( 'cuisine_palace_get_social_links' ) ) {

	/**
	 * Returns the array of social links.
	 */
	function cuisine_palace_get_social_links() {

		$social_links = array(
			'facebook',
			'twitter',
			'youtube',
			'instagram',
		);

		return apply_filters( 'cuisine_palace_social_links', $social_links );
	}
}

if ( ! function_exists( 'cuisine_palace_get_layout' ) ) {

	/**
	 * Returns layout type according to the current page type.
	 */
	function cuisine_palace_get_layout( $echo = false ) {

		$cuisine_palace_panel_id   = 'cuisine_palace_theme_options';
		$cuisine_palace_section_id = 'cuisine_palace_theme_options_layouts';

		$singular_layout            = is_single() ? 'post_layout' : 'page_layout';
		$cuisine_palace_layout_type = is_singular() ? $singular_layout : 'archive_layout';
		$cuisine_palace_layout      = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, $cuisine_palace_layout_type );

		if ( ! is_active_sidebar( 'cuisine_palace_sidebar' ) ) {
			$cuisine_palace_layout = 'has-no-sidebar';
		}

		$layout = apply_filters( 'cuisine_palace_filter_layout_type', $cuisine_palace_layout, $cuisine_palace_layout_type );

		if ( ! $echo ) {
			return $layout;
		}

		echo esc_attr( $layout );

	}
}

if ( ! function_exists( 'cuisine_palace_filter_the_date' ) ) {

	/**
	 * Filters the date function for queries.
	 *
	 * @param string $the_date The formatted date string.
	 * @param string $format   PHP date format. Defaults to 'date_format' option
	 *                         if not specified.
	 * @param string $before   HTML output before the date.
	 * @param string $after    HTML output after the date.
	 */
	function cuisine_palace_filter_the_date( $the_date, $format, $before, $after ) {

		if ( is_single() ) {
			return $the_date;
		}

		$the_date = $before . get_the_date( $format ) . $after;
		return $the_date;

	}
	add_filter( 'the_date', 'cuisine_palace_filter_the_date', 12, 4 );
}


/**
 * Filter the excerpt length to 50 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function cuisine_palace_excerpt_length( $length ) {
	if ( is_admin() || ! is_front_page() ) {
		return $length;
	}

	return 20;
}
add_filter( 'excerpt_length', 'cuisine_palace_excerpt_length', 999 );


if ( ! function_exists( 'cuisine_palace_excerpt_more' ) ) {

	/**
	 * Returns the non bracket notation for the excerpt more.
	 *
	 * @param string $more Excerpt more notation.
	 */
	function cuisine_palace_excerpt_more( $more ) {
		if ( is_admin() ) {
			return $more;
		}

		return esc_html( '...' );
	}
	add_filter( 'excerpt_more', 'cuisine_palace_excerpt_more' );
}


if ( ! function_exists( 'cuisine_palace_set_sticky_header_script' ) ) {

	/**
	 * If user selects sticky header from customizer > theme options > header
	 * we will hook the required js for sticky header.
	 */
	function cuisine_palace_set_sticky_header_script() {

		if ( 'sticky' === cuisine_palace_get_theme_mod( 'cuisine_palace_theme_options', 'cuisine_palace_theme_options_site_header', 'header_behavior' ) ) {
			?>
			<script>
				jQuery(function($){
					$(window).on('scroll', function () {
						if ($(window).scrollTop() >= 50) {
						$('.header-content').addClass('is-sticky-header');
						} else {
						$('.header-content').removeClass('is-sticky-header', 1000, "easeInBack");
						}
					});
				});
			</script>
			<?php
		}
	}
	add_action( 'wp_footer', 'cuisine_palace_set_sticky_header_script' );
}


/**
 * Includes.
 */
require_once get_template_directory() . '/inc/includes.php';

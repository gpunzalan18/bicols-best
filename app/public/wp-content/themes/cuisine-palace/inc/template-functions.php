<?php
/**
 * This file contains the necessary hooks and functions for pages and posts.
 *
 * @package cuisine-palace
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! function_exists( 'cuisine_palace_top_bar' ) ) {

	/**
	 * Hooks the template file for top bar before header content wrapper.
	 *
	 * @see template-parts/header/top-bar.php
	 */
	function cuisine_palace_top_bar() {
		get_template_part( 'template-parts/header/top-bar' );
	}
	add_action( 'cuisine_palace_before_header_content_wrapper', 'cuisine_palace_top_bar', 15 );
}

if ( ! function_exists( 'cuisine_palace_header_search_form' ) ) {

	/**
	 * Hooks the html for header search form.
	 */
	function cuisine_palace_header_search_form() {

		$search_icon_visibility = cuisine_palace_get_theme_mod( 'cuisine_palace_theme_options', 'cuisine_palace_theme_options_site_header', 'search_icon_visibility' );

		if ( ! $search_icon_visibility || 'none' === $search_icon_visibility ) {
			return;
		}
		?>
		<div class="nav-account-section right-content-item <?php echo esc_attr( $search_icon_visibility ); ?>">
			<div class="nav-account-section-wrapper">
				<div class="search-container-wrapper">
					<button class="search-toggle">
						<span></span>
					</button>

					<div class="search-container">
						<?php get_search_form(); ?>
					</div>
				</div><!-- .search-container-wrapper -->
			</div><!-- .nav-account-section-wrapper -->
		</div><!-- .nav-account-section -->
		<?php
	}
	add_action( 'cuisine_palace_before_header_nav', 'cuisine_palace_header_search_form', 15 );
	add_action( 'cuisine_palace_after_header_nav', 'cuisine_palace_header_search_form', 15 );
}


if ( ! function_exists( 'cuisine_palace_page_banner' ) ) {

	/**
	 * The banner for pages other then the static frontpage starts.
	 * This code render or displays the page title banner and breadcrumbs
	 * if the current page is not the static frontpage.
	 *
	 * @see cuisine_palace_get_main_container_id();
	 */
	function cuisine_palace_page_banner() {

		$current_page_type   = cuisine_palace_get_main_container_id( false, false );
		$disable_page_banner = strpos( $current_page_type, 'static-front-page' );

		if ( $disable_page_banner ) {
			return;
		}

		$banner_thumbnail = is_singular() && has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'full' ) : get_header_image();

		$cuisine_palace_post_cat_ids = wp_get_post_categories( get_the_ID() );
		$cuisine_palace_post_cat_id  = ! empty( $cuisine_palace_post_cat_ids[0] ) ? $cuisine_palace_post_cat_ids[0] : false;
		$cuisine_palace_category     = get_category( $cuisine_palace_post_cat_id );
		$cuisine_palace_cat_name     = ! empty( $cuisine_palace_category->name ) ? $cuisine_palace_category->name : '';
		?>
			<!-- Page title banner starts -->
			<main id="banner" class="banner-container">
				<div class="wrapper">

					<div class="content image-container" style="background-image:url('<?php echo esc_url( $banner_thumbnail ); ?>');">

						<figcaption class="banner-overlay-content">
							<div class="container">
								<div class="content">

									<?php if ( $cuisine_palace_post_cat_id && is_singular() ) { ?>
										<div class="greeting ">
											<a title="<?php esc_attr_e( 'Category name', 'cuisine-palace' ); ?>" href="<?php echo esc_url( get_term_link( $cuisine_palace_post_cat_id ) ); ?>" class="sub-title">
												<?php echo esc_html( $cuisine_palace_cat_name ); ?>
											</a>
										</div>
									<?php } ?>

									<?php
										cuisine_palace_get_banner_title(
											'<div class="brand-title"><h1 class="title"><a>',
											'</a></h1></div>'
										);
									?>

								</div>
							</div>
						</figcaption>
					</div>
				</div>
				<?php cuisine_palace_get_breadcrumb(); ?>
			</main>
			<!-- Page title banner ends -->
		<?php
	}
	add_action( 'cuisine_palace_after_header_wrapper', 'cuisine_palace_page_banner', 15 );
}


if ( ! function_exists( 'cuisine_palace_single_meta_info' ) ) {

	/**
	 * Display the meta info for single posts.
	 *
	 * @see inc/template-tags.php for author and date functions.
	 */
	function cuisine_palace_single_meta_info() {

		/**
		 * Bail if we are not in single posts.
		 */
		if ( ! is_single() ) {
			return;
		}

		?>
		<!-- --------------post-meta info---------------------------- -->
		<article class="post-meta-info">
			<div class="meta-wrapper">
				<?php

				cuisine_palace_get_the_author();

				cuisine_palace_get_the_date();

				?>
			</div>
		</article>
		<!-- --------------post-meta info---------------------------- -->
		<?php
	}
	add_action( 'cuisine_palace_before_single_content', 'cuisine_palace_single_meta_info', 15 );
}


if ( ! function_exists( 'cuisine_palace_single_post_tags' ) ) {

	/**
	 * Prints the tags of a post.
	 */
	function cuisine_palace_single_post_tags() {
		$tags = get_the_tags();
		if ( ! $tags ) {
			return;
		}
		?>
			<!-- --------------post tag---------------------------- -->
			<article class="post-tag">
				<h2><?php esc_html_e( 'Tags', 'cuisine-palace' ); ?></h2>
				<ul class="tag-list">
					<?php
					if ( is_array( $tags ) && count( $tags ) > 0 ) {
						foreach ( $tags as $tag ) {
							$tag_name = $tag->name ? $tag->name : '';
							$tag_link = $tag->term_id ? get_term_link( $tag->term_id ) : '';
							?>
							<li class="tag-item">
								<a href="<?php echo esc_url( $tag_link ); ?>">
									<?php echo esc_html( $tag_name ); ?>
								</a>
							</li>
							<?php
						}
					}
					?>
				</ul>
			</article>
			<!-- ------------------------------------------------------ -->
		<?php
	}
	add_action( 'cuisine_palace_after_single_content', 'cuisine_palace_single_post_tags', 10 );
}



if ( ! function_exists( 'cuisine_palace_single_post_navigation' ) ) {

	/**
	 * Prints the post or page navigation html.
	 */
	function cuisine_palace_single_post_navigation() {

		if ( get_the_post_navigation() ) {
			?>
			<!-- --------------post-article---------------------------- -->
			<article class="detail-page-pagination">
				<?php the_post_navigation(); ?>
			</article>
			<!-- --------------post-article---------------------------- -->
			<?php
		}

	}
	add_action( 'cuisine_palace_after_single_content', 'cuisine_palace_single_post_navigation', 20 );
}



if ( ! function_exists( 'cuisine_palace_single_comment_template' ) ) {

	/**
	 * Prints the html and comment forms from comments.php
	 */
	function cuisine_palace_single_comment_template() {

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			echo '<article class="comment-form post-item ">';
			comments_template();
			echo '</article>';
		}
	}
	add_action( 'cuisine_palace_after_single_content', 'cuisine_palace_single_comment_template', 25 );
}


if ( ! function_exists( 'cuisine_palace_get_footer_widgets' ) ) {

	/**
	 * Prints the footer widget areas.
	 */
	function cuisine_palace_get_footer_widgets() {
		get_template_part( 'template-parts/footer/footer', 'widgets' );
	}
	add_action( 'cuisine_palace_before_footer_credits', 'cuisine_palace_get_footer_widgets' );
}

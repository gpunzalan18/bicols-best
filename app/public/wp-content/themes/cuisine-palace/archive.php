<?php
/**
 * The main template for display post archives.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cuisine-palace
 * @since 1.0.0
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


$cuisine_palace_panel_id       = 'cuisine_palace_theme_options';
$cuisine_palace_section_id     = 'cuisine_palace_theme_options_layouts';
$cuisine_palace_archive_layout = cuisine_palace_get_layout();
$cuisine_palace_archive_view   = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'archive_view' );


get_header();

?>
<div class="cuisine-post-wrapper">

	<div class="container">

		<!-- we have no sidebar(has-no-sidebar), left-sidebar(has-left-sidebar) and right-sidebar(has-right-sidebar) -->
		<div class="page-layout <?php echo esc_attr( $cuisine_palace_archive_layout ); ?>">

			<!-- -----------------primary content----------------------- -->
			<div id="primary" class="primary">

				<div id="content" class="primary-wrapper">

					<!-- we have grid-type( has-grid-type),list-type(has-list-type) -->
					<div class="post-layout <?php echo esc_attr( $cuisine_palace_archive_view ); ?>">
						<?php
						if ( have_posts() ) {
							while ( have_posts() ) {
								the_post();
								get_template_part( 'template-parts/content' );
							}
						}
						?>
					</div><!-- .post-layout -->

					<!-- ---------------------pagination--------------------------- -->
					<?php the_posts_pagination(); ?>
					<!-- ---------------------pagination--------------------------- -->

				</div>

			</div><!-- #primary -->
			<!-- -------------------------------------------------------- -->
			<?php get_sidebar(); ?>

		</div>

	</div>

</div>

<?php
get_footer();

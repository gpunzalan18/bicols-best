<?php
/**
 * The template for displaying single posts and pages.
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

$cuisine_palace_layout = cuisine_palace_get_layout();

get_header();

?>
<div class="cuisine-post-wrapper">

	<div class="container">

		<div class="page-layout <?php echo esc_attr( $cuisine_palace_layout ); ?>">

			<!-- -----------------primary content----------------------- -->
			<div id="primary" class="primary">

				<div class="primary-wrapper">

					<?php
					if ( have_posts() ) {
						while ( have_posts() ) {
							the_post();
							get_template_part( 'template-parts/content', 'singular' );
						}
					}
					?>

				</div>

			</div>
			<!-- -----------------primary content----------------------- -->

			<?php get_sidebar(); ?>
		</div>

	</div>

</div>
<?php
get_footer();

<?php
/**
 * Template part file for the frontpage who we are section.
 *
 * @package cuisine-palace
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cuisine_palace_panel_id   = 'cuisine_palace_frontpage';
$cuisine_palace_section_id = 'cuisine_palace_frontpage_who_we_are';

$enable_section = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_section' );

if ( ! $enable_section ) {
	return;
}

$heading     = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'heading' );
$sub_heading = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'sub_heading' );
$content     = (int) cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'content' );

$args = array(
	'p'                   => $content,
	'post_type'           => get_post_type( $content ),
	'post_status'         => 'publish',
	'posts_per_page'      => 1,
	'ignore_sticky_posts' => 1,
);

$the_query = new WP_Query( $args );
?>

<!-- --------------------about us/who we are--------------------------------------- -->
<section class="who-we-are section">
	<div class="wrapper">

		<?php
		cuisine_palace_frontpage_section_header( $heading, $sub_heading );

		if ( ! empty( $content ) ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				?>
				<div class="section-content">
					<div class="container">
						<div class="who-we-are-detail">
							<?php the_content(); ?>
							<div class="button">
								<a href="<?php the_permalink(); ?>" class="btn-secondary btn-large btn-prop"><?php esc_html_e( 'More Info', 'cuisine-palace' ); ?></a>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
		}
		?>

	</div>
</section>
<!-- ------------------------------------------------------------------------------- -->
<?php
wp_reset_postdata();

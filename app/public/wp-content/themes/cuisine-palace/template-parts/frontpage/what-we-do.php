<?php
/**
 * Template part file for the frontpage what we do section.
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
$cuisine_palace_section_id = 'cuisine_palace_frontpage_what_we_do';


$enable_section = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_section' );

if ( ! $enable_section ) {
	return;
}

$heading          = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'heading' );
$sub_heading      = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'sub_heading' );
$services         = (array) cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'services' );
$background_image = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'background_image' );


$args = array(
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'posts_per_page'      => 6,
	'ignore_sticky_posts' => 1,
	'post__in'            => $services,
);

$the_query = new WP_Query( $args );

?>

<!-- --------------------services--------------------------------------- -->
<section class="services section" style="background-image: url(<?php echo esc_url( $background_image ); ?>);">
	<div class="wrapper">

		<?php if ( $heading || $sub_heading ) { ?>
			<div class="section-header">
				<div class="container">
					<div class="section-header-content">

						<?php if ( $heading ) { ?>
							<p class="sub-title"><?php echo esc_html( $heading ); ?></p>
						<?php } ?>

						<?php if ( $sub_heading ) { ?>
							<h2 class="title"><?php echo esc_html( $sub_heading ); ?></h2>
						<?php } ?>

					</div>
				</div>
			</div>
		<?php } ?>


		<?php
		if ( $the_query->have_posts() ) {
			?>
			<div class="section-content">
				<div class="container">
					<div class="services-detail">
						<div class="grid-box">
							<?php
							while ( $the_query->have_posts() ) {
								$the_query->the_post();

								get_template_part( 'template-parts/frontpage/loops/content', 'what-we-do' );
							}
							?>
						</div>

					</div>
				</div>
			</div>
			<?php
		}
		?>


	</div>
</section>
<!-- ------------------------------------------------------------------------>

<?php
wp_reset_postdata();

<?php
/**
 * Template part file for the frontpage book your table section.
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
$cuisine_palace_section_id = 'cuisine_palace_frontpage_book_your_table';


$enable_section = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_section' );

if ( ! $enable_section ) {
	return;
}

$heading     = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'heading' );
$sub_heading = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'sub_heading' );
$content     = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'content' );


$args = array(
	'post_type'           => get_post_type( $content ),
	'post_status'         => 'publish',
	'posts_per_page'      => 1,
	'ignore_sticky_posts' => 1,
	'p'                   => $content,
);

$the_query = new WP_Query( $args );

?>
<!-------------------------- Reservation  ------------------------------------>
<section class="reservation section">
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



		<div class="section-content">
			<div class="container">
				<div class="reservation-detail">
					<?php
					while ( $the_query->have_posts() ) {
						$the_query->the_post();

						the_content();
					}
					?>
				</div>
			</div>
		</div>

	</div>
</section>
<!-- ------------------------------------------------------------------------>
<?php
wp_reset_postdata();


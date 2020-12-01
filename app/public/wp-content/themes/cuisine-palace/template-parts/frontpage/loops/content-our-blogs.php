<?php
/**
 * Loop file for blogs section.
 *
 * @package cuisine-palace
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>


<div>
	<div class="slider-content">
		<div class="content">
			<div class="img-container">
				<?php the_post_thumbnail( 'full' ); ?>
			</div>
			<figcaption class="short-blog-detail">

				<?php the_title( '<h3 class="blog-title"', '</h3>' ); ?>

				<p class=" more-info"> <?php esc_html_e( 'More Info', 'cuisine-palace' ); ?>
					<span class=" double-arrow">
						<i class="fas fa-chevron-right"></i>
						<i class="fas fa-chevron-right"></i>
					</span>
				</p>

			</figcaption>
		</div>

		<div class="slider-overlay-content">
			<div class="content">

				<?php
				the_date(
					'',
					'<div class="date-time"><p class="text"><i class="fas fa-calendar-alt"></i> ',
					'</p></div>'
				);

				the_title(
					'<div class="blog-title-wrapper"><h3 class="blog-title"><a href="' . esc_url( get_the_permalink() ) . '">',
					'</a></h3></div>'
				);

				if ( get_the_excerpt() ) {
					?>
					<div class="post-detail">
						<?php the_excerpt(); ?>
					</div>
					<?php
				}
				?>

				<div class="button">
					<a href="<?php the_permalink(); ?>" class="btn-primary btn-large btn-prop own-prop"> <?php esc_html_e( 'Read More', 'cuisine-palace' ); ?> <i class="fa fa-angle-right"></i></a>
				</div>

			</div>
		</div>

	</div>
</div>

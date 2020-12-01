<?php
/**
 * Content file for the banner slider template part file.
 *
 * @package cuisine-palace
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


$cuisine_palace_post_cat_ids = wp_get_post_categories( get_the_ID() );
$cuisine_palace_post_cat_id  = ! empty( $cuisine_palace_post_cat_ids[0] ) ? $cuisine_palace_post_cat_ids[0] : false;
$cuisine_palace_category     = get_category( $cuisine_palace_post_cat_id );
$cuisine_palace_cat_name     = ! empty( $cuisine_palace_category->name ) ? $cuisine_palace_category->name : '';

?>
<div class="slider-container image-container"  style="background-image:url('<?php the_post_thumbnail_url(); ?>');">
	<figcaption class="banner-overlay-content">
		<div class="container">
			<div class="content">
				<?php
				if ( $cuisine_palace_cat_name ) {
					?>
					<div class="greeting ">
						<p class="sub-title"><?php echo esc_html( $cuisine_palace_cat_name ); ?></p>
					</div>
					<?php
				}
				the_title(
					'<div class="brand-title"><h1 class="title"> <a href="' . esc_url( get_the_permalink() ) . '">',
					'</a> </h1></div>'
				);
				?>
			</div>
		</div>
	</figcaption>
</div>

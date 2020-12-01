<?php
/**
 * Content file for archives and blogs.
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
<!-- --------------post-article---------------------------- -->
<article id="blog-post-<?php the_ID(); ?>" <?php post_class( 'cuisine-blog-post item' ); ?>>

	<div class="post-inner-wraper">

		<?php
		if ( has_post_thumbnail() ) {
			?>
			<!-- --------post-thumbs--------- -->
			<div class="post-thumbs">

				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail(); ?>
				</a>

			</div>
			<!-- --------post-thumbs--------- -->
			<?php
		}
		?>

		<div class="entry-content-wrapper">

			<header class="entry-header">

				<?php
				the_title(
					'<h2 class="entry-title"><a href="' . get_the_permalink() . '">',
					'</a></h2>'
				);
				?>

			</header>

			<!-- .entry-header -->
			<div class="meta-wrapper">

				<?php if ( $cuisine_palace_post_cat_id ) { ?>

					<div class="entry-meta">
						<span class="cat-item">
							<a href="<?php echo esc_url( get_term_link( $cuisine_palace_post_cat_id ) ); ?>" rel="category tag"><?php echo esc_html( $cuisine_palace_cat_name ); ?></a>
						</span>
					</div>

				<?php } ?>

				<?php cuisine_palace_get_the_date(); ?>

			</div>

			<div class="entry-content">

				<?php the_excerpt(); ?>

				<a href="<?php the_permalink(); ?>" class="btn-secondary btn-large btn-prop">
					<?php esc_html_e( 'Read More', 'cuisine-palace' ); ?>
				</a>

			</div><!-- .entry-content -->

		</div><!-- .entry-content-wrapper -->

		<div class="footer-item">

			<?php cuisine_palace_get_the_author(); ?>

			<div class="icon">

				<?php if ( have_comments() || comments_open() ) { ?>
					<span class="comment-links">
						<a href="<?php comments_link_feed(); ?>">
							<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/comment.png" alt="comment">
							<?php echo esc_html( get_comments_number() ); ?>
						</a>
					</span>
				<?php } ?>

			</div>

		</div>
	</div>

</article>
<!-- -------------------------------------------------------- -->

<?php
/**
 * Template part for displaying Recent Posts in the front page template
 *
 * @package Foodie_World
 */
?>
<div class="recent-blog-content-wrapper section">
	<div class="wrapper">
		<div class="recent-blog-container">
			<?php
			$post_title = get_theme_mod( 'foodie_world_recent_posts_heading', esc_html__( 'Recent Posts', 'foodie-world' ) );

			if ( '' !== $post_title ) :
			?>
				<div class="section-heading-wrap">
					<div class="section-title-wrapper">
						<h2 class="section-title"><?php echo esc_html( $post_title ); ?></h2>
					</div> <!-- .section-title-wrapper -->
				</div><!-- .section-heading-wrap -->
			<?php
			endif;
			?>
			<div class="section-content-wrap">
				<div id="masonry-wrapper">
					<?php
					$recent_posts = new WP_Query( array(
						'ignore_sticky_posts' => true,
					) );

					/* Start the Loop */
					while ( $recent_posts->have_posts() ) :
						$recent_posts->the_post();
						?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="hentry-inner">
								<?php if ( is_sticky() ) { ?>
									<span class="sticky-label"><?php esc_html_e( 'Featured', 'foodie-world' ); ?></span>
								<?php } ?>

								<div class="post-thumbnail">
									<?php
									if ( has_post_thumbnail() ) {
										the_post_thumbnail();
									} else {
										echo '<img src="' . trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/images/no-thumb-480x400.jpg"/>';
									}
									?>
								</div>

								<div class="entry-container">
									<header class="entry-header">
										<div class="entry-category">
							<?php foodie_world_entry_category(); ?>
						</div><!-- .entry_category -->
										<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

										<div class="entry-meta">
											<?php foodie_world_posted_on(); ?>
										</div><!-- .entry-meta -->
									</header><!-- .entry-header -->

									<div class="entry-content">
										<p><span class="more-button"><a class="more-link" href="<?php the_permalink(); ?>"><?php echo wp_kses_data( get_theme_mod( 'foodie_world_excerpt_more_text',  esc_html__( 'Continue reading', 'foodie-world' ) ) ); ?></a></span></p>
									</div><!-- .entry-content -->
								</div> <!-- .entry-container -->
							</div>
							</article><!-- #post -->
						<?php
					endwhile;

					wp_reset_postdata();
					?>
				</div> <!-- masonry-wrapper -->
			</div><!-- .section-content-wrap -->
			<p><span class="more-button more-recent-posts"><a class="more-link" href="<?php the_permalink( get_option( 'page_for_posts' ) ); ?>"><?php esc_html_e( 'More Posts', 'foodie-world' ); ?></a><span></p>
		</div> <!-- .section -->
	</div> <!-- .wrapper -->
</div> <!-- .recent-blog-content-wrapper -->

<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Foodie_World
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('grid-item'); ?>>

	<div class="hentry-inner">

		<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php the_post_thumbnail(); ?>
			</a>
		</div>
		<?php endif; ?>

		<div class="entry-container">
			<?php if ( is_sticky() ) { ?>
			<span class="sticky-label"><?php esc_html_e( 'Featured', 'foodie-world' ); ?></span>
			<?php } ?>

			<header class="entry-header">
				<?php if ( 'post' === get_post_type() ) : ?>
					<div class="entry-category">
						<?php foodie_world_entry_category(); ?>
					</div><!-- .entry_category -->
				<?php endif; ?>

					<?php
					if ( is_singular() ) :
						the_title( '<h1 class="entry-title">', '</h1>' );
					else :
						the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					endif; ?>

				<?php if ( 'post' === get_post_type() ) : ?>
					<div class="entry-meta">
						<?php foodie_world_posted_on(); ?>
					</div><!-- .entry-meta -->
				<?php endif; ?>
			</header><!-- .entry-header -->


			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-content -->

		</div> <!-- .entry-container -->
	</div> <!-- .hentry-inner -->
</article><!-- #post-<?php the_ID(); ?> -->

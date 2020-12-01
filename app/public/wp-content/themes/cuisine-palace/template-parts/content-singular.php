<?php
/**
 * Content file that will be used inside loop.
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

	<div  <?php post_class( 'cuisine-detail-page' ); ?>>

		<?php

		/**
		 * Hook before the single main content loop starts.
		 *
		 * @see inc/template-functions.php
		 *
		 * @hooked cuisine_palace_single_meta_info() - 15
		 */
		do_action( 'cuisine_palace_before_single_content' );

		?>

			<!-- Post contents -->
			<article id="content" class="post-detail-article">

				<?php
					/**
					 * Display the post content.
					 */
					the_content();

					wp_link_pages();
				?>

			</article>
			<!-- Post contents -->

		<?php

		/**
		 * Hook after the single main content loop.
		 *
		 * @see inc/template-functions.php
		 *
		 * @hooked cuisine_palace_single_post_tags - 10
		 * @hooked cuisine_palace_single_post_navigation - 20
		 * @hooked cuisine_palace_single_comment_template - 25
		 */
		do_action( 'cuisine_palace_after_single_content' );

		?>

	</div>

<?php

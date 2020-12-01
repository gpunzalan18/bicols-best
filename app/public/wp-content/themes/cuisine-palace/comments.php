<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cuisine-palace
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	if ( have_comments() ) {

		the_comments_navigation();

		?>
		<h2><?php esc_html_e( 'Comments Lists', 'cuisine-palace' ); ?></h2>
		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
				)
			);
			?>
		</ol><!-- .comment-list -->
		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) {
			?>
			<p class="no-comments">
				<?php esc_html_e( 'Comments are closed.', 'cuisine-palace' ); ?>
			</p>
			<?php
		}
	} // Check for have_comments().

	comment_form(
		array(
			'comment_field' => sprintf(
				'<p class="comment-form-comment">%s</p>',
				'<textarea id="comment" placeholder="' . esc_attr__( 'Your comment here...', 'cuisine-palace' ) . '" name="comment" cols="45" rows="8" maxlength="65525" required="required"></textarea>'
			),
		)
	);
	?>
</div><!-- #comments -->

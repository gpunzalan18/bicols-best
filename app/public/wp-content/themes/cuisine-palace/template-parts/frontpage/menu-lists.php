<?php
/**
 * Template part file for the frontpage menu lists section.
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
$cuisine_palace_section_id = 'cuisine_palace_frontpage_menu_lists';

$enable_section = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_section' );

if ( ! $enable_section ) {
	return;
}

$heading         = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'heading' );
$sub_heading     = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'sub_heading' );
$menu_list_terms = (array) cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'terms' );


$tab_headings = array();

if ( is_array( $menu_list_terms ) && ! empty( $menu_list_terms ) ) {
	foreach ( $menu_list_terms as $menu_list_term ) {
		$all_terms = get_term_by( 'slug', $menu_list_term, 'category' );
		if ( is_wp_error( $all_terms ) ) {
			continue;
		}

		if ( isset( $all_terms->name ) && ! empty( $all_terms->name ) ) {
			$tab_headings[ $menu_list_term ] = $all_terms->name;
		}
	}
}

?>

<!-------------------------- menu  ------------------------------------------>
<section class="resturant-menu section">
	<div class="wrapper">
		<div class="container">

			<?php if ( $heading || $sub_heading ) { ?>
				<div class="section-header">
						<div class="section-header-content">

							<?php if ( $heading ) { ?>
								<p class="sub-title"><?php echo esc_html( $heading ); ?></p>
							<?php } ?>

							<?php if ( $sub_heading ) { ?>
								<h2 class="title"><?php echo esc_html( $sub_heading ); ?></h2>
							<?php } ?>

						</div>
				</div>
			<?php } ?>


			<section class="accordion-tabs js-tabs " data-tabs-allowed="true" data-breakpoint="400" data-start-collapsed="false">

				<?php
				if ( is_array( $tab_headings ) && ! empty( $tab_headings ) ) {
					$index = 1;
					?>
					<ul role="tablist" class="tabs-tab-list">
						<?php
						foreach ( $tab_headings as $tab_slug => $tab_heading ) {
							?>
							<li role="presentation">
								<a id="<?php echo esc_attr( "tab{$index}" ); ?>" href="#<?php echo esc_attr( $tab_slug ); ?>" role="tab" aria-controls="<?php echo esc_attr( $tab_slug ); ?>" aria-selected="true" class="tabs-trigger js-tabs-trigger">
									<?php echo esc_html( ucwords( $tab_heading ) ); ?>
								</a>
							</li>
							<?php
							$index++;
						}
						?>
					</ul>
					<?php
				}
				?>


				<?php
				if ( is_array( $tab_headings ) && ! empty( $tab_headings ) ) {
					$index = 1;
					foreach ( $tab_headings as $tab_slug => $tab_heading ) {

						?>
						<section id="<?php echo esc_attr( $tab_slug ); ?>" role="tabpanel" aria-labelledby="<?php echo esc_attr( "tab{$index}" ); ?>" class="tabs-panel js-tabs-panel  " tabindex="0">

							<!-- For mobile menu tab heading -->
							<div class="accordeon-trigger js-accordeon-trigger" aria-controls="<?php echo esc_attr( $tab_slug ); ?>" aria-expanded="true" tabindex="0">

								<label class="tab-heading-mobile">
									<?php echo esc_html( ucwords( $tab_heading ) ); ?>
								</label>

								<div class="accordeon-trigger-icon">
									<span class="label--open"><?php esc_html_e( 'Open', 'cuisine-palace' ); ?></span>
									<span class="label--close"><?php esc_html_e( 'Close', 'cuisine-palace' ); ?></span>

									<svg aria-hidden="true" focusable="false" viewBox="0 0 20 20">
										<rect class="vert" height="18" width="2" fill="currentColor" y="1" x="9"></rect>
										<rect height="2" width="18" fill="currentColor" y="9" x="1"></rect>
									</svg>
								</div>
							</div>


							<?php
							$args = array(
								'post_type'           => 'post',
								'post_status'         => 'publish',
								'ignore_sticky_posts' => 1,
								'tax_query'           => array(
									array(
										'taxonomy' => 'category',
										'field'    => 'slug',
										'terms'    => $tab_slug,
									),
								),
							);

							$the_query = new WP_Query( $args );

							if ( $the_query->have_posts() ) {
								?>
								<div class="content" aria-hidden="false">
									<div class="grid-box">
										<?php
										while ( $the_query->have_posts() ) {
											$the_query->the_post();
											?>
											<div class="grid-item">
												<div class="grid-item-wrapper">

													<?php the_title( '<h3 class="menu-item">', '</h3>' ); ?>

													<h4 class="menu-item-price"><?php the_content(); ?></h4>

												</div>
											</div>
											<?php
										}
										?>
									</div>
								</div>
								<?php
							}

							wp_reset_postdata();
							?>
						</section>
						<?php
						$index++;
					}
				}
				?>

			</section>
		</div>
	</div>

</section>
<!-- ------------------------------------------------------------------------>

<?php

<?php
/**
 * File for theme top bar.
 *
 * @package cuisine-palace
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cuisine_palace_panel_id   = 'cuisine_palace_theme_options';
$cuisine_palace_section_id = 'cuisine_palace_theme_options_top_bar';

$enable_top_bar = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_top_bar' );

if ( ! $enable_top_bar ) {
	return;
}

$contact_number = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'contact_number' );
$address        = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'address' );

$enable_social_links = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_social_links' );
$social_links        = cuisine_palace_get_social_links();

$enable_cta_btn = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_cta_btn' );
$btn_label      = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'btn_label' );
$link_type      = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'link_type' );
$cta_link       = 'post_or_page' === $link_type ? get_the_permalink( cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, $link_type ) ) : cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, $link_type );
?>

<!-- -----------------top bar--------------------- -->
<div class="header-top-bar">
	<div class="container">
		<div class="wrapper">
			<div class="header-top-content">

				<?php if ( $contact_number || $address ) { ?>
					<div class="header-top-left-content">
						<ul class="contact-information">

							<?php if ( $contact_number ) { ?>
								<li class="list">
									<span class="phone">
										<a href="<?php echo esc_url( "tel:{$contact_number}" ); ?>">
											<i class="fa fa-phone" aria-hidden="true"></i>
											<span><?php echo esc_html( $contact_number ); ?></span>
										</a>
									</span>
								</li>
							<?php } ?>

							<?php if ( $address ) { ?>
								<li class="list">
									<span class="address">
										<a href="#">
											<i class="fa fa-map-marker" aria-hidden="true"></i>
											<span><?php echo esc_html( $address ); ?></span>
										</a>
									</span>
								</li>
							<?php } ?>

						</ul>
					</div>
				<?php } ?>

				<?php if ( $enable_social_links && is_array( $social_links ) && count( $social_links ) > 0 ) { ?>
				<div class="header-top-right-content">
					<div class="social-navigation-wrapper">
						<div class="site-social">
							<nav class="social-navigation" role="navigation" aria-label="Social Links Menu">
								<div class="menu-social-container">
									<ul id="menu-social" class="menu">

										<?php
										foreach ( $social_links as $social_link ) {
											$user_social_link = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, $social_link );
											if ( ! empty( $user_social_link ) ) {
												?>
												<li class="menu-item" title="<?php echo esc_attr( ucfirst( $social_link ) ); ?>">
													<a href="<?php echo esc_url( $user_social_link ); ?>">
														<span class="screen-reader-text"><?php echo esc_html( ucfirst( $social_link ) ); ?></span>
													</a>
												</li>
												<?php
											}
										}
										?>

									</ul>
								</div>
							</nav>
						</div>
					</div>
				</div>
				<?php } ?>

				<?php if ( $enable_cta_btn ) { ?>
				<div class="top-header-button">
					<div class="button-area">
						<a href="<?php echo esc_url( $cta_link ); ?>" class="btn-primary btn-prop btn-small"><?php echo esc_html( $btn_label ); ?></a>
					</div>
				</div>
				<?php } ?>

			</div>
		</div>
	</div>
</div>
<!-- -----------------top bar--------------------- -->

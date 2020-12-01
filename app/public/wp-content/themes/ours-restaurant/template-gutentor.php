<?php
get_header();
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 * Template Name: AT: Gutentor Template
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ours_restaurant
 */


$ours_restaurant_hide_front_page_content = ours_restaurant_get_option('ours_restaurant_front_page_hide_option');

$ours_restaurant_slider_section_option = ours_restaurant_get_option('ours_restaurant_homepage_slider_option');
if ($ours_restaurant_slider_section_option != 'hide') {

    ?>
    <!-- Start Featured Slider -->
    <div class="features-slider">
        <div id="owl-demo1" class="owl-carousel owl-theme">


            <?php
            $all_slider = wp_kses_post(get_theme_mod('ours_restaurant_banner_all_sliders'));
            if (!empty($all_slider)) {
                $banner_slider = json_decode($all_slider);
                foreach ($banner_slider as $slider) {
                    $slider_page_id = $slider->selectpage;
                    if (!empty($slider_page_id)) {
                        $slider_page = new WP_Query('page_id=' . $slider_page_id);
                        if ($slider_page->have_posts()) {
                            $i=1;

                            while ($slider_page->have_posts()) {
                                $slider_page->the_post();


                                ?>


                                <div class="item">


                                    <?php if (has_post_thumbnail()) {
                                        $image_id = get_post_thumbnail_id();
                                        $image_url = wp_get_attachment_image_src($image_id, 'full', true); ?>
                                        <img src="<?php echo esc_url($image_url[0]); ?>" class="img-responsive"
                                             alt="<?php the_title_attribute(); ?>">
                                    <?php } ?>

                                    <div class="slider-content text-left" data-wow-duration="2s">
                                        <div class="container">
                                            <h3 class="banner-title"><?php the_title() ?></h3>
                                            <div class="banner-caption">
                                                <?php
                                                if (has_excerpt()) {
                                                    the_excerpt();
                                                } else {
                                                    ?>
                                                    <p> <?php echo esc_html(wp_trim_words(get_the_content(), 10)); ?></p>
                                                    <?php
                                                }
                                                ?></div>
                                            <div class="know-more">


                                                <?php
                                                if (!empty($slider->button_text)) { ?>
                                                    <a href="<?php echo esc_url($slider->button_url); ?>"
                                                       class="read-more-background"><span><?php echo esc_html($slider->button_text); ?>
                                                       </span> </a>
                                                <?php } ?>


                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <?php

                            }


                            wp_reset_postdata();
                        }
                    }
                }
            } ?>


        </div>
    </div>
    <?php


}
?>
<main id="main">

    <?php

    while ( have_posts() ) : the_post();?>

        <?php
        /**
         * Template part for displaying page content in page.php
         *
         * @link https://codex.wordpress.org/Template_Hierarchy
         *
         * @package Bussiness_agency
         */

        ?>




        <div class="entry-content">
            <?php
            the_content();
            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:','ours-restaurant' ),
                'after'  => '</div>',
            ) );
            ?>
        </div>






    <?php // If comments are open or we have at least one comment, load up the comment template.


    endwhile; // End of the loop.
    ?>

</main><!-- #main -->

<?php

get_footer();
?>
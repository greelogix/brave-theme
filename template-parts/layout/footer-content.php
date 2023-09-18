<?php

$logo = get_theme_mod('logo');
/**
 * Template part for displaying the footer content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package brave
 */

?>

<footer id="colophon" class="bg-white border-t">
    <div class="border-y">
        <div class="container" id="cta">
            <?php get_template_part('template-parts/content/call-to-action'); ?>
        </div>
    </div>
    <div class="container px-6 pb-8 pt-16 sm:pt-24 lg:px-8 lg:pt-32">

        <!-- 4 col Grid on md and above, 1 col below -->
        <div class="grid grid-cols-1 gap-8 md:grid-cols-4 justify-between items-center mb-12">
            <!-- first col has a logo, then social media  below it -->
            <div class="col-span-1">
                <div class="site-branding flex py-4" style="height: <?php echo $nav_height ? $nav_height : 90; ?>px;">
                    <a class="flex" href="<?php echo esc_url(home_url('/')); ?>">
                        <img src="<?php echo esc_url($logo); ?>'" alt="<?php echo get_bloginfo('name'); ?>" />
                    </a>
                </div>

                <div class="flex space-x-2">
                    <?php if (get_theme_mod('facebook_url')) : ?>
                        <a href="<?php echo get_theme_mod('facebook_url'); ?>" target="_blank" class="text-gray-600 hover:text-primary">
                            <i class="fab fa-facebook"></i>
                        </a>
                    <?php endif; ?>


                    <!-- Instagram -->
                    <?php if (get_theme_mod('instagram_url')) : ?>
                        <a href="<?php echo get_theme_mod('instagram_url'); ?>" target="_blank" class="text-gray-600 hover:text-primary">
                            <i class="fab fa-instagram"></i>
                        </a>

                    <?php endif; ?>

                    <!-- Youtube -->
                    <?php if (get_theme_mod('youtube_url')) : ?>
                        <a href="<?php echo get_theme_mod('youtube_url'); ?>" target="_blank" class="text-gray-600 hover:text-primary">
                            <i class="fab fa-youtube"></i>
                        </a>
                    <?php endif; ?>

                </div>
            </div>


            <!-- second col has a nav menu -->
            <div class="col-span-1 md:col-span-3">

                <?php if (has_nav_menu('footer-menu')) : ?>
                    <nav aria-label="<?php esc_attr_e('Footer Menu', 'brave'); ?>">
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'footer-menu',
                                'menu_class'     => 'footer-menu flex flex-wrap justify-center gap-x-8 text-sm font-medium text-gray-600 uppercase',
                                'depth'          => 1,
                            )
                        );
                        ?>
                    </nav>
                <?php endif; ?>
            </div>

        </div>

        <div class="container text-center mb-4">
            <p class="text-sm"><a href="https://braveforgyms.com" target="_blank" class="text-primary">Martial Arts Website Design by Brave For Gyms</a></p>
        </div>
</footer><!-- #colophon -->
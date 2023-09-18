<?php

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

    <div class="container text-center mb-4">
        Made With Love by <a href="https://brave.io" target="_blank" class="text-primary">brave</a>
    </div>
</footer><!-- #colophon -->
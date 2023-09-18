<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default. Please note that
 * this is the WordPress construct of pages: specifically, posts with a post
 * type of `page`.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package brave
 */

$use_header_image = get_theme_mod('use_bg_image', false);
get_header();
?>
<section id="primary">
    <main id="main" class="prose">
        <?php if ($use_header_image) : ?>
            <?php echo get_template_part('template-parts/content/header-with-image'); ?>
        <?php endif; ?>
        <div class="container">
            <?php

            /* Start the Loop */
            while (have_posts()) :
                the_post();

                get_template_part('template-parts/content/content', 'page', [
                    'use_header_image' => $use_header_image,
                ]);

            endwhile; // End of the loop.
            ?>

        </div>


        <?php
        // only on the contact page
        $page = get_post();
        $location = get_field('google_map_location');
        if ($page->post_name == 'contact' || $page->post_name == 'contact-us' && $location) : ?>
            <div class="acf-map" data-zoom="16" style="margin-bottom:0;">
                <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
            </div>
        <?php endif; ?>
    </main><!-- #main -->
</section><!-- #primary -->
<?php
get_footer();

<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no `home.php` file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package brave
 */
$use_header_image = get_theme_mod('use_bg_image');
get_header();
?>

<section id="primary">
    <main id="main">
        <?php if ($use_header_image) {
            get_template_part('template-parts/content/header-with-image', null, [
                'is_blog_page' => true,
            ]);
        }; ?>
        <div class="container">
            <?php if (!$use_header_image) : ?>
                <header>
                    <h1 class="entry-title"><?php single_post_title(); ?></h1>
                </header><!-- .entry-header -->
            <?php endif; ?>
            <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">

                <?php

                // Load posts loop.
                while (have_posts()) {
                    the_post();
                    get_template_part('template-parts/content/content');
                }

                // Previous/next page navigation.
                brave_the_posts_navigation();

                ?>
            </div>
        </div><!-- .container -->
    </main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();

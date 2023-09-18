<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package brave
 */

get_header();
?>

<section id="primary">
    <main id="main">
        <div class="container">

            <?php if (have_posts()) : ?>

                <header class="page-header">
                    <?php the_archive_title('<h1 class="page-title">', '</h1>'); ?>
                </header><!-- .page-header -->

                <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">

                <?php
                // Start the Loop.
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/content/content', 'excerpt');
                // End the loop.
                endwhile;

                // Previous/next page navigation.
                brave_the_posts_navigation();

            else :

                // If no content, include the "No posts found" template.
                get_template_part('template-parts/content/content', 'none');

            endif;
                ?>
                </div>
        </div>
    </main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();

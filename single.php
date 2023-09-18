<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package brave
 */

$use_header_image = get_theme_mod('use_bg_image', false);
get_header();
?>
<section id="primary" class="prose">
    <main id="main">
        <?php if ($use_header_image) {
            get_template_part('template-parts/content/header-with-image');
        }; ?>
        <div class="container">
            <div class="bg-white">
                <div class="mx-auto max-w-3xl text-base leading-7 text-gray-700">

                    <?php
                    /* Start the Loop */
                    while (have_posts()) :
                        the_post();
                        get_template_part('template-parts/content/content', 'single');

                        if (is_singular('post')) {
                            // Previous/next post navigation.
                            the_post_navigation(
                                array(
                                    'next_text' => '<span aria-hidden="true">' . __('Next Post', 'brave') . '</span> ' .
                                        '<span class="sr-only">' . __('Next post:', 'brave') . '</span> <br/>' .
                                        '<span>%title</span>',
                                    'prev_text' => '<span aria-hidden="true">' . __('Previous Post', 'brave') . '</span> ' .
                                        '<span class="sr-only">' . __('Previous post:', 'brave') . '</span> <br/>' .
                                        '<span>%title</span>',
                                )
                            );
                        }

                        // If comments are open, or we have at least one comment, load
                        // the comment template.
                        if (comments_open() || get_comments_number()) {
                            comments_template();
                        }

                    // End the loop.
                    endwhile;
                    ?>

                </div>
            </div>
        </div><!-- .container -->
    </main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();

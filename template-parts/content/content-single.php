<?php

/**
 * Template part for displaying single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package brave
 */
$use_header_image = get_theme_mod('use_bg_image', false);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if (!$use_header_image) : ?>
        <header class="entry-header">
            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
        </header><!-- .entry-header -->
    <?php endif; ?>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div class="col-span-1">
            <?php
            the_content(
                sprintf(
                    wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers. */
                        __('Continue reading<span class="sr-only"> "%s"</span>', 'brave'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                )
            );

            wp_link_pages(
                array(
                    'before' => '<div>' . __('Pages:', 'brave'),
                    'after'  => '</div>',
                )
            );
            ?>

        </div>
        <div class="col-span-1">
            <?php brave_post_thumbnail(); ?>
        </div>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php brave_entry_footer(); ?>
    </footer><!-- .entry-footer -->

</article><!-- #post-${ID} -->
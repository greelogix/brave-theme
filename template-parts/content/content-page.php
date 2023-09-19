<?php

/**
 * Template part for displaying pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package brave
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if (!$args['use_header_image']) : ?>
        <header>
            <h1 class="entry-title">
                <?php the_title(); ?>
            </h1>
        </header><!-- .entry-header -->
    <?php endif; ?>

    <div <?php brave_content_class($args['use_header_image'] ? 'pt-16' : ''); ?>>
        <?php
        the_content();

        wp_link_pages(
            array(
                'before' => '<div>' . __('Pages:', 'brave'),
                'after'  => '</div>',
            )
        );
        ?>
    </div><!-- .entry-content -->

    <?php if (get_edit_post_link()) : ?>
        <footer class="entry-footer">
            <?php
            edit_post_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers. */
                        __('Edit <span class="sr-only">%s</span>', 'brave'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                )
            );
            ?>
        </footer><!-- .entry-footer -->
    <?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
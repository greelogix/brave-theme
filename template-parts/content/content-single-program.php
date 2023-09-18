<?php

/**
 * Template part for displaying single programs
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package brave
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if (!$args['use_header_image']) : ?>
        <header class="entry-header">
            <?php the_title('<h1 class="entry-title text-center mb-16">', '</h1>'); ?>
        </header><!-- .entry-header -->
    <?php endif; ?>

    <?php if (!$args['use_header_image']) : ?>
        <div class="max-w-3xl mx-auto">
            <?php brave_post_thumbnail(); ?>
        </div>
    <?php endif; ?>
    <div class="grid prose grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="col-span-1 sm:col-span-2">
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
            ); ?>
        </div>
        <div class="col-span-1">
            <?php
            $days_of_week = get_field('days_of_week');
            if ($days_of_week) {
                echo '<div class="mb-5"><h2 class="text-xl mb-3">Class Times</h2>';
                foreach ($days_of_week as $day) {
            ?>
                    <p class="">
                        <strong><?php echo $day['day_name']; ?>:</strong>
                        <?php echo $day['start_time']; ?> - <?php echo $day['end_time']; ?>
                    </p>

            <?php
                }
                echo '</div>';
            }
            ?>
        </div>
    </div>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php brave_entry_footer(); ?>
    </footer><!-- .entry-footer -->

</article><!-- #post-${ID} -->
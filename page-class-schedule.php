<?php

/**
 * The Class Schedule template file
 * Template Name: Class Schedule
 * @package brave
 */

// get theme setting align page title
$use_header_image = get_theme_mod('use_bg_image', false);
get_header();
?>
<main class="prose">
    <?php if ($use_header_image) : ?>
        <?php echo get_template_part('template-parts/content/header-with-image'); ?>
    <?php endif; ?>
    <div class="container">
        <?php if (!$use_header_image) : ?>
            <h1 class="entry-title">
                Class Schedule
            </h1>
        <?php endif; ?>

        <div class="mt-6 mb-10">

            <?php the_content(); ?>
        </div>

        <!-- loop through all post_types of program that are not parents -->
        <?php
        $args = array(
            'post_type' => 'program',
            'posts_per_page' => -1,
            // only posts that have the custom_field of days_of_week
            'meta_query' => array(
                array(
                    'key' => 'days_of_week',
                    'compare' => 'EXISTS'
                )
            ),
            'orderby' => 'menu_order',
            'order' => 'ASC'
        );
        $programs = get_posts($args);

        foreach ($programs as $program) {
            // get repeater field
            $days_of_week = get_field('days_of_week', $program->ID);
            if (!$days_of_week) continue;
            echo '<div class="space-y-2 mb-6"><h2 class="text-xl"><a class="text-primary" href="' . get_the_permalink($program->ID) . '">' . $program->post_title . '</a></h2>';
            foreach ($days_of_week as $day) {
        ?>
                <p class="">
                    <strong><?php echo $day['day_name']; ?>:</strong>
                    <?php echo $day['start_time']; ?> - <?php echo $day['end_time']; ?>
                </p>

            <?php
            }
            ?>


        <?php
            echo '</div>';
        }

        ?>

    </div>
</main>
<?php
get_footer();
?>
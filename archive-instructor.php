<?php

/**
 * The Instructors template file
 * Template Name: Instructors
 * @package brave
 */
get_header(); ?>

<main>
    <div class="container">
        <h1 class="text-4xl font-bold text-center">
            Instructors
        </h1>

        <?php echo get_template_part('template-parts/content/instructor-loop'); ?>
    </div>

</main>

<?php get_footer(); ?>
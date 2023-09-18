<?php
$use_header_image = get_theme_mod('use_bg_image', false);
get_header(); ?>

<main style="padding:0;">
    <?php if ($use_header_image) : ?>
        <?php echo get_template_part('template-parts/content/header-with-image'); ?>
    <?php endif; ?>
    <section class="py-16">
        <div class="container">

            <?php if (!$use_header_image) : ?>
                <h1 class="entry-title">
                    <?php the_title(); ?>
                </h1>
            <?php endif; ?>

            <div class="mt-10 prose">
                <?php the_content(); ?>
            </div>
        </div>
    </section>
    <section class="py-16 bg-gray-50">
        <div class="container">
            <h2 class="text-5xl font-bold text-center mb-3">
                Our Instructors
            </h2>
            <p class="text-center text-gray-500 mb-16">
                Our team has a combined 30 years of experience teaching Jiu Jitsu and self defense to students of all ages.
            </p>

            <?php echo get_template_part('template-parts/content/instructor-loop', null, [
                'num_instructors' => 3
            ]); ?>

            <div class="mt-16 text-center">
                <a href="/instructors" class="gs-button gs-button--primary">
                    View All Instructors
                </a>
            </div>
        </div>
    </section>

</main>


<?php get_footer(); ?>
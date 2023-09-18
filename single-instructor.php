<?php

/**
 * The template for displaying archive pages
 *
 */
get_header(); ?>
<main>
    <div class="container">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="col-span-1">
                <div class="flex">
                    <div class="relative flex items-center text-sm leading-6">
                        <?php echo get_field('position'); ?>
                    </div>
                </div>
                <h1 class="max-w-2xl mt-1 text-4xl font-bold  sm:text-6xl">
                    <?php echo get_the_title(); ?>
                </h1>
                <div class="mt-6 text-lg leading-8">
                    <?php echo get_the_content(); ?>
                </div>
            </div>
            <div class="col-span-1">
                <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo get_the_title(); ?>" class="w-full">
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>
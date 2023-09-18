<?php

/**
 * The Home Page template file
 *
 *  @package brave
 */

// get theme setting nav height
$transparent_nav = get_field('transparent_header');
$primary_color = get_theme_mod('primary_color', '#000000');
$nav_height = get_theme_mod('nav_height');
$hero_bg_id = get_field('hero_image');
$hero_bg = wp_get_attachment_image_src($hero_bg_id, 'full')[0];

$mission_image_id = get_field('mission_image');
$mission_image = wp_get_attachment_image_src($mission_image_id, 'full')[0];
get_header();
?>

<section class="pt-32 relative sm:pt-40 lg:flex lg:items-center lg:gap-x-10 lg:px-8 lg:pt-48 bg-cover" style="
    background-image: linear-gradient(120deg, rgba(0, 0, 0, 0.7) 25%, rgba(0, 0, 0, .4) 100%), url('<?php echo $hero_bg; ?>');
    padding-top: <?php echo $transparent_nav ? '18%' : ''; ?>;
">
    <div class="relative z-2 container">
        <div class="mx-auto max-w-2xl lg:mx-0 lg:flex-auto">
            <div class="text-sm leading-6 text-white">
                <?php echo get_field('hero_preheading'); ?>
            </div>

            <h1 class="mt-4 max-w-2xl text-4xl font-bold  text-white sm:text-6xl">
                <?php echo get_field('hero_heading'); ?>
            </h1>
            <p class="mt-6 text-lg leading-8 text-white">
                <?php echo get_field('hero_content'); ?>
            </p>
            <div class="mt-10 flex items-center gap-x-6">
                <a href="<?php echo get_field('hero_button_url'); ?>" class="gs-button gs-button--primary gs-button--lg">
                    <?php echo get_field('hero_button_text'); ?>
                </a>
                <?php if (get_field('home_secondary_button')) : ?>
                    <a href="<?php echo get_field('home_button_2_url'); ?>" class="gs-button gs-button--secondary border-0 gs-button--lg">
                        <?php echo get_field('home_button_2_text'); ?>
                        <span aria-hidden="true">→</span></a>
                <?php endif; ?>
            </div>
        </div>

        <div id="cta" class="-mt-20 mx-auto shadow-md border rounded-lg overflow-hidden translate-y-1/2">
            <?php get_template_part('template-parts/content/call-to-action'); ?>
        </div>
    </div>
</section>


<!-- OUR MISSION -->
<?php if (get_field('show_mission_section')) : ?>
    <section class="py-16 mt-48" id="why-us">
        <div class="container">
            <!-- 50/50 left right -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 items-center">
                <div class="col-span-1">
                    <div class="mt-24 sm:mt-32 lg:mt-16">
                        <div class="relative flex uppercase items-center text-sm leading-6">
                            <?php echo get_field('mission_preheading'); ?>
                        </div>
                    </div>
                    <h1 class="mt-4 text-4xl font-bold tracking-tight sm:text-6xl">
                        <?php echo get_field('mission_heading'); ?>
                    </h1>
                    <div class="mt-6 text-lg leading-8 text-gray-800">
                        <?php echo get_field('mission_content'); ?>
                    </div>
                    <div class="mt-10 flex items-center gap-x-6">
                        <a href="<?php echo get_field('mission_button_url'); ?>" class="gs-button gs-button--primary">
                            <?php echo get_field('mission_button_text'); ?>
                        </a>
                    </div>
                </div>
                <div class="col-span-1">
                    <img src="<?php echo $mission_image; ?>" alt="<?php echo get_field('mission_heading'); ?> Image" class="w-full h-full object-cover object-center rounded-lg shadow-lg">
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<!--OUR PROGRAMS-->
<section class="bg-gray-50 py-16" id="our-programs">
    <h2 class="mb-16 text-center text-4xl font-bold tracking-tight sm:text-6xl">
        Our Programs
    </h2>
    <div class="container">
        <?php get_template_part('template-parts/content/programs-we-offer'); ?>
    </div>
</section>



<!--WHY OUR GYM-->
<?php
get_footer();

<?php
$thumbnail_id = get_post_thumbnail_id();
$image_url = wp_get_attachment_image_src($thumbnail_id, 'large', true)[0];


/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package brave
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class("flex relative flex-col items-start"); ?>>
    <div class="relative w-full">
        <img src="<?php echo $image_url; ?>" alt="" class="aspect-[16/9] w-full rounded-2xl bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2]">
        <a class="absolute z-10 inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10" href="<?php echo get_permalink(); ?>"></a>

    </div>
    <div class="max-w-xl">
        <div class="mt-8 flex items-center gap-x-4 text-xs">
            <time datetime="2020-03-16" class="text-gray-500">
                <?php echo get_the_date(); ?>
            </time>
            <a href="#" class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">
                <?php echo get_the_category_list(','); ?>
            </a>
        </div>
        <div class="group relative">
            <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                <a href="<?php echo get_permalink(); ?>" class="relative z-10">
                    <span class="absolute inset-0"></span>

                    <?php
                    if (is_sticky() && is_home() && !is_paged()) {
                        printf('%s', esc_html_x('Featured', 'post', 'brave'));
                    }
                    the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');

                    ?>
                </a>
            </h3>
            <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">
                <?php the_excerpt(); ?>
            </p>
        </div>
        <div class="relative mt-8 flex items-center gap-x-4">
            <img src="<?php echo get_avatar_url(get_the_author_meta('ID')); ?>" alt="" class="h-10 w-10 rounded-full bg-gray-100">
            <div class="text-sm leading-6">
                <p class="font-semibold text-gray-900">
                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="relative z-10">
                        <span class="absolute inset-0"></span>
                        <?php the_author(); ?>
                    </a>
                </p>
            </div>
        </div>
    </div>
</article>
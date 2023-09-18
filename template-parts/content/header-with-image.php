<?php
$transparent_nav = get_theme_mod('transparent_nav', false);
$primary_color = get_theme_mod('primary_color', '#000');
// darken primary by 15%    
$header_bg_color_1 = brave_color_brightness($primary_color, 45, 1);
$header_bg_color_2 = brave_color_brightness($primary_color, 45, .75);
$header_bg_color_3 = brave_color_brightness($primary_color, 45, .20);
$featured_image = get_the_post_thumbnail_url();
$use_primary_gradient = get_theme_mod('use_primary_gradient', false);
$primary_bg_gradient = 'linear-gradient(0deg, ' . $header_bg_color_1 . ' 0%,' . $header_bg_color_2 . ' 40%,' . $header_bg_color_3 . ' 100%)';
$black_gradient = 'linear-gradient(0deg, rgba(0,0,0,0.66) 0%,rgba(0,0,0,0.45) 100%)';
$get_blog_page_id = null;
if (isset($args['is_blog_page'])) {
    $get_blog_page_id = get_option('page_for_posts');
    $featured_image = get_the_post_thumbnail_url($get_blog_page_id, 'full');
}
?>
<header class="relative bg-primary" style="
                background-image: <?php echo $use_primary_gradient ? $primary_bg_gradient : $black_gradient; ?>,url('<?php echo $featured_image; ?>');
                background-size: cover; background-position: center center;
                background-color: <?php echo $header_bg_color_2; ?>;
                padding: <?php echo $transparent_nav ? '18% 0 12% 0' : '10rem 0'; ?>;
                ">
    <div class="relative">
        <div class="container">
            <h1 class="entry-title text-white text-center" style="margin-bottom: 0">
                <?php echo get_the_title($get_blog_page_id ? $get_blog_page_id : null); ?>
            </h1>
        </div>
    </div>
</header>
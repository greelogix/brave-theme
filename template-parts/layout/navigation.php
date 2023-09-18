<?php

// get variables from theme options
$front_page_id = get_option('page_on_front');
$transparent_nav = is_front_page() ? get_field('transparent_header', $front_page_id) : get_theme_mod('transparent_nav', false);
$logo = get_theme_mod('logo');
$secondary_logo = get_theme_mod('secondary_logo');
$primary_color = get_theme_mod('primary_color', '#000000');

$hide_top_bar = get_theme_mod('hide_top_bar', false);
$top_bar_bg_color = get_theme_mod('top_bar_bg_color', '#000000');
$top_bar_text_color = get_theme_mod('top_bar_text_color', '#ffffff');

$phone_number = get_theme_mod('phone_number', '555-555-5555');
$cta_button_text = get_field('cta_button_text', 'option');

$nav_height = get_theme_mod('nav_height');
$nav_bg_color = get_theme_mod('nav_bg_color', '#ffffff');
$nav_text_color = get_theme_mod('nav_text_color', '#000000');
$nav_text_hover_color = get_theme_mod('nav_text_hover_color', '#000000');

/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package brave
 */

?>

<header id="masthead" class="<?php echo $transparent_nav ? 'absolute top inset-x-0 top-0' : ''; ?>">
    <?php if ($hide_top_bar == false) : ?>
        <div id="top-bar" class="relative z-10 <?php echo $transparent_nav ? '' : 'border-b' ?>" style="
                background-color: <?php $transparent_nav ? "transparent" : $top_bar_bg_color; ?>;
                color: <?php echo $top_bar_text_color; ?>
            ">
            <div class="container">
                <div class="relative flex h-16 items-center justify-between">
                    <!-- Phone Number -->
                    <div id="phone-number" style="color: <?php echo $transparent_nav ? '#fff' : 'inherit'; ?>">
                        <span class="font-medium">Call Now:</span>
                        <a href="tel:<?php echo $phone_number; ?>"><?php echo $phone_number; ?></a>
                    </div>

                    <!-- CTA Button -->
                    <div id="cta-button">
                        <a href="#cta" class="gs-button gs-button--primary"><?php echo $cta_button_text; ?></a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <nav id="site-navigation" class="relative z-10 <?php echo $transparent_nav ? 'absolute inset-x-0 top-0' : 'border-b' ?>" aria-label="<?php esc_attr_e('Main Navigation', 'brave'); ?>" style="
      background-color: <?php $transparent_nav ? "transparent" : $nav_bg_color; ?>;
        color: <?php echo $nav_text_color; ?>">
        <div class="container">
            <div class="relative flex items-center justify-between">
                <div class="site-branding flex py-4" style="height: <?php echo $nav_height; ?>px;">
                    <a class="flex" href="<?php echo esc_url(home_url('/')); ?>">
                        <img src="<?php echo $transparent_nav ? esc_url($secondary_logo) : esc_url($logo); ?>'" alt="<?php echo get_bloginfo('name'); ?>" />
                    </a>
                </div><!-- .site-branding -->

                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'menu-1',
                        'menu_id'        => 'primary-menu',
                        'items_wrap'     => '<ul id="%1$s" class="%2$s" aria-label="submenu">%3$s</ul>',
                    )
                );
                ?>
            </div>
        </div>
    </nav><!-- #site-navigation -->

</header><!-- #masthead -->
<?php

/**
 * The header for our theme
 *
 * This is the template that displays the `head` element and everything up
 * until the `#content` element.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package brave
 */
$front_page_id = get_option('page_on_front');
$transparent_nav = is_front_page() ? get_field('transparent_header', $front_page_id) : get_theme_mod('transparent_nav', false);
$use_header_image = get_theme_mod('use_bg_image', false);
$primary_color = get_theme_mod('primary_color', '#000000');
$button_text_color = get_theme_mod('button_text_color', '#ffffff');
$header_font = get_theme_mod('heading_font', 'Poppins');
$body_font = get_theme_mod('body_font', 'Poppins');

$css_classes = '';
$css_classes .= $transparent_nav ? 'fixed-nav ' : '';
$css_classes .= $use_header_image ? 'has-header-image ' : '';

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>

    <link rel="preconnect" href="https://fonts.gstatic.com">

    <?php
    if ($header_font !== $body_font) { ?>
        <style>
            @import url("https://fonts.googleapis.com/css2?family=<?php echo $body_font; ?>:wght@300;400;500;600;700&display=swap");
        </style>
    <?php
    } ?>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=<?php echo $header_font; ?>:wght@300;400;500;600;700&display=swap");

        body:not(h1, h2, h3, h4, h5, h6) {
            font-family: <?php echo $body_font; ?>, sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: <?php echo $header_font; ?>, sans-serif;
        }

        h1,
        h2 {

            color: <?php echo get_theme_mod('heading_color'); ?>;
        }


        .prose {
            --tw-prose-headings: <?php echo get_theme_mod('heading_color'); ?>;
            --tw-prose-text: <?php echo get_theme_mod('body_text_color'); ?>;
        }

        .text-primary,
        .hover:text-primary:hover,
        i {
            color: <?php echo $primary_color; ?>;
        }

        .gs-button--primary {
            background-color: <?php echo $primary_color; ?> !important;
            color: <?php echo $button_text_color; ?> !important;
        }

        .gs-button--secondary {
            border-color: <?php echo $primary_color; ?>;
            background-color: white;
            color: <?php echo $primary_color; ?>;
        }

        #primary-menu li a {
            font-size: <?php echo get_theme_mod('nav_font_size'); ?>px;
        }

        #primary-menu>li>a,
        #primary-menu>li::after {
            color: <?php echo $transparent_nav ? "#fff" : get_theme_mod('nav_text_color'); ?>;
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/solid.min.css" integrity="sha512-P9pgMgcSNlLb4Z2WAB2sH5KBKGnBfyJnq+bhcfLCFusrRc4XdXrhfDluBl/usq75NF5gTDIMcwI1GaG5gju+Mw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body <?php body_class($css_classes); ?>>

    <?php wp_body_open(); ?>

    <div id="page">
        <a href="#content" class="sr-only"><?php esc_html_e('Skip to content', 'brave'); ?></a>

        <?php get_template_part('template-parts/layout/navigation'); ?>

        <div id="content">
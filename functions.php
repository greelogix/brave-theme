<?php

/**
 * brave functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package brave
 */

if (!defined('brave_VERSION')) {
    /*
	 * Set the theme’s version number.
	 *
	 * This is used primarily for cache busting. If you use `npm run bundle`
	 * to create your production build, the value below will be replaced in the
	 * generated zip file with a timestamp, converted to base 36.
	 */
    define('brave_VERSION', '0.1.0');
}

if (!defined('brave_TYPOGRAPHY_CLASSES')) {
    /*
	 * Set Tailwind Typography classes for the front end, block editor and
	 * classic editor using the constant below.
	 *
	 * For the front end, these classes are added by the `brave_content_class`
	 * function. You will see that function used everywhere an `entry-content`
	 * or `page-content` class has been added to a wrapper element.
	 *
	 * For the block editor, these classes are converted to a JavaScript array
	 * and then used by the `./javascript/block-editor.js` file, which adds
	 * them to the appropriate elements in the block editor (and adds them
	 * again when they’re removed.)
	 *
	 * For the classic editor (and anything using TinyMCE, like Advanced Custom
	 * Fields), these classes are added to TinyMCE’s body class when it
	 * initializes.
	 */
    define(
        'brave_TYPOGRAPHY_CLASSES',
        'prose prose-neutral prose-a:text-primary'
    );
}

if (!function_exists('brave_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function brave_setup()
    {
        /*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on brave, use a find and replace
		 * to change 'brave' to the name of your theme in all the template files.
		 */
        load_theme_textdomain('brave', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
        add_theme_support('title-tag');

        /*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus(
            array(
                'menu-1' => __('Primary', 'brave'),
                'footer-menu' => __('Footer Menu', 'brave'),
            )
        );

        /*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        // Add support for editor styles.
        add_theme_support('editor-styles');

        // Enqueue editor styles.
        add_editor_style('style-editor.css');

        // Add support for responsive embedded content.
        add_theme_support('responsive-embeds');

        // Remove support for block templates.
        remove_theme_support('block-templates');
    }
endif;
add_action('after_setup_theme', 'brave_setup');


/**
 * Add a home page
 */
function brave_add_home_page()
{
    $existing_home_page = get_theme_mod('home_page_id');

    if ($existing_home_page) {
        return;
    }

    $home_page = array(
        'post_title' => 'Home',
        'post_content' => '',
        'post_status' => 'publish',
        'post_type' => 'page'
    );

    $home_page_id = wp_insert_post($home_page);

    // save page_id as a theme mod
    set_theme_mod('home_page_id', $home_page_id);

    // set home page as front page
    update_option('show_on_front', 'page');
    update_option('page_on_front', $home_page_id);
}

add_action('after_switch_theme', 'brave_add_home_page');

/**
 * Register plugins
 */
include_once get_template_directory() . '/inc/plugins.php';

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function brave_widgets_init()
{
    register_sidebar(
        array(
            'name'          => __('Footer', 'brave'),
            'id'            => 'sidebar-1',
            'description'   => __('Add widgets here to appear in your footer.', 'brave'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action('widgets_init', 'brave_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function brave_scripts()
{
    wp_enqueue_style('brave-style', get_stylesheet_uri(), array(), brave_VERSION);
    wp_enqueue_script('brave-script', get_template_directory_uri() . '/js/script.min.js', array(), brave_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'brave_scripts');

/**
 * Enqueue the block editor script.
 */
function brave_enqueue_block_editor_script()
{
    wp_enqueue_script(
        'brave-editor',
        get_template_directory_uri() . '/js/block-editor.min.js',
        array(
            'wp-blocks',
            'wp-edit-post',
        ),
        brave_VERSION,
        true
    );
}
add_action('enqueue_block_editor_assets', 'brave_enqueue_block_editor_script');

/**
 * Enqueue the script necessary to support Tailwind Typography in the block
 * editor, using an inline script to create a JavaScript array containing the
 * Tailwind Typography classes from brave_TYPOGRAPHY_CLASSES.
 */
function brave_enqueue_typography_script()
{
    if (is_admin()) {
        wp_enqueue_script(
            'brave-typography',
            get_template_directory_uri() . '/js/tailwind-typography-classes.min.js',
            array(
                'wp-blocks',
                'wp-edit-post',
            ),
            brave_VERSION,
            true
        );
        wp_add_inline_script('brave-typography', "tailwindTypographyClasses = '" . esc_attr(brave_TYPOGRAPHY_CLASSES) . "'.split(' ');", 'before');
    }
}
add_action('enqueue_block_assets', 'brave_enqueue_typography_script');

/**
 * Add the Tailwind Typography classes to TinyMCE.
 *
 * @param array $settings TinyMCE settings.
 * @return array
 */
function brave_tinymce_add_class($settings)
{
    $settings['body_class'] = brave_TYPOGRAPHY_CLASSES;
    return $settings;
}
add_filter('tiny_mce_before_init', 'brave_tinymce_add_class');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';


function brave_customize_register($wp_customize)
{
    // add a panel for the theme options
    $wp_customize->add_panel('theme_options', array(
        'title' => __('Theme Options', 'brave'),
        'description' => __('Customize the theme options', 'brave'),
        'priority' => 1,
    ));

    /**
     * Page Header Section
     */

    // add a section for the page header
    $wp_customize->add_section('page_header', array(
        'title' => __('Page Header', 'brave'),
        'description' => __('Customize the page header', 'brave'),
        'panel' => 'theme_options',
    ));

    // select whether to use a background image
    $wp_customize->add_setting('use_bg_image', array(
        'default' => false,
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    // add a control for the use_bg_image setting
    $wp_customize->add_control('use_bg_image', array(
        'label' => __('Use Background Image', 'brave'),
        'section' => 'page_header',
        'type' => 'checkbox',
    ));

    // transparent navigation
    $wp_customize->add_setting('transparent_nav', array(
        'default' => false,
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    // add a control for the fixed navigation
    $wp_customize->add_control('transparent_nav', array(
        'label' => __('Transparent Navigation', 'brave'),
        'description' => __('Check to make the navigation transparent', 'brave'),
        'section' => 'page_header',
        'type' => 'checkbox',
        'active_callback' => 'toggle_tranparent_nav_option'
    ));

    // gradient color (select)
    $wp_customize->add_setting('use_primary_gradient', array(
        'default' => false,
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    // add a control for the use_primary_gradient setting
    $wp_customize->add_control('use_primary_gradient', array(
        'label' => __('Use Primary Color As Gradient Color', 'brave'),
        'section' => 'page_header',
        'type' => 'checkbox',
        'description' => __('Check to use the primary color as the gradient color. Defaults to black otherwise', 'brave'),
    ));

    /** 
     * Logo Section
     */

    // add a section for the logo
    $wp_customize->add_section('logo', array(
        'title' => __('Logo', 'brave'),
        'description' => __('Customize the logo', 'brave'),
        'panel' => 'theme_options',
    ));

    // add a setting for the logo
    $wp_customize->add_setting('logo', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    // add a control for the logo
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'logo', array(
        'label' => __('Logo', 'brave'),
        'description' => __('Upload the logo', 'brave'),
        'section' => 'logo',
        'settings' => 'logo',
    )));

    // add a secondary logo
    $wp_customize->add_setting('secondary_logo', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    // add a control for the secondary logo
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'secondary_logo', array(
        'label' => __('Secondary Logo', 'brave'),
        'description' => __('Upload the secondary logo', 'brave'),
        'section' => 'logo',
        'settings' => 'secondary_logo',
    )));

    /**
     * COLORS SECTION
     */
    $wp_customize->add_section('colors', array(
        'title' => __('Colors', 'brave'),
        'description' => __('Customize the colors', 'brave'),
        'panel' => 'theme_options',
    ));

    // add a setting for the primary color
    $wp_customize->add_setting('primary_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    // add a control for the primary color
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', array(
        'label' => __('Primary Color', 'brave'),
        'section' => 'colors',
        'settings' => 'primary_color',
    )));

    // add a setting for the button text color
    $wp_customize->add_setting('button_text_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    // add a control for the button text color
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'button_text_color', array(
        'label' => __('Button Text Color', 'brave'),
        'section' => 'colors',
        'settings' => 'button_text_color',
    )));

    // Heading Color
    $wp_customize->add_setting('heading_color', array(
        'default' => '#111827',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    // add a control for the heading color
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'heading_color', array(
        'label' => __('Heading Color', 'brave'),
        'section' => 'colors',
        'settings' => 'heading_color',
    )));

    // Body Color
    $wp_customize->add_setting('body_color', array(
        'default' => '#374151',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    // add a control for the body color
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'body_color', array(
        'label' => __('Body Color', 'brave'),
        'section' => 'colors',
        'settings' => 'body_color',
    )));

    /** 
     * TYPOGRAPHY SECTION
     */
    $wp_customize->add_section('typography', array(
        'title' => __('Typography', 'brave'),
        'description' => __('Customize the typography', 'brave'),
        'panel' => 'theme_options',
    ));

    // add a setting for the body font
    $wp_customize->add_setting('body_font', array(
        'default' => 'sans-serif',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    // add a control for the body font with Google Fonts
    $wp_customize->add_control('body_font', array(
        'label' => __('Body Font', 'brave'),
        'description' => __('Select the body font', 'brave'),
        'section' => 'typography',
        'type' => 'text',
    ));

    // add a setting for the heading font
    $wp_customize->add_setting('heading_font', array(
        'default' => 'sans-serif',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    // add a control for the heading font with Google Fonts
    $wp_customize->add_control('heading_font', array(
        'label' => __('Heading Font', 'brave'),
        'description' => __('Select the heading font', 'brave'),
        'section' => 'typography',
        'type' => 'text',
    ));


    /** 
     * TOP BAR SECTION
     */
    $wp_customize->add_section('top_bar', array(
        'title' => __('Top Bar', 'brave'),
        'description' => __('Customize the top bar', 'brave'),
        'panel' => 'theme_options',
    ));

    // add a setting to hide / show the top bar
    $wp_customize->add_setting('hide_top_bar', array(
        'default' => false,
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    // add a control to hide / show the top bar
    $wp_customize->add_control('hide_top_bar', array(
        'label' => __('Hide Top Bar', 'brave'),
        'section' => 'top_bar',
        'type' => 'checkbox',
    ));

    // background color
    $wp_customize->add_setting('top_bar_bg_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'top_bar_bg_color', array(
        'label' => __('Background Color', 'brave'),
        'section' => 'top_bar',
        'settings' => 'top_bar_bg_color',
    )));

    // text color
    $wp_customize->add_setting('top_bar_text_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'top_bar_text_color', array(
        'label' => __('Text Color', 'brave'),
        'section' => 'top_bar',
        'settings' => 'top_bar_text_color',
    )));


    // add a setting for the phone number
    $wp_customize->add_setting('phone_number', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    // add a control for the phone number
    $wp_customize->add_control('phone_number', array(
        'label' => __('Phone Number', 'brave'),
        'description' => __('Enter the phone number', 'brave'),
        'section' => 'top_bar',
        'type' => 'text',
    ));

    // add a setting for the cta button
    $wp_customize->add_setting('cta_button', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    // add a control for the cta button
    $wp_customize->add_control('cta_button', array(
        'label' => __('CTA Button', 'brave'),
        'description' => __('Enter the CTA button text', 'brave'),
        'section' => 'top_bar',
        'type' => 'text',
    ));

    // add a setting for the cta button url
    $wp_customize->add_setting('cta_button_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    // add a control for the cta button url
    $wp_customize->add_control('cta_button_url', array(
        'label' => __('CTA Button URL', 'brave'),
        'description' => __('Enter the CTA button URL', 'brave'),
        'section' => 'top_bar',
        'type' => 'url',
    ));

    /** 
     * NAVIGATION SECTION
     */
    // add a section for the navigation
    $wp_customize->add_section('navigation', array(
        'title' => __('Navigation', 'brave'),
        'description' => __('Customize the navigation', 'brave'),
        'panel' => 'theme_options',
    ));

    // height
    $wp_customize->add_setting('nav_height', array(
        'default' => '96',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('nav_height', array(
        'label' => __('Height', 'brave'),
        'description' => __('Set the logo and navigation height', 'brave'),
        'section' => 'navigation',
        'type' => 'text',
    ));

    // Font Size
    $wp_customize->add_setting('nav_font_size', array(
        'default' => '16',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    // number input with base of 16
    $wp_customize->add_control('nav_font_size', array(
        'label' => __('Font Size', 'brave'),
        'description' => __('Set the navigation font size', 'brave'),
        'section' => 'navigation',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 12,
            'max' => 24,
            'step' => 1,
        ),
    ));


    // add a setting for the navigation background color
    $wp_customize->add_setting('nav_bg_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    // add a control for the navigation background color
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nav_bg_color', array(
        'label' => __('Background Color', 'brave'),
        'section' => 'navigation',
        'settings' => 'nav_bg_color',
    )));

    // add a setting for the navigation text color
    $wp_customize->add_setting('nav_text_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    // add a control for the navigation text color
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nav_text_color', array(
        'label' => __('Text Color', 'brave'),
        'section' => 'navigation',
        'settings' => 'nav_text_color',
    )));


    /** 
     * SOCIAL MEDIA SECTION
     */
    $wp_customize->add_section('social_media', array(
        'title' => __('Social Media', 'brave'),
        'description' => __('Customize the social media links', 'brave'),
        'panel' => 'theme_options',
    ));

    // add a setting for the facebook url
    $wp_customize->add_setting('facebook_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    // add a control for the facebook url
    $wp_customize->add_control('facebook_url', array(
        'label' => __('Facebook URL', 'brave'),
        'description' => __('Enter the Facebook URL', 'brave'),
        'section' => 'social_media',
        'type' => 'url',
    ));

    // add a setting for the instagram url
    $wp_customize->add_setting('instagram_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    // add a control for the instagram url
    $wp_customize->add_control('instagram_url', array(
        'label' => __('Instagram URL', 'brave'),
        'description' => __('Enter the Instagram URL', 'brave'),
        'section' => 'social_media',
        'type' => 'url',
    ));

    // add a setting for the youtube url
    $wp_customize->add_setting('youtube_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    // add a control for the youtube url
    $wp_customize->add_control('youtube_url', array(
        'label' => __('YouTube URL', 'brave'),
        'description' => __('Enter the YouTube URL', 'brave'),
        'section' => 'social_media',
        'type' => 'url',
    ));
}
add_action('customize_register', 'brave_customize_register');

function sanitize_checkbox($checked)
{
    return $checked == 1 ? true : false;
}

// disable gutenburg editor for front page
add_filter('use_block_editor_for_post', 'disable_gutenberg_editor');
function disable_gutenberg_editor($use_block_editor)
{
    global $post;
    if ($post && $post->ID == get_option('page_on_front')) return false;
    return $use_block_editor;
}


// add a custom meta field name of free_trial in the attributes section of the program post type
// The field should be a checkbox with a label of "Offer Free Trial?"

function brave_add_free_trial_field()
{
    add_meta_box(
        'free_trial',
        __('Free Trial', 'brave'),
        'brave_free_trial_field',
        'program',
        'side',
        'default'
    );
}

add_action('add_meta_boxes', 'brave_add_free_trial_field');


// add a checkbox that saves true or false to the free_trial meta field
function brave_free_trial_field($post)
{
    $value = get_post_meta($post->ID, 'free_trial', true);
    wp_nonce_field('brave_free_trial_field', 'brave_free_trial_field_nonce');
?>

    <input type="checkbox" name="free_trial" id="free_trial" value="1" <?php checked($value, '1'); ?> />
    <label for="free_trial"><?php _e('Offer Free Trial?', 'brave'); ?></label>
<?php
}

// save the free_trial meta field
function brave_save_free_trial_field($post_id)
{
    // check if the current user is authorized to do this action
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // check if the nonce field is set
    if (!isset($_POST['brave_free_trial_field_nonce'])) {
        return;
    }

    // verify the nonce field
    if (!wp_verify_nonce($_POST['brave_free_trial_field_nonce'], 'brave_free_trial_field')) {
        return;
    }

    update_post_meta($post_id, 'free_trial', $_POST['free_trial'] == 1 ? 1 : 0);
}

add_action('save_post', 'brave_save_free_trial_field');


function toggle_tranparent_nav_option()
{
    return get_theme_mod('use_bg_image') ? true : false;
}

// watch for changes to the use_bg_image setting
add_action('customize_save_after', 'brave_watch_bg_image_setting');
function brave_watch_bg_image_setting()
{
    // if the use_bg_image setting is true, set the transparent_nav setting to false
    if (get_theme_mod('use_bg_image') == false) {
        set_theme_mod('transparent_nav', false);
    }
}

function my_acf_init()
{
    acf_update_setting('google_api_key', 'AIzaSyCMw3B4EQJb21NwEf19FmZEoSHqkSb7voo');
}
add_action('acf/init', 'my_acf_init');


/**
 * $color is a hex color
 * $percentage is a number between 0 and 100
 * $opacity is a number between 0 and 1
 * 
 * // return in the format  of rgba(1,1,1,.3)
 *  */
function brave_color_brightness($hex, $percentage, $opacity = 1)
{
    $rgb = brave_hex2rgb($hex);
    $rgb = explode(",", $rgb);
    $percentage = $percentage / 100;
    $rgb[0] = round($rgb[0] * $percentage);
    $rgb[1] = round($rgb[1] * $percentage);
    $rgb[2] = round($rgb[2] * $percentage);
    return "rgba(" . implode(",", $rgb) . ",$opacity)";
}

function brave_hex2rgb($hex)
{
    $hex = str_replace("#", "", $hex);
    if (strlen($hex) == 3) {
        $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }
    $rgb = array($r, $g, $b);
    return implode(",", $rgb);
}


// create a shortcode to display the current year
function brave_current_year_shortcode()
{
    return date('Y');
}

add_shortcode('current_year', 'brave_current_year_shortcode');

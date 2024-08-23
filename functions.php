<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

//require_once('msuupdates.php');

require_once get_stylesheet_directory() . '/inc/widgets/news-updates-widget.php';
require_once get_stylesheet_directory() . '/inc/widgets/front-slider-widget.php';


// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if (!function_exists('chld_thm_cfg_locale_css')):
    function chld_thm_cfg_locale_css($uri)
    {
        if (empty($uri) && is_rtl() && file_exists(get_template_directory() . '/rtl.css'))
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter('locale_stylesheet_uri', 'chld_thm_cfg_locale_css');


function my_child_theme_enqueue_styles()
{
    $assets_url = get_stylesheet_directory_uri() . '/assets/';
    // Enqueue CSS files
    wp_enqueue_style('bootstrap-css', $assets_url . 'css/bootstrap.min.css');
    wp_enqueue_style('owl-carousel-css', $assets_url . 'css/owl.carousel.min.css');
    wp_enqueue_style('animate-css', $assets_url . 'css/animate.css');
    wp_enqueue_style('main-style-css', $assets_url . 'css/style.css');
}

add_action('wp_enqueue_scripts', 'my_child_theme_enqueue_styles');

// js files
function my_child_theme_enqueue_script_js()
{
    $assets_url = get_stylesheet_directory_uri() . '/assets/';
    // Enqueue JS files
    wp_enqueue_script('bootstrap-js', $assets_url . 'js/bootstrap.min.js', array('jquery'), null, true);
    wp_enqueue_script('owl-carousel-js', $assets_url . 'js/owl.carousel.min.js', array('jquery'), null, true);
    wp_enqueue_script('plugins-js', $assets_url . 'js/plugins.js', array('jquery'), null, true);
    wp_enqueue_script('main-js', $assets_url . 'js/main.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'my_child_theme_enqueue_script_js');


if (!function_exists('child_theme_configurator_css')):
    function child_theme_configurator_css()
    {
        wp_enqueue_style('chld_thm_cfg_child', trailingslashit(get_stylesheet_directory_uri()) . 'style.css', array('astra-theme-css'));
    }
endif;
add_action('wp_enqueue_scripts', 'child_theme_configurator_css', 10);


function enqueue_font_awesome()
{
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'enqueue_font_awesome');

// function enqueue_bootstrap() {
//     wp_enqueue_style('bootstrap-style', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css', array('astra-theme-css'), );
// }
// add_action('wp_enqueue_scripts', 'enqueue_bootstrap');


// END ENQUEUE PARENT ACTION

<?php
/*
Plugin Name: My Carousel & Hover Plugin
Description: A simple carousel and hover effects plugin as a lightweight Elementor alternative.
Version: 1.1
Author: Your Company
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

// Enqueue scripts and styles
function mchp_enqueue_assets() {
    // Carousel CSS and JS (Owl Carousel CDN)
    wp_enqueue_style('owl-carousel-css', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');
    wp_enqueue_style('owl-carousel-theme-css', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css');
    wp_enqueue_script('owl-carousel-js', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', ['jquery'], null, true);

    // Custom styles for hover effects
    wp_enqueue_style('mchp-custom-css', plugin_dir_url(__FILE__) . 'css/mchp-styles.css');

    // Custom JS to initialize carousel
    wp_enqueue_script('mchp-custom-js', plugin_dir_url(__FILE__) . 'js/mchp-scripts.js', ['jquery', 'owl-carousel-js'], null, true);
}
add_action('wp_enqueue_scripts', 'mchp_enqueue_assets');

// Shortcode for carousel, accepts image URLs as comma separated list, hover on/off
function mchp_carousel_shortcode($atts) {
    $atts = shortcode_atts([
        'items' => '',      // comma separated image|text pairs
        'hover' => 'true',
    ], $atts);

    if (empty($atts['items'])) {
        return 'No images provided.';
    }

    $hover_class = ($atts['hover'] === 'true') ? 'mchp-hover-effect' : '';

    $items = explode(',', $atts['items']);
    $html = '<div class="mchp-carousel owl-carousel ' . esc_attr($hover_class) . '">';
    foreach ($items as $item) {
        $parts = explode('|', $item);
        $img = trim($parts[0]);
        $text = isset($parts[1]) ? trim($parts[1]) : '';

        $html .= '<div class="item">';
        $html .= '<img src="' . esc_url($img) . '" alt="Carousel Image">';
        if ($text !== '') {
            $html .= '<div class="mchp-caption">' . esc_html($text) . '</div>';
        }
        $html .= '</div>';
    }
    $html .= '</div>';

    return $html;
}
add_shortcode('mchp_carousel', 'mchp_carousel_shortcode');

add_shortcode('mchp_carousel', 'mchp_carousel_shortcode');

<?php
/*
Plugin Name: Budget Plugin MWEHEHEHHEHEHE
Description: basta animation ni siya, carousel, etc.
Version: 1.1.3
Author: Mark Bencel Mangila
*/

if (!defined('ABSPATH')) exit; 


function mchp_enqueue_assets() {
    // Carousel CSS and JS (Owl Carousel CDN) for free?????
    wp_enqueue_style('owl-carousel-css', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');
    wp_enqueue_style('owl-carousel-theme-css', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css');
    wp_enqueue_script('owl-carousel-js', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', ['jquery'], null, true);


    wp_enqueue_style('mchp-custom-css', plugin_dir_url(__FILE__) . 'css/mchp-styles.css');


    wp_enqueue_script('mchp-custom-js', plugin_dir_url(__FILE__) . 'js/mchp-scripts.js', ['jquery', 'owl-carousel-js'], null, true);
}
add_action('wp_enqueue_scripts', 'mchp_enqueue_assets');

// Shortcode for carousel, nice unta if drag and drop pero kapoy naman oi
function mchp_carousel_shortcode($atts) {
    $atts = shortcode_atts([
        'items' => '',
        'hover' => 'true',
    ], $atts);

    if (empty(trim($atts['items']))) {
        return 'No images provided.';
    }

    // Split items by commas
    $items_raw = explode(',', $atts['items']);
    $items = [];

    foreach ($items_raw as $item) {
        $item = trim($item);
        if (empty($item)) continue;

        // Split into image URL and caption
        $parts = explode('|', $item, 2); // limit to 2 parts max
        $img = isset($parts[0]) ? trim($parts[0]) : '';
        $text = isset($parts[1]) ? trim($parts[1]) : '';

        if (empty($img)) continue;

        // Optional: validate URL format
        if (!filter_var($img, FILTER_VALIDATE_URL)) {
            return 'Invalid image URL detected: ' . esc_html($img);
        }

        $items[] = [
            'img' => $img,
            'text' => $text
        ];
    }

    if (count($items) === 0) {
        return 'No valid images found.';
    }

    $hover_class = ($atts['hover'] === 'true') ? 'mchp-hover-effect' : '';

    $html = '<div class="mchp-carousel owl-carousel ' . esc_attr($hover_class) . '">';
    foreach ($items as $item) {
        $html .= '<div class="item">';
        $html .= '<img src="' . esc_url($item['img']) . '" alt="Carousel Image">';
        if (!empty($item['text'])) {
            $html .= '<div class="mchp-caption">' . esc_html($item['text']) . '</div>';
        }
        $html .= '</div>';
    }
    $html .= '</div>';

    return $html;
}
add_shortcode('mchp_carousel', 'mchp_carousel_shortcode');


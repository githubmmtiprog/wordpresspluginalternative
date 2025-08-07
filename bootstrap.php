<?php
/*
Plugin Name: Bootstrap Plugin 
Description: Basta animation ni siya — carousel, etc.
Version: 1.1.3
Author: Mark Bencel Mangila
*/

if (!defined('ABSPATH')) exit;

add_action('wp_enqueue_scripts', function () {

    // Bootstrap CSS
    wp_enqueue_style(
        'bootstrap-css',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css'
    );

    // Bootstrap JS bundle (includes Popper)
    wp_enqueue_script(
        'bootstrap-js',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js',
        [],
        null,
        true
    );

   
    wp_enqueue_style(
        'custom-carousel-style',
        plugin_dir_url(__FILE__) . 'style.css'
    );

    
    wp_enqueue_script(
        'custom-carousel-script',
        plugin_dir_url(__FILE__) . 'script.js',
        [],
        null,
        true
    );
});

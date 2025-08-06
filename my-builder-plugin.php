<?php
/**
 * Plugin Name: Form Builder Plugin
 * Description: Full-featured Theme Builder, Popups, and Forms.
 * Version: 1.0
 * Author: Mark Bencel Mangila
 */

if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

// Load Core Modules
foreach (glob(plugin_dir_path(__FILE__) . 'modules/*/*.php') as $module_file) {
    require_once $module_file;
}

// Load Widget Loader
require_once plugin_dir_path(__FILE__) . 'includes/widget-loader.php';

// Enqueue Assets
function my_builder_enqueue_assets($hook) {
    if (strpos($hook, 'my-builder') !== false) {
        wp_enqueue_style('my-builder-style', plugins_url('assets/css/editor.css', __FILE__));
        wp_enqueue_script('my-builder-script', plugins_url('assets/js/editor.js', __FILE__), array('jquery'), null, true);
        wp_localize_script('my-builder-script', 'ajaxurl', admin_url('admin-ajax.php'));
    }
}
add_action('admin_enqueue_scripts', 'my_builder_enqueue_assets');

// Admin Menu
require_once plugin_dir_path(__FILE__) . 'admin/admin-menu.php';
// Enqueue Popup Admin
function my_builder_enqueue_admin_popup_assets($hook) {
    if (strpos($hook, 'my-builder-popups') !== false) {
        wp_enqueue_script('my-builder-popup-admin', plugins_url('assets/js/popup-admin.js', __FILE__), array('jquery'), null, true);
    }
}
add_action('admin_enqueue_scripts', 'my_builder_enqueue_admin_popup_assets');

function my_builder_enqueue_frontend_assets() {
    wp_enqueue_style('my-builder-popups-css', plugins_url('assets/css/popups.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'my_builder_enqueue_frontend_assets');

// Enqueue Admin Form Builder
function my_builder_enqueue_form_builder_assets($hook) {
    if (strpos($hook, 'my-builder-forms') !== false) {
        wp_enqueue_script('my-builder-form-builder', plugins_url('assets/js/form-builder.js', __FILE__), array('jquery'), null, true);
    }
}
add_action('admin_enqueue_scripts', 'my_builder_enqueue_form_builder_assets');

// Enqueue Frontend Form Submission JS
function my_builder_enqueue_form_frontend_assets() {
    wp_enqueue_script('my-builder-form-submit', plugins_url('assets/js/form-submit.js', __FILE__), array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'my_builder_enqueue_form_frontend_assets');

?>

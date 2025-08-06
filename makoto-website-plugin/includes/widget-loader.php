<?php
// Load Widget Files
require_once plugin_dir_path(__FILE__) . 'widgets/heading.php';
require_once plugin_dir_path(__FILE__) . 'widgets/button.php';

// AJAX Render Widget
function my_builder_render_widget() {
    $widget = sanitize_text_field($_POST['widget']);
    ob_start();
    switch ($widget) {
        case 'heading':
            my_builder_widget_heading();
            break;
        case 'button':
            my_builder_widget_button();
            break;
    }
    echo ob_get_clean();
    wp_die();
}
add_action('wp_ajax_render_widget', 'my_builder_render_widget');
function my_builder_save_layout() {
    if (!current_user_can('manage_options')) wp_send_json_error('Unauthorized');
    $layout = wp_kses_post($_POST['layout']);
    update_option('my_builder_layout', $layout);
    wp_send_json_success('Layout Saved!');
}
add_action('wp_ajax_save_layout', 'my_builder_save_layout');
?>
<?php
function my_builder_create_popup() {
    $popups = get_option('my_builder_popups', []);
    $popup_id = 'popup_' . time();
    $popups[$popup_id] = [
        'id' => $popup_id,
        'content' => '<p>Edit your popup content here</p>',
        'trigger' => 'on_load', // Default trigger
        'delay' => 5
    ];
    update_option('my_builder_popups', $popups);
    wp_send_json_success($popups[$popup_id]);
}
add_action('wp_ajax_create_popup', 'my_builder_create_popup');

function my_builder_save_popup() {
    $popup_id = sanitize_text_field($_POST['popup_id']);
    $content = wp_kses_post($_POST['content']);
    $trigger = sanitize_text_field($_POST['trigger']);
    $delay = intval($_POST['delay']);
    $popups = get_option('my_builder_popups', []);
    if (isset($popups[$popup_id])) {
        $popups[$popup_id]['content'] = $content;
        $popups[$popup_id]['trigger'] = $trigger;
        $popups[$popup_id]['delay'] = $delay;
        update_option('my_builder_popups', $popups);
        wp_send_json_success('Popup Saved');
    }
    wp_send_json_error('Popup Not Found');
}
add_action('wp_ajax_save_popup', 'my_builder_save_popup');
?>

<?php
function my_builder_save_form_layout() {
    if (!current_user_can('manage_options')) wp_send_json_error('Unauthorized');
    $form_html = wp_kses_post($_POST['form_html']);
    update_option('my_builder_form_layout', $form_html);
    wp_send_json_success('Form Saved!');
}
add_action('wp_ajax_save_form_layout', 'my_builder_save_form_layout');
?>

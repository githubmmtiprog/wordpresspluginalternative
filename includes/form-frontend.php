<?php
function my_builder_render_form() {
    $form_html = get_option('my_builder_form_layout', '');
    ob_start();
    ?>
    <form id="my-builder-form">
        <?php echo $form_html; ?>
    </form>
    <div id="form-response"></div>
    <?php
    return ob_get_clean();
}
add_shortcode('my_builder_form', 'my_builder_render_form');

function my_builder_form_submit() {
    // Process form data here. For now, we just log and return success.
    // In real-world, you'd save to DB or send emails.
    wp_send_json_success('Form Submitted Successfully!');
}
add_action('wp_ajax_nopriv_my_builder_form_submit', 'my_builder_form_submit');
add_action('wp_ajax_my_builder_form_submit', 'my_builder_form_submit');
?>

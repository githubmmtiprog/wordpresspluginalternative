<?php
function my_builder_widget_heading($settings = array()) {
    $content = isset($settings['content']) ? $settings['content'] : 'Heading Text';
    echo '<h2 contenteditable="true" class="my-builder-editable">' . esc_html($content) . '</h2>';
}
?>
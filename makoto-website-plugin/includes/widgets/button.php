<?php
function my_builder_widget_button($settings = array()) {
    $text = isset($settings['text']) ? $settings['text'] : 'Click Me';
    echo '<button contenteditable="true" class="my-builder-editable">' . esc_html($text) . '</button>';
}
?>
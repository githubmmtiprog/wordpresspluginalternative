<?php
function my_builder_admin_menu() {
    add_menu_page('My Builder', 'My Builder', 'manage_options', 'my-builder', 'my_builder_dashboard', 'dashicons-layout', 60);
    add_submenu_page('my-builder', 'Editor', 'Editor', 'manage_options', 'my-builder-editor', 'my_builder_editor_page');
    add_submenu_page('my-builder', 'Popups', 'Popups', 'manage_options', 'my-builder-popups', 'my_builder_popups_page');
}
add_action('admin_menu', 'my_builder_admin_menu');

function my_builder_dashboard() {
    echo '<div class="wrap"><h1>My Builder Dashboard</h1></div>';
}

function my_builder_popups_page() {
    ?>
    <div class="wrap">
        <h1>Popup Manager</h1>
        <button id="create-popup" class="button button-primary">Create New Popup</button>
        <div id="popup-list"></div>
    </div>
    <?php
}
function my_builder_editor_page() {
    ?>
    <div class="wrap">
        <h1>My Builder Editor</h1>
        <div id="my-builder-editor"></div>
        <button id="save-layout" class="button button-primary">Save Layout</button>
    </div>
    <?php
}
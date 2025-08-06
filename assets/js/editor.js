jQuery(document).ready(function($) {
    const root = $('#my-builder-editor-root');
    root.html(`
        <div class="my-builder-sidebar">
            <h3>Widgets</h3>
            <div class="my-builder-widget" data-widget="heading" draggable="true">Heading</div>
            <div class="my-builder-widget" data-widget="button" draggable="true">Button</div>
            <hr>
            <h3>Layout</h3>
            <button id="add-section">Add Section</button>
        </div>
        <div class="my-builder-canvas" id="my-builder-canvas">
            <p style="text-align:center;margin-top:40px;">Click 'Add Section' to start</p>
        </div>
    `);

    $('#add-section').on('click', function() {
        $('#my-builder-canvas').append(`
            <div class="my-builder-section">
                <div class="my-builder-row">
                    <div class="my-builder-column" contenteditable="false">
                        <p>Drop widgets here</p>
                    </div>
                </div>
            </div>
        `);
    });

    $('.my-builder-widget').on('dragstart', function(e) {
        e.originalEvent.dataTransfer.setData('widget-type', $(this).data('widget'));
    });

    $(document).on('dragover', '.my-builder-column', function(e) {
        e.preventDefault();
    });

    $(document).on('drop', '.my-builder-column', function(e) {
        e.preventDefault();
        const widgetType = e.originalEvent.dataTransfer.getData('widget-type');
        const column = $(this);
        $.post(ajaxurl, { action: 'render_widget', widget: widgetType }, function(response) {
            column.append(response);
        });
    });

    // Save Layout Button
    if ($('#save-layout').length === 0) {
        $('.wrap').prepend('<button id="save-layout" class="button button-primary">Save Layout</button>');
    }

    $(document).on('click', '#save-layout', function() {
        const layoutData = $('#my-builder-canvas').html();
        $.post(ajaxurl, { action: 'save_layout', layout: layoutData }, function(response) {
            alert(response.data);
        });
    });
});

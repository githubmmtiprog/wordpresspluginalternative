jQuery(document).ready(function($) {
    const root = $('#my-builder-editor-root');
    root.html(`
        <link rel="stylesheet" href="${window.pluginAssetsUrl || 'assets/css/editor-modern.css'}?v=1.0">
        <div class="myb-builder-container">
            <aside class="myb-sidebar">
                <div class="myb-sidebar-header">
                    <h2><span class="myb-logo">🛠️</span> Builder</h2>
                </div>
                <div class="myb-widgets-list">
                    <h4>Widgets</h4>
                    <div class="myb-widget-card" data-widget="heading" draggable="true">
                        <span class="myb-widget-icon">🔤</span>
                        <span class="myb-widget-label">Heading</span>
                    </div>
                    <div class="myb-widget-card" data-widget="button" draggable="true">
                        <span class="myb-widget-icon">🔘</span>
                        <span class="myb-widget-label">Button</span>
                    </div>
                </div>
                <div class="myb-sidebar-footer">
                    <button id="add-section" class="myb-btn myb-btn-primary">+ Add Section</button>
                </div>
            </aside>
            <main class="myb-canvas-wrapper">
                <div class="myb-canvas" id="my-builder-canvas">
                    <div class="myb-canvas-placeholder">Click <b>Add Section</b> to start building your layout</div>
                </div>
            </main>
        </div>
    `);

    $('#add-section').on('click', function() {
        const canvas = $('#my-builder-canvas');
        canvas.find('.myb-canvas-placeholder').remove();
        canvas.append(`
            <section class="myb-section">
                <div class="myb-row">
                    <div class="myb-column" contenteditable="false">
                        <div class="myb-dropzone">Drop widgets here</div>
                    </div>
                </div>
            </section>
        `);
    });

    $(document).on('dragstart', '.myb-widget-card', function(e) {
        e.originalEvent.dataTransfer.setData('widget-type', $(this).data('widget'));
        $(this).addClass('myb-dragging');
    });
    $(document).on('dragend', '.myb-widget-card', function(e) {
        $(this).removeClass('myb-dragging');
    });

    $(document).on('dragover', '.myb-column', function(e) {
        e.preventDefault();
        $(this).addClass('myb-column-hover');
    });
    $(document).on('dragleave', '.myb-column', function(e) {
        $(this).removeClass('myb-column-hover');
    });

    $(document).on('drop', '.myb-column', function(e) {
        e.preventDefault();
        $(this).removeClass('myb-column-hover');
        const widgetType = e.originalEvent.dataTransfer.getData('widget-type');
        const column = $(this);
        $.post(ajaxurl, { action: 'render_widget', widget: widgetType }, function(response) {
            column.find('.myb-dropzone').remove();
            column.append(response);
        });
    });

    if ($('#save-layout').length === 0) {
        $('.wrap').prepend('<button id="save-layout" class="myb-btn myb-btn-success">💾 Save Layout</button>');
    }

    $(document).on('click', '#save-layout', function() {
        const layoutData = $('#my-builder-canvas').html();
        $.post(ajaxurl, { action: 'save_layout', layout: layoutData }, function(response) {
            // Modern notification
            const msg = $('<div class="myb-toast">' + response.data + '</div>');
            $('body').append(msg);
            setTimeout(() => msg.fadeOut(400, () => msg.remove()), 2000);
        });
    });
});

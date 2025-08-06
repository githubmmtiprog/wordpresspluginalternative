jQuery(document).ready(function($) {
    const root = $('#form-builder-root');
    root.html(`
        <div class="my-builder-sidebar">
            <h3>Fields</h3>
            <div class="my-builder-field" data-field="text" draggable="true">Text Field</div>
            <div class="my-builder-field" data-field="email" draggable="true">Email Field</div>
            <div class="my-builder-field" data-field="textarea" draggable="true">Textarea</div>
            <div class="my-builder-field" data-field="checkbox" draggable="true">Checkbox</div>
            <div class="my-builder-field" data-field="submit" draggable="true">Submit Button</div>
        </div>
        <div class="my-builder-canvas" id="form-canvas">
            <p style="text-align:center;margin-top:40px;">Drag form fields here</p>
        </div>
        <button id="save-form" class="button button-primary">Save Form</button>
    `);

    $('.my-builder-field').on('dragstart', function(e) {
        e.originalEvent.dataTransfer.setData('field-type', $(this).data('field'));
    });

    $('#form-canvas').on('dragover', function(e) {
        e.preventDefault();
    });

    $('#form-canvas').on('drop', function(e) {
        e.preventDefault();
        const fieldType = e.originalEvent.dataTransfer.getData('field-type');
        let fieldHTML = '';
        switch(fieldType) {
            case 'text':
                fieldHTML = '<input type="text" name="form_text[]" placeholder="Text Field" />';
                break;
            case 'email':
                fieldHTML = '<input type="email" name="form_email[]" placeholder="Email Field" />';
                break;
            case 'textarea':
                fieldHTML = '<textarea name="form_textarea[]" placeholder="Textarea"></textarea>';
                break;
            case 'checkbox':
                fieldHTML = '<label><input type="checkbox" name="form_checkbox[]" /> Checkbox</label>';
                break;
            case 'submit':
                fieldHTML = '<button type="submit">Submit</button>';
                break;
        }
        $('#form-canvas').append('<div class="form-builder-field">'+fieldHTML+'</div>');
    });

    $('#save-form').on('click', function() {
        const formHTML = $('#form-canvas').html();
        $.post(ajaxurl, { action: 'save_form_layout', form_html: formHTML }, function(response) {
            alert(response.data);
        });
    });
});

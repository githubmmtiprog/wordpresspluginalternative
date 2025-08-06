jQuery(document).ready(function($) {
    $(document).on('submit', '#my-builder-form', function(e) {
        e.preventDefault();
        const formData = $(this).serialize();
        $.post(ajaxurl, { action: 'my_builder_form_submit', data: formData }, function(response) {
            $('#form-response').html(response.data);
        });
    });
});

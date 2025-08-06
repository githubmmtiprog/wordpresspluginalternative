jQuery(document).ready(function($) {
    $('#create-popup').on('click', function() {
        $.post(ajaxurl, { action: 'create_popup' }, function(response) {
            if(response.success) {
                alert('Popup Created');
                location.reload();
            }
        });
    });
});

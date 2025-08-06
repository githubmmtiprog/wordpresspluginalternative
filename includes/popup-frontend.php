<?php
function my_builder_load_popups() {
    $popups = get_option('my_builder_popups', []);
    foreach ($popups as $popup) {
        echo '<div class="my-builder-popup" id="'.$popup['id'].'" style="display:none;">' . $popup['content'] . '</div>';
        ?>
        <script>
        jQuery(document).ready(function($) {
            let trigger = '<?php echo $popup['trigger']; ?>';
            let popupID = '#<?php echo $popup['id']; ?>';
            if (trigger === 'on_load') {
                setTimeout(() => { $(popupID).fadeIn(); }, <?php echo $popup['delay'] * 1000; ?>);
            } else if (trigger === 'on_scroll') {
                $(window).on('scroll', function() {
                    let scrollPercent = ($(window).scrollTop() / ($(document).height() - $(window).height())) * 100;
                    if (scrollPercent > 50) $(popupID).fadeIn();
                });
            } else if (trigger === 'on_exit') {
                $(document).on('mouseleave', function(e) {
                    if (e.clientY < 10) $(popupID).fadeIn();
                });
            }
        });
        </script>
        <?php
    }
}
add_action('wp_footer', 'my_builder_load_popups');
?>

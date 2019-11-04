jQuery(document).ready(function($) {

    jQuery(".chosen-select").chosen();

    jQuery(document).on('click', '#remove_image_button', function() {
        jQuery('#background_image').val('');
        jQuery('#cplc-loading-animation').attr("src", "");
    });
});
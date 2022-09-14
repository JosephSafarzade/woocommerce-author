jQuery(document).ready(function(){
    wooa_init_select2_inputs();
    wooa_handle_media_upload_button_click();
    wooa_handle_media_reset_button_click();
});



function wooa_init_select2_inputs(){

    if( $(".wooa-admin-input-select").length < 1 ){

        return;

    }

    $(".wooa-admin-input-select").select2();

}



function wooa_handle_media_reset_button_click(){

    $('.wooa-media-reset-button').click(function(event) {

        var $main_parent = $(this).parents('.wooa-admin-input-container');

        event.preventDefault();

        $main_parent.find('.wooa-admin-input-id-value').val('');

        $main_parent.find('.wooa-admin-input-url-value').val('');

    });


}


function wooa_handle_media_upload_button_click(){

    var frame;

    $('.wooa-media-upload-button').click(function(event) {

        var $main_parent = $(this).parents('.wooa-admin-input-container');

        event.preventDefault();

        // If the media frame already exists, reopen it.
        if ( frame ) {
            frame.open();
            return;
        }

        // Create a new media frame
        frame = wp.media({
            title: 'Select or Upload Image',
            button: {
                text: 'Use this Image'
            },
            multiple: false  // Set to true to allow multiple files to be selected
        });


        // When an image is selected in the media frame...
        frame.on( 'select', function() {

            // Get media attachment details from the frame state
            var attachment = frame.state().get('selection').first().toJSON();

            $main_parent.find('.wooa-admin-input-id-value').val(attachment.id);

            $main_parent.find('.wooa-admin-input-url-value').val(attachment.url);

        });
    });


}

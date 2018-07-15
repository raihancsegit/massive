;(function ($) {
    'use strict';

    $(document).ready(function () {
        $('body').off('click', '.widgetuploader');

        $('body').on('click', '.widgetuploader', function() {
            renderSingleImageUploader(this);
        });
    });

    function renderSingleImageUploader(controller) {
        var file_frame, parent, imgInput, imgPreview;

        parent = $(controller).parents('.widget-content');
        imgInput = parent.find('.imgph');
        imgPreview = parent.find('.imgpreview');

        if ( undefined !== file_frame ) {
            file_frame.open();
            return;
        }

        file_frame = wp.media.frames.file_frame = wp.media({
            title: 'Insert Media',
            library: { type: 'image' },
            button: { text: 'Upload Image' },
            multiple: false
        });

        file_frame.on('select', function () {
            var image_data, thumbnail;
            image_data = file_frame.state().get('selection').first().toJSON();
            if(image_data.id) {
                imgInput.val(image_data.id);
                thumbnail = ( typeof image_data.sizes.thumbnail !== 'undefined' ) ? image_data.sizes.thumbnail.url : image_data.url;
                imgPreview.html("<img src='" + thumbnail + "'/>");
                $(controller).val('Change Image');
            }
        });

        file_frame.open();
    };

})(jQuery);

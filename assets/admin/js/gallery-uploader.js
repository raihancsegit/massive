;(function ($) {
    'use strict';

    $(document).ready(function () {
        $('body').off('click', '.gallery-uploader');

        $('body').on('click', '.gallery-uploader', function() {
            renderImageGallery(this);
        });

        fixUploaderLabel();
    });

    function renderImageGallery(controller) {
        var file_frame, parent, imgsInput, imgsPreview, state;

        parent = $(controller).parents('.widget-content');
        imgsInput = parent.find('.field-gallery-imgs');
        imgsPreview = parent.find('.preview-gallery');
        state = $(controller).data('state');
        state = ( 'edit' === state ) ? 'gallery-edit' : 'gallery-library';

        if ( undefined !== file_frame ) {
            file_frame.open();
            file_frame.setState(state);
            return;
        }

        file_frame = wp.media.frames.file_frame = wp.media({
            library: { type: 'image' },
            frame: 'post',
            state: 'gallery',
            multiple: true
        });

        file_frame.on('open', function() {
            var ids = imgsInput.val();
            if ( ids ) {
                var get_array = ids.split(',');
                var library   = file_frame.state('gallery-edit').get('library');

                file_frame.setState(state);

                get_array.forEach(function(id) {
                    var attachment = wp.media.attachment(id);
                    library.add( attachment ? [ attachment ] : [] );
                });
            }
        });

        file_frame.on( 'update', function() {

            var inner  = '',
                ids    = [],
                images = file_frame.state().get('library');

            images.each(function(attachment) {
                var attributes = attachment.toJSON(),
                    thumbnail  = ( typeof attributes.sizes.thumbnail !== 'undefined' ) ? attributes.sizes.thumbnail.url : attributes.url;
                inner += '<li><img src="'+ thumbnail +'"></li>';
                ids.push(attributes.id);
                $(controller).val('Update Gallery');
            });

            imgsInput.val(ids).trigger('change');
            imgsPreview.html(inner);
        });

        file_frame.open();
    };

    function fixUploaderLabel() {
        $('.gallery-uploader').each(function() {
            if ('edit' === $(this).data('state')) {
                $(this).val('Update Gallery');
            }
        });
    }

})(jQuery);

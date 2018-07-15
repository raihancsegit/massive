;(function($) {
    'use strict';

    $(function() {
        var bannerTypes = ['bs','elastic','flex','owl','static'];
        var postFormats = ['audio','video','gallery'];

        hideMetaBoxesExcept(
                $('#_massive_banner_type').find('input[type="radio"]:checked').val(),
                bannerTypes,
                '#_massive_banner_{name}'
                );

        hideMetaBoxesExcept(
                $('#formatdiv').find('input[type="radio"]:checked').val(),
                postFormats,
                '#_massive_mb_{name}_post'
                );

        $('#_massive_banner_type').find('input[type="radio"]').on( 'click', function() {
            hideMetaBoxesExcept($(this).val(), bannerTypes, '#_massive_banner_{name}');
        });

        $('#formatdiv').find('input[type="radio"]').on( 'click', function() {
            hideMetaBoxesExcept($(this).val(), postFormats, '#_massive_mb_{name}_post');
        });

        // hide footer settings fields
        hideSlaves($('[data-depend-id="footer_status"]'));
        $('[data-depend-id="footer_status"]').on('change', function() {
            hideSlaves($(this));
        });

        // hide title settings fields
        hideSlaves($('[data-depend-id="title_status"]'));
        $('[data-depend-id="title_status"]').on('change', function() {
            hideSlaves($(this));
        });

        // hide navbar settings fields
        hideSlaves($('[data-depend-id="navbar_override"]'));
        $('[data-depend-id="navbar_override"]').on('change', function() {
            hideSlaves($(this));
        });

        // hide banner settings fields
        hideSlaves($('[data-depend-id="banner_status"]'));
        $('[data-depend-id="banner_status"]').on('change', function() {
            hideSlaves($(this));
        });
    });

    function hideSlaves($master) {
        var $slaves = $master.parents('.cs-element').siblings('.cs-element');
        if ($master.is(':checked')) {
            $slaves.removeAttr('style');
        } else {
            $slaves.hide();
        }
    }

    function hideMetaBoxesExcept( except, mbs, pattern ) {
        for(var i=0, len=mbs.length; i<len; i++) {
            if ( except == mbs[i] ) {
                $(pattern.replace('{name}', mbs[i])).show();
            } else {
                $(pattern.replace('{name}', mbs[i])).hide();
            }
        }
    }

}(jQuery));

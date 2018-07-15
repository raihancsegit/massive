;(function($) {
    'use strict';

    $( document ).ready( function() {
        MassiveMegamenu.init();
        addIconField();
    });

    function addIconField() {
        wpNavMenu.menuList.on('click', '.js-menu-item-icon', function (event) {
            var iconField = $(this).parents('.js-icon-field');
            var iconListWrapper = iconField.find('.js-menu-icon-list-wrapper');
            var baseIconList = $('#js-menu-icon-list');
            var clonedIconList;
            if (!iconListWrapper.children().length) {
                clonedIconList = baseIconList.clone(true, true).removeAttr('id').show();
                iconListWrapper.html(clonedIconList);
            }
            iconListWrapper.slideToggle('medium');
        });

        wpNavMenu.menuList.on('click', '.menu-icon-list-item', function(event) {
            var iconField = $(this).parents('.js-icon-field');
            var iconHolder = iconField.find('.js-menu-item-icon');
            var className = this.className.replace('menu-icon-list-item ', '');
            var html = $('<i/>',{'class': className});
            iconHolder.html(html);
            iconHolder.next().val(className);
            $(this).parents('.js-menu-icon-list-wrapper').slideUp('medium');
        });
    }

    var MassiveMegamenu = {

        init: function() {
            this.menuItemMove();
            this.menuItemsUpdate();
            this.toggleMegamenu();
        },

        menuItemMove: function() {
            $( document ).on( 'mouseup keyup', '.menu-item-bar', function( event, ui ) {
                if( ! $( event.target ).is( 'a:not(.item-edit)' ) ) {
                    setTimeout( MassiveMegamenu.menuItemsUpdate, 300 );
                }
            });
        },

        toggleMegamenu: function() {
            $( document ).on( 'click', '.edit-menu-item-is-megamenu', function() {
                var current = $( this );
                var parent = $( this ).parents('.menu-item-depth-0');
                var widthField = parent.find('.field-megamenu-width');

                if( current.is( ':checked' ) ) {
                    parent.addClass( 'is-megamenu' );
                    widthField.show();
                } else  {
                    parent.removeClass( 'is-megamenu' );
                    widthField.hide();
                }

                MassiveMegamenu.menuItemsUpdate();
            });
        },

        menuItemsUpdate: function() {
            var menuItem = $('.menu-item');

            menuItem.each( function() {
                var megamenuRow = $('.massive-megamenu-fields-row', this);
                var megamenuColumn = $('.massive-megamenu-fields-column', this);
                var megamenuWidth = $('.field-megamenu-width', this);
                var isMegamenu = $('.edit-menu-item-is-megamenu', this);
                var parentId = parseInt( $('.menu-item-data-parent-id', this).val(), 10 );
                var isParentMegamenu = $('#edit-menu-item-megamenu-enabled-'+parentId);

                megamenuColumn.hide();

                if ( ! $(this).is('.menu-item-depth-0') ) {
                    megamenuRow.hide();
                    isMegamenu.prop('checked', false);

                    if ( isParentMegamenu.is(':checked') ) {
                        megamenuColumn.show();
                    }
                } else {
                    megamenuRow.show();

                    if ( ! isMegamenu.is(':checked') ) {
                        megamenuWidth.hide();
                    } else {
                        megamenuWidth.show();
                    }
                }
            });
        }
    };

}(jQuery));

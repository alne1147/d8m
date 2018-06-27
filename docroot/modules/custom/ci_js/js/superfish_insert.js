(function ($) {
    'use strict';

    Drupal.behaviors.sf2haduken = {
        attach: function(context, settings) {

            $('.region-sidebar-second ul').addClass( "sf-menu" );
            $('.region-sidebar-second ul.menu').addClass( "menu sf-menu sf-main sf-vertical sf-style-none sf-js-enabled" );
            $('.region-sidebar-first ul.menu').addClass( "menu sf-menu sf-main sf-vertical sf-style-none sf-js-enabled" );
            $('.region-sidebar-first ul.menu a').removeClass("dropdown-toggle") .addClass( "menu sf-menu sf-main sf-vertical sf-style-none sf-js-enabled" );
            $("#edit_field_blocks_chosen option[value='blockmainfooter']").remove();

        }
    };

}(jQuery));
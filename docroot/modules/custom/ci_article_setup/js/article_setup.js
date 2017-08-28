(function ($) {
    'use strict';

    Drupal.behaviors.authorDisplay = {
        attach: function(context, settings) {
            $('div.display-options:contains("Show Author")').each(function () {
                $('.author_name').removeClass( "hide" ).addClass( "show" );
            });
        }
    };

    Drupal.behaviors.dateDisplay = {
        attach: function(context, settings) {
            $('div.display-options:contains("Show Post Date")').each(function () {
                $('.author_date').removeClass( "hide" ).addClass( "show" );
            });
        }
    };

}(jQuery));
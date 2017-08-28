(function ($) {
    'use strict';

    Drupal.behaviors.authorDisplay = {
        attach: function(context, settings) {
            $('div.display-options:contains("Show Author")').each(function () {
                $('.author_name').addClass("show"); // matched td add NewClass
            });
        }
    };

    Drupal.behaviors.dateDisplay = {
        attach: function(context, settings) {
            $('div.display-options:contains("Show Post Date")').each(function () {
                $('.author_date').addClass("show"); // matched td add NewClass
            });
        }
    };

}(jQuery));
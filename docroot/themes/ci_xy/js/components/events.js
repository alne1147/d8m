(function ($) {
    'use strict';
    Drupal.behaviors.events = {
        attach: function (context, settings) {
            // Event Fields Variables
            var $eventorganizerfields = $('.field--name-field-date-time-range,.field--name-field-event-organizer,.field--name-field-organizer-email,.field--name-field-article-tags');
            var $eventlocationfields = $('.field--name-field-location');
            var $eventvenuefields = $('.field--name-field-venue');

            // Event Organization set to 4 columns
            if ($eventorganizerfields) {
                $('.event--organization').addClass('col-sm-4');
            }
            // Event Location set to 4 columns
            if ($eventlocationfields) {
                $('.event--location').addClass('col-sm-4');
            }
            // Event Venue set to 4 columns
            if ($eventvenuefields) {
                $('.event--venue').addClass('col-sm-4');
            }
            // When one event block is hidden
            // Event Location and Venue set to 6 columns
            if ($.trim($('.event--organization').html()) == "" ) {
                $('.event--organization').removeClass().attr('class', 'event--organization is--empty');
                $('.event--location').removeClass().attr('class', 'event--location col-sm-6');
                $('.event--venue').removeClass().attr('class', 'event--venue col-sm-6');
            }
            // Event Organization and Venue set to 6 columns
            if ($.trim($('.event--location').html()) == "" ) {
                $('.event--location').removeClass().attr('class', 'event--location is--empty');
                $('.event--organization').removeClass().attr('class', 'event--organization col-sm-6');
                $('.event--venue').removeClass().attr('class', 'event--venue col-sm-6');
            }
            // Event Organization and Location set to 6 columns
            if ($.trim($('.event--venue').html()) == "" ) {
                $('.event--venue').removeClass().attr('class', 'event--venue is--empty');
                $('.event--organization').removeClass().attr('class', 'event--organization col-sm-6');
                $('.event--location').removeClass().attr('class', 'event--location col-sm-6');
            }
            // When two event blocks are hidden
            // Event Organization set to 12 columns
            if (($.trim($('.event--location').html()) == "" ) && ($.trim($('.event--venue').html()) == "" )) {
                $('.event--location').removeClass().attr('class', 'event--location is--empty');
                $('.event--venue').removeClass().attr('class', 'event--venue is--empty');
                $('.event--organization').removeClass().attr('class', 'event--organization col-sm-12');
            }
            // Event Location set to 12 columns
            if (($.trim($('.event--organization').html()) == "" ) && ($.trim($('.event--venue').html()) == "" )) {
                $('.event--organization').removeClass().attr('class', 'event--organization is--empty');
                $('.event--venue').removeClass().attr('class', 'event--venue is--empty');
                $('.event--location').removeClass().attr('class', 'event--location col-sm-12');
            }
            // Event Venue set to 12 columns
            if (($.trim($('.event--organization').html()) == "" ) && ($.trim($('.event--location').html()) == "" )) {
                $('.event--organization').removeClass().attr('class', 'event--organization is--empty');
                $('.event--location').removeClass().attr('class', 'event--location is--empty');
                $('.event--venue').removeClass().attr('class', 'event--venue col-sm-12');
            }
        }
    };
})(jQuery);
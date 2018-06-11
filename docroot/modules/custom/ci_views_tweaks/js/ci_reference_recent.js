(function ($) {
    'use strict';

    // Search Auto Submit functions
    Drupal.behaviors.ReferenceRecent = {
        attach: function (context, settings) {
            $('.field--name-field-dynamic-views select').on('change', function () {
                var $form = $(this).closest('form');
                $form.find('button[type=submit]').click();
            });

            $( '.js-form-item-field-article-type-target-id' ).addClass( "float-right" );

        }
    };
}(jQuery));
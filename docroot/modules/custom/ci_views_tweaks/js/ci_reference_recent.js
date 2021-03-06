(function ($) {
    'use strict';

    // Search Auto Submit functions
    Drupal.behaviors.ReferenceRecent = {
        attach: function (context, settings) {
            $('.field--name-field-dynamic-views select').on('change', function () {
                var $form = $(this).closest('form');
                $form.find('button[type=submit]').click();
            });

            $( '.more-link' ).addClass( "col-sm-2" );
            $( '#views-exposed-form-references-recent-nodes-ref-nodes' ).addClass( "col-sm-8 offset-md-2" );
            $( '.view-article-blocks .view-footer' ).addClass( "col-sm-8 offset-md-2" );
            $( '.view-article-blocks .views-row:last' ).css({ borderBottom: "1px solid",borderColor: "#DDDDDD", paddingBottom: "5px" });
            $( '.view-references-recent-nodes .views-row:last' ).css({ borderBottom: "1px solid",borderColor: "#DDDDDD", paddingBottom: "5px" });

        }
    };
}(jQuery));